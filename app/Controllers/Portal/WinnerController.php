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

        $arrResult['arrBidderDetails'] = $this->bidders->selectBidder($fields['bidderId']);
        $arrResult['arrItemDetails'] = $this->items->loadWinnerItems($fields['bidderId'],$fields['txt_dateFilter']);
        return $this->response->setJSON($arrResult);
    }
}
