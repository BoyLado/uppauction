<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PreRegistrationController extends BaseController
{
    public function __construct()
    {
        $this->auctions = model('Portal/Auctions');
        $this->bidders = model('Portal/Bidders');
    }

    public function loadAuctionDates()
    {
        $whereParams = [
            'a.auction_date >='=>date('Y-m-d')
        ];
        $arrResult = $this->auctions->loadAuctions($whereParams);
        return $this->response->setJSON($arrResult);
    }

    public function preRegistrationWithSeasonPass()
    {
        $fields = $this->request->getPost();

        $this->validation->setRules([
            'slc_auctionDate' => [
                'label'  => 'Item Number',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Auction Date is required',
                ],
            ],
            'txt_emailAddress' => [
                'label'  => 'Item Description',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required'    => 'Email Address is required',
                    'valid_email' => 'Email Address must be valid'
                ],
            ],
            'txt_seasonPassNumber' => [
                'label'  => 'Bidder Number',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Season Pass Number is required',
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $emailAddress       = $fields['txt_emailAddress'];
            $seasonPassNumber   = (int)$fields['txt_seasonPassNumber'];
            $validationResult = $this->bidders->validateBidder($emailAddress,$seasonPassNumber);

            if($validationResult != null)
            {
                if($emailAddress == $validationResult['email'] && $seasonPassNumber == $validationResult['bidder_number'])
                { 
                    $authCode = generate_code();
                    $auctionDate = $this->auctions->selectAuction($fields['slc_auctionDate']);
                    $arrData = [
                        'bidder_id'     => $validationResult['id'],
                        'auction_id'    => $auctionDate['id'],
                        'auction_date'  => $auctionDate['auction_date'],
                        'auth_code'     => encrypt_code($authCode),    
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
                        //email
                        $emailSender    = 'ajhay.work@gmail.com';
                        $emailReceiver  = $emailAddress;

                        $data['subjectTitle']           = 'Welcome Bidder';
                        $data['bidderId']               = $validationResult['id'];
                        $data['bidderEmailAddress']     = $validationResult['email'];
                        $data['bidderSeasonPassNumber'] = $validationResult['bidder_number'];
                        $data['bidderAuthCode']         = $authCode;
                        $data['bidderGuests']           = $arrGuest;

                        $emailResult = sendSliceMail('pre_registration',$emailSender,$emailReceiver,$data);
                    }
                    $msgResult[] = ($result > 0)? "Success" : "Database error";
                }
                else
                {
                    $msgResult[] = "Email or Season Pass Number does not exist!";
                }
            }
            else
            {
                $msgResult[] = "Email or Season Pass Number does not exist!";
            }
        }
        else
        {
            $msgResult[] = $this->validation->getErrors();
        }

        return $this->response->setJSON($msgResult);
    }

    public function preRegistrationWithoutSeasonPass()
    {
        $fields = $this->request->getPost();

        $this->validation->setRules([
            'slc_auctionDate' => [
                'label'  => 'Auction Date',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Auction Date is required',
                ],
            ],
            'txt_firstName' => [
                'label'  => 'First Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'First Name is required',
                ],
            ],
            'txt_lastName' => [
                'label'  => 'Last Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Last Name is required',
                ],
            ],
            'txt_completeAddress' => [
                'label'  => 'Complete Address',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Complete Address is required',
                ],
            ],
            'txt_driverLicenseNumber' => [
                'label'  => 'Drivers License',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Drivers License is required',
                ],
            ],
            'txt_emailAddress' => [
                'label'  => 'Item Description',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required'    => 'Email Address is required',
                    'valid_email' => 'Email Address must be valid'
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $emailAddress     = $fields['txt_emailAddress'];
            $validationResult = $this->bidders->validateEmail($emailAddress);

            if($validationResult == null)
            {
                $bidderMax = $this->bidders->loadMaxBidder();
                $newBidderNumber = (int)$bidderMax['max_bidder_number'] + 1;
                $arrData = [
                    'bidder_number' => $newBidderNumber,
                    'company_name'  => $fields['txt_companyName'],
                    'first_name'    => $fields['txt_firstName'],
                    'last_name'     => $fields['txt_lastName'],
                    'address'       => $fields['txt_completeAddress'],
                    'phone_number'  => $fields['txt_phoneNumber'],
                    'email'         => $fields['txt_emailAddress'],
                    'id_number'     => $fields['txt_driverLicenseNumber'],
                    'status'        => 1,
                    'created_date'  => date('Y-m-d H:i:s')
                ];

                $newBidder = $this->bidders->addBidder($arrData);
                if($newBidder > 0)
                {
                    $authCode = generate_code();
                    $auctionDate = $this->auctions->selectAuction($fields['slc_auctionDate']);
                    $arrData = [
                        'bidder_id'     => $newBidder,
                        'auction_id'    => $auctionDate['id'],
                        'auction_date'  => $auctionDate['auction_date'],
                        'auth_code'     => encrypt_code($authCode),    
                        'created_date'  => date('Y-m-d H:i:s')
                    ];

                    $result = $this->bidders->addBidderRegistration($arrData);
                    if($result > 0)
                    {
                        //email
                        $emailSender    = 'ajhay.work@gmail.com';
                        $emailReceiver  = $emailAddress;

                        $data['subjectTitle']           = 'Welcome New Bidder';
                        $data['bidderId']               = $newBidder;
                        $data['bidderEmailAddress']     = $emailAddress;
                        $data['bidderSeasonPassNumber'] = "";
                        $data['bidderNumber']           = $newBidderNumber;
                        $data['bidderAuthCode']         = $authCode;
                        $data['bidderGuests']           = [];

                        $emailResult = sendSliceMail('pre_registration',$emailSender,$emailReceiver,$data);
                    }
                }

                $msgResult[] = ($result > 0)? "Success" : "Database error";
            }
            else
            {
                $msgResult[] = "Email already exist!";
            }
        }
        else
        {
            $msgResult[] = $this->validation->getErrors();
        }

        return $this->response->setJSON($msgResult);
    }

    public function confirmPreRegistration($bidderId, $authCode)
    {
        $arrData = [
            'confirmed'       => 'YES',    
            'confirmed_date'  => date('Y-m-d H:i:s')
        ];

        $whereParams = [
            'bidder_id' => $bidderId,
            'auth_code' => encrypt_code($authCode),
        ];

        $result = $this->bidders->editBidderRegistration($arrData, $whereParams);
        if($result > 0)
        {
            $data['confirmation_result'] = "Success";
        }
        else
        {
            $data['confirmation_result'] = "Error";
        }

        return $this->slice->view('pre_registration_confirmation',$data);
    }
}
