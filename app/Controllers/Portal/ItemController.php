<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

use Square\SquareClient;
use Square\Environment;
use Square\Exceptions\ApiException;
use Square\Models\Money;
use Square\Models\CreatePaymentRequest;

class ItemController extends BaseController
{
    public function __construct()
    {
        $this->bidders = model('Portal/Bidders');
        $this->items = model('Portal/Items');
    }

    public function loadWinningItems()
    {
        if(session()->has('upp_bidder_loggedIn'))
        {
            if(session()->get('upp_bidder_loggedIn'))
            {
                $bidderId = $this->session->get('upp_bidder_id');
                $arrResult['arrBidderDetails'] = $this->bidders->selectBidder(['a.id'=>$bidderId]);
                $arrResult['arrItemDetails'] = $this->items->loadWinningItems($bidderId);
                return $this->response->setJSON($arrResult);
            }
            else
            {
                return $this->response->setJSON('Access denied!');
            }
        }
        else
        {
            return $this->response->setJSON('Access denied!');
        }  
    }

}
