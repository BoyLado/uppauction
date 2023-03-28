<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class AuctionController extends BaseController
{
    public function __construct()
    {
        $this->auctions = model('Portal/Auctions');
        $this->bidders = model('Portal/Bidders');
    }

    public function loadAuctions()
    {
        $arrResult = $this->auctions->loadAuctions();
        return $this->response->setJSON($arrResult);
    }

    public function loadAuctionDates()
    {
        $arrResult = $this->auctions->loadAuctionDates();
        return $this->response->setJSON($arrResult);
    }

    public function selectAuction()
    {
        $fields = $this->request->getGet();

        $data = $this->auctions->selectAuction($fields['auctionId']);
        return $this->response->setJSON($data);
    }

    public function submitPreRegistration()
    {
        $fields = $this->request->getPost();

        $this->validation->setRules([
            'slc_auctionDate' => [
                'label'  => 'Item Number',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Auction Date is required',
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $authCode = generate_code();
            $auctionDate = $this->auctions->selectAuction($fields['slc_auctionDate']);
            $arrData = [
                'bidder_id'     => $this->session->get('upp_bidder_id'),
                'auction_id'    => $auctionDate['id'],
                'auction_date'  => $auctionDate['auction_date'],
                'auth_code'     => encrypt_code($authCode),
                'confirmed'     => 'YES',    
                'confirmed_date'=> date('Y-m-d H:i:s'),
                'created_date'  => date('Y-m-d H:i:s')
            ];

            $result = $this->bidders->addBidderRegistration($arrData);
            if($result > 0)
            {
                if($fields['chk_guest'] == 1)
                {
                    $arrData = [];
                    $arrGuest = json_decode($fields['arrGuest'],true);
                    foreach ($arrGuest as $key => $value) 
                    {
                        $arrData[] = [
                            'registration_id'       => $result,
                            'guest_first_name'      => $value['first_name'],
                            'guest_last_name'       => $value['last_name'],
                            'guest_email'           => $value['email_address'],
                            'relation_to_bidder'    => $value['relationship'],
                            'created_date'          => date('Y-m-d H:i:s')
                        ];
                    }
                    $result = $this->bidders->addBidderGuest($arrData);
                }
            }
            $msgResult[] = ($result > 0)? "Success" : "Database error";
        }
        else
        {
            $msgResult[] = $this->validation->getErrors();
        }

        return $this->response->setJSON($msgResult);
    }

}
