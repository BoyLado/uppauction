<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

use Square\SquareClient;
use Square\Environment;
use Square\Exceptions\ApiException;
use Square\Models\Money;
use Square\Models\Address;
use Square\Models\CreatePaymentRequest;

class PaymentController extends BaseController
{
    public function __construct()
    {
        $this->items = model('Portal/Items');
        $this->bidders = model('Portal/Bidders');
        $this->payments = model('Portal/Payments');
    }

    public function loadPayments()
    {
        $bidderId = $this->session->get('upp_bidder_id');
        $arrResult = $this->payments->loadPayments(['a.bidder_id'=>$bidderId, 'a.status'=>1]);
        return $this->response->setJSON($arrResult);
    }

    public function loadPaymentDetails()
    {
        $fields = $this->request->getGet();

        $itemsId = explode(',',$fields['itemsId']);

        $data['arrPaymentDetails'] = $this->payments->selectPayment($fields['paymentId']);
        $data['arrItemDetails'] = $this->payments->loadPaymentDetails($itemsId);
        return $this->response->setJSON($data);
    }

    public function createPayment()
    {
        $fields = $this->request->getPost();

        $cardToken = $fields['cardToken'];

        $bidderId = $this->session->get('upp_bidder_id');
        $arrBidder = $this->bidders->selectBidder(['a.id'=>$bidderId]);
        $arrWinningItems = $this->items->loadWinningItems($bidderId);

        $subTotal = 0;
        $tax = 0;
        $transactionFee = 0;
        $totalPayment = 0;

        $arrItems = [];
        $arrItemsId = [];

        $numberOfItems = 0;

        foreach ($arrWinningItems as $key => $value) 
        {
            $subTotal += (float)$value['winning_amount'];
            $arrItems[] = [
                'id' => $value['id'],
                'paid' => 1
            ];
            $arrItemsId[] = $value['id'];

            $numberOfItems++;
        }

        $tax = $subTotal * 0.0954;
        $subTotalPlusTax = $subTotal + $tax;
        $transactionFee = $subTotalPlusTax * 0.0435;

        $totalPayment = $subTotalPlusTax + $transactionFee;

        $paymentAmount = number_format($totalPayment,2);
        $paymentAmount = preg_replace('/\./', '', $paymentAmount);

        $client = new SquareClient([
            'accessToken' => getenv('SQUARE_ACCESS_TOKEN'),
            'environment' => getenv('SQUARE_ENVIRONMENT'),
        ]);

        $amount_money = new \Square\Models\Money();
        $amount_money->setAmount($paymentAmount);
        $amount_money->setCurrency('USD');

        $billing_address = new \Square\Models\Address();
        $billing_address->setCountry('US');
        $billing_address->setFirstName($fields['txt_firstName']);
        $billing_address->setLastName($fields['txt_lastName']);

        $idempotencyKey = uniqid('upp_'); 
        $body = new \Square\Models\CreatePaymentRequest(
            $cardToken,
            $idempotencyKey,
            $amount_money
        );
        $body->setAutocomplete(true);
        $body->setLocationId(getenv('SQUARE_LOCATION_ID'));
        $body->setBuyerEmailAddress($fields['txt_emailAddress']);
        $body->setBillingAddress($billing_address);

        $api_response = $client->getPaymentsApi()->createPayment($body);
        if ($api_response->isSuccess()) 
        {
            $arrData = [
                'bidder_id'             => $bidderId,
                'items_id'              => implode(',', $arrItemsId),
                'sub_total'             => number_format($subTotal,2),
                'tax'                   => number_format($tax,2),
                'card_transaction_fee'  => number_format($transactionFee,2),
                'card_payment'          => number_format((float)$totalPayment,2),
                'total_payment'         => number_format($totalPayment,2),
                'status'                => 1,
                'created_by'            => null,
                'created_date'          => date('Y-m-d H:i:s')
            ];
            $result = $this->payments->addPayment($arrData);
            if($result > 0)
            {
                $receipt = '';
                if($result < 10)
                {
                    $receipt = '00000'.$result;
                }
                else if($result < 100)
                {
                    $receipt = '0000'.$result;
                }
                else if($result < 1000)
                {
                    $receipt = '000'.$result;
                }
                else if($result < 10000)
                {
                    $receipt = '00'.$result;
                }
                else if($result < 100000)
                {
                    $receipt = '0'.$result;
                }
                else
                {
                    $receipt = $result;
                }

                $result = $this->items->changeStatus($arrItems);

                //email
                $emailSender    = 'customerservice@upickapallet.com';
                $emailReceiver  = $fields['txt_emailAddress'];

                $data['subjectTitle']           = 'UPP Payment Receipt';
                $data['receiptNumber']          = $receipt;
                $data['bidderId']               = $arrBidder['bidder_id'];
                $data['bidderNumber']           = $arrBidder['bidder_number'];
                $data['bidderName']             = $arrBidder['first_name'] . " " . $arrBidder['last_name'];
                $data['bidderEmailAddress']     = $arrBidder['email'];
                $data['bidderPhoneNumber']      = $arrBidder['phone_number'];
                $data['bidderAddress']          = $arrBidder['address'];
                $data['numberOfItems']          = $numberOfItems;
                $data['arrItems']               = $arrWinningItems;
                $data['subTotal']               = number_format($subTotal,2);
                $data['tax']                    = number_format($tax,2);
                $data['card_transaction_fee']   = number_format($transactionFee,2);
                $data['total_payment']          = number_format($totalPayment,2);
                $data['dateSent']               = date('F d, Y');

                $emailResult = sendSliceMail('upp_receipt',$emailSender,$emailReceiver,$data);
            }
            $arrResult['Success'] = $api_response->getResult();
        }
        else 
        {
            $arrResult['Error'] = $api_response->getErrors();
        }

        return $this->response->setJSON($arrResult);
    }

    public function selectPayment()
    {
        $fields = $this->request->getGet();

        $data = $this->auctions->selectAuction($fields['auctionId']);
        return $this->response->setJSON($data);
    }

    public function editPayment()
    {
        $fields = $this->request->getPost();

        $this->validation->setRules([
            'txt_title' => [
                'label'  => 'Auction Title',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Auction Title is required',
                ],
            ],
            'txt_date'  => [
                'label'  => 'Auction Date',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Auction Date is required',
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $arrData = [
                'auction_title'         => $fields['txt_title'],
                'auction_description'   => $fields['txt_description'],
                'auction_date'          => $fields['txt_date'],
                'status'                => 1,
                'created_by'            => $this->session->get('upp_user_id'),
                'created_date'          => date('Y-m-d H:i:s')
            ];

            $result = $this->auctions->editItem($arrData, $fields['txt_auctionId']);
            $msgResult[] = ($result > 0)? "Success" : "Database error";
        }
        else
        {
            $msgResult[] = $this->validation->getErrors();
        }

        return $this->response->setJSON($msgResult);
    }
}
