<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class WinnerController extends BaseController
{
    public function __construct()
    {
        $this->bidders = model('Portal/Bidders');
        $this->items = model('Portal/Items');
    }

    public function loadWinners()
    {
        $fields = $this->request->getGet();

        $arrResult = $this->items->loadWinners($fields['order'],$fields['dateFilter'],$fields['textSearch']);
        return $this->response->setJSON($arrResult);
    }

    public function loadWinnerItems()
    {
        $fields = $this->request->getGet();

        $arrResult = $this->items->loadWinnerItems($fields['bidderId'],$fields['txt_dateFilter']);
        return $this->response->setJSON($arrResult);
    }

    public function addPayment()
    {
        $fields = $this->request->getPost();

        $arrWinnerItems = $this->items->loadWinnerItems($fields['bidderId'],$fields['txt_dateFilter']);

        foreach ($arrWinnerItems as $key => $value) 
        {
            // code...
        }

        $arrData = [
            'bidder_id' => $fields['txt_bidderId'],
            'paid_amount' => (float)$fields['txt_cashPayment'] + (float)$fields['txt_cardPayment']
        ];
        return $this->response->setJSON($arrData);
    }
}
