<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class AuctionController extends BaseController
{
    public function __construct()
    {
        $this->auctions = model('Portal/Auctions');
    }

    public function loadAuctions()
    {
        $arrResult = $this->auctions->loadAuctions();
        return $this->response->setJSON($arrResult);
    }

    public function addAuction()
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

            $result = $this->auctions->addAuction($arrData);
            $msgResult[] = ($result > 0)? "Success" : "Database error";
        }
        else
        {
            $msgResult[] = $this->validation->getErrors();
        }

        return $this->response->setJSON($msgResult);
    }

    public function selectAuction()
    {
        $fields = $this->request->getGet();

        $data = $this->auctions->selectAuction($fields['auctionId']);
        return $this->response->setJSON($data);
    }

    public function editAuction()
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

    public function removeAuction()
    {
        $fields = $this->request->getPost();

        $result = $this->auctions->removeAuction($fields['txt_auctionId']);
        $msgResult[] = ($result > 0)? "Success" : "Database error";
        return $this->response->setJSON($msgResult);
    }
}
