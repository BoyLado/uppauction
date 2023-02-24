<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class BidderController extends BaseController
{
    public function __construct()
    {
        $this->bidders = model('Portal/Bidders');
    }

    public function loadBidders()
    {
        // if(session()->has('upp_user_loggedIn'))
        // {
        //     if(session()->get('upp_user_loggedIn'))
        //     {
                $arrResult = $this->bidders->loadBidders();
                return $this->response->setJSON($arrResult);
        //     }
        //     else
        //     {
        //         return $this->response->setJSON('Access denied!');
        //     }
        // }
        // else
        // {
        //     return $this->response->setJSON('Access denied!');
        // }  
    }

    public function addBidder()
    {
        $this->validation->setRules([
            'txt_bidderNumber' => [
                'label'  => 'Bidder Number',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Bidder Number is required',
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();

            $validateBidderNumber = $this->bidders->validateBidderNumber($fields['txt_bidderNumber']);

            if($validateBidderNumber == null)
            {
                $imageFile = $this->request->getFile('idPicture');

                if($imageFile != null)
                {
                    $newFileName = $imageFile->getRandomName();
                    $imageFile->move(ROOTPATH . 'public/assets/uploads/images/bidders', $newFileName);

                    if($imageFile->hasMoved())
                    {
                        $arrPictureData = [
                            'bidder_number' => $fields['txt_bidderNumber'],
                            'id_picture'    => $newFileName,
                            'status'        => 1,
                            'created_by'    => $this->session->get('upp_user_id'),
                            'created_date'  => date('Y-m-d H:i:s')
                        ];

                        $result = $this->bidders->addBidder($arrPictureData);
                        $msgResult[] = ($result > 0)? "Success" : "Database error";
                    }
                    else
                    {
                        $msgResult[] = "Uploading Picture Error!";
                    }
                }
                else
                {
                    $msgResult[] = "Picture Is Required!";
                }
            }
            else
            {
                $msgResult[] = "Bidder Number (".$fields['txt_bidderNumber'].") exist!";
            }            
        }
        else
        {
            $msgResult[] = $this->validation->getErrors();
        }

        return $this->response->setJSON($msgResult);
    }

    public function selectBidder()
    {
        $fields = $this->request->getGet();

        $data = $this->bidders->selectBidder($fields['bidderId']);
        return $this->response->setJSON($data);
    }

    public function editBidder()
    {
        $this->validation->setRules([
            'txt_bidderNumber' => [
                'label'  => 'Bidder Number',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Bidder Number is required',
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();

            $bidderId = $fields['txt_bidderId'];

            $arrData = [
                'first_name'    => $fields['txt_firstName'],
                'last_name'     => $fields['txt_lastName'],
                'address'       => $fields['txt_address'],
                'phone_number'  => $fields['txt_phoneNumber'],
                'email'         => $fields['txt_email'],
                'id_number'     => $fields['txt_idNumber'],
                'season_pass'   => $fields['txt_seasonPass'],
                'updated_by'    => $this->session->get('upp_user_id'),
                'updated_date'  => date('Y-m-d H:i:s')
            ];

            $result = $this->bidders->editBidder($arrData, $bidderId);
            $msgResult[] = ($result > 0)? "Success" : "Database error";
        }
        else
        {
            $msgResult[] = $this->validation->getErrors();
        }

        return $this->response->setJSON($msgResult);
    }

    public function removeBidder()
    {
        $fields = $this->request->getPost();

        $result = $this->bidders->removeBidder($fields['bidderId']);
        $msgResult[] = ($result > 0)? "Success" : "Database error";
        return $this->response->setJSON($msgResult);
    }
}
