<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class IndexController extends BaseController
{
    public function __construct()
    {
        $this->bidders = model('Portal/Bidders');
    }

    public function login()
    {
        $this->validation->setRules([
            'txt_bidderEmail' => [
                'label'  => 'Bidder Email',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Bidder Email is required'
                ],
            ],
            'txt_bidderPassword' => [
                'label'  => 'Bidder Password',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Password is Incorrect',
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();

            $logInRequirements = [
              'email'      => $fields['txt_bidderEmail'],
              'password'   => encrypt_code($fields['txt_bidderPassword']),
              'status'     => '1', //meaning active
            ];

            $validateLogInResult = $this->bidders->validateLogIn($logInRequirements);

            if(!empty($validateLogInResult))
            {
              $userData = [
                'upp_bidder_id'        => $validateLogInResult['bidder_id'],
                'upp_bidder_firstName' => $validateLogInResult['first_name'],
                'upp_bidder_lastName'  => $validateLogInResult['last_name'],
                'upp_bidder_loggedIn'  => true
              ];
              $this->session->set($userData);

              $msgResult[] = "Success";
            }
            else
            {
              $msgResult[] = "Access denied, please try again or contact our administrator";
            }
        }
        else
        {
            $msgResult[] = $this->validation->getErrors();
        }

        return $this->response->setJSON($msgResult);
    }

    public function forgotPassword()
    {
        $this->validation->setRules([
            'txt_bidderEmail' => [
                'label'  => 'Bidder Email',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required' => 'Bidder Email is required',
                    'valid_email' => 'Bidder Email must be valid'
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();

            $arrData = [
                'auth_code' => encrypt_code(generate_code())
            ];
            $result = $this->bidders->createPasswordAuthCode($arrData, $fields['txt_bidderEmail']);
            if($result > 0)
            {
                $emailSender    = 'customerservice@upickapallet.com';
                $emailReceiver  = $fields['txt_bidderEmail'];

                $arrResult = $this->bidders->selectBidder(['email'=>$emailReceiver]);

                $data['subjectTitle']       = 'Forgot Password';
                $data['bidderId']           = $arrResult['bidder_id'];
                $data['bidderName']         = $arrResult['first_name'] . " " . $arrResult['last_name'];
                $data['bidderAuthCode']     = decrypt_code($arrResult['auth_code']);

                $emailResult = sendSliceMail('forgot_password',$emailSender,$emailReceiver,$data);
                $msgResult[] = ($emailResult == 1)? "Success" : $emailResult;
            }
            else
            {
                $msgResult[] = "Error! <br>Your email was not recognized!";
            }  
        }
        else
        {
            $msgResult[] = $this->validation->getErrors();
        }

        return $this->response->setJSON($msgResult);
    }

    public function changePassword()
    {
        $this->validation->setRules([
            'txt_newPassword' => [
                'label'  => 'New Password',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'New password is required'
                ],
            ],
            'txt_confirmPassword' => [
                'label'  => 'Confirm Password',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Confirm password is required'
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();
            
            $arrData = [
                'password' => encrypt_code($fields['txt_newPassword'])
            ];

            $whereParams = [
                'id' => $fields['txt_bidderId'],
                'auth_code' => encrypt_code($fields['txt_bidderAuthCode'])
            ];

            $result = $this->bidders->changePassword($arrData, $whereParams);
            $msgResult[] = ($result == 1)? "Success" : "Database error";
        }
        else
        {
            $msgResult[] = $this->validation->getErrors();
        }

        return $this->response->setJSON($msgResult);
    }

    public function logout()
    {
        $userData = [
            'upp_bidder_id',
            'upp_bidder_firstName',
            'upp_bidder_lastName',
            'upp_bidder_loggedIn'
        ];
        $this->session->destroy();
        return redirect()->to(base_url());
    }
}
