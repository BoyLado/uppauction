<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class PaymentController extends BaseController
{
    public function __construct()
    {
        $this->items = model('Portal/Items');
        $this->payments = model('Portal/Payments');
    }

    public function loadPayments()
    {
        $arrResult = $this->payments->loadPayments();
        return $this->response->setJSON($arrResult);
    }

    public function addPayment()
    {
        $fields = $this->request->getPost();

        $arrPayments = $this->items->loadWinnerItems($fields['txt_bidderId'],$fields['txt_dateFilter']);

        $subTotal = 0;
        $tax = 0;
        $transactionFee = 0;
        $totalPayment = 0;

        $arrItems = [];

        foreach ($arrPayments as $key => $value) 
        {
            $subTotal += (float)$value['winning_amount'];
            $arrItems[] = [
                'id' => $value['id'],
                'paid' => 1
            ];
        }

        $tax = $subTotal * 0.0954;
        if($fields['txt_cardPayment'] != "")
        {
            $transactionFee = (float)$fields['txt_cardPayment'] * 0.0435;
        }

        $totalPayment = $subTotal + $tax + $transactionFee;

        $arrData = [
            'bidder_id'             => $fields['txt_bidderId'],
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
