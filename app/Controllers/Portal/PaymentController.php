<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

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
        $arrResult = $this->payments->loadPayments();
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

    public function addPayment()
    {
        $fields = $this->request->getPost();

        $arrBidder = $this->bidders->selectBidder($fields['txt_bidderId']);
        $arrPayments = $this->items->loadWinnerItems($fields['txt_bidderId'],$fields['txt_dateFilter']);

        $subTotal = 0;
        $tax = 0;
        $transactionFee = 0;
        $totalPayment = 0;

        $arrItems = [];
        $arrItemsId = [];

        foreach ($arrPayments as $key => $value) 
        {
            $subTotal += (float)$value['winning_amount'];
            $arrItems[] = [
                'id' => $value['id'],
                'paid' => 1
            ];
            $arrItemsId[] = $value['id'];
        }

        $tax = $subTotal * 0.0954;
        if($fields['txt_cardPayment'] != "")
        {
            $transactionFee = (float)$fields['txt_cardPayment'] * 0.0435;
        }

        $totalPayment = $subTotal + $tax + $transactionFee;

        $arrData = [
            'bidder_id'             => $fields['txt_bidderId'],
            'items_id'              => implode(',', $arrItemsId),
            'sub_total'             => number_format($subTotal,2),
            'tax'                   => number_format($tax,2),
            'card_transaction_fee'  => number_format($transactionFee,2),
            'cash_payment'          => number_format((float)$fields['txt_cashPayment'],2),
            'card_payment'          => number_format((float)$fields['txt_cardPayment'],2),
            'total_payment'         => number_format($totalPayment,2),
            'status'                => 1,
            'created_by'            => $this->session->get('upp_user_id'),
            'created_date'          => date('Y-m-d H:i:s')
        ];
        $result = $this->payments->addPayment($arrData);
        if($result > 0)
        {
            $result = $this->items->changeStatus($arrItems);

            //email
            $emailSender    = 'ajhay.work@gmail.com';
            $emailReceiver  = $arrBidder['email'];

            $data['subjectTitle']           = 'UPP Payment Receipt';
            $data['bidderId']               = $arrBidder['id'];
            $data['bidderEmailAddress']     = $arrBidder['email'];
            $data['bidderNumber']           = $arrBidder['bidder_number'];
            $data['arrItems']               = $arrPayments;
            $data['subTotal']               = number_format($subTotal,2);
            $data['tax']                    = number_format($tax,2);
            $data['card_transaction_fee']   = number_format($transactionFee,2);
            $data['total_payment']          = number_format($totalPayment,2);

            $emailResult = sendSliceMail('upp_receipt',$emailSender,$emailReceiver,$data);
        }
        $msgResult[] = ($result > 0)? "Success" : "Database error";

        return $this->response->setJSON($msgResult);
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
