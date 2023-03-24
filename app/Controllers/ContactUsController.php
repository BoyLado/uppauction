<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ContactUsController extends BaseController
{
    public function __construct()
    {

    }

    public function sendEmail()
    {
        $this->validation->setRules([
            'txt_name' => [
                'label'  => 'Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Name is required',
                ],
            ],
            'txt_email' => [
                'label'  => 'Email',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required'    => 'Email is required',
                    'valid_email' => 'Email must be valid'
                ],
            ],
            'txt_subject' => [
                'label'  => 'Subject',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Subject is required',
                ],
            ],
            'txt_message' => [
                'label'  => 'Message',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Message is required',
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();

            $recaptchaResponse = trim($fields['g-recaptcha-response']);
            $status = reCaptchaTest($recaptchaResponse, $this->request);

            if($status['success'])
            {
                $emailSender    = $fields['txt_email'];
                $emailReceiver  = 'customerservice@upickapallet.com';

                $data['subjectTitle']           = $fields['txt_subject'];
                $data['name']                   = $fields['txt_name'];
                $data['message']                = $fields['txt_message'];

                $emailResult = sendSliceMail('contact_us',$emailSender,$emailReceiver,$data);
                $msgResult[] = ($emailResult > 0)? "Success" : "Database error";
            }
            else
            {
                $msgResult[] = "Recaptcha Error!";
            }
        }
        else
        {
            $msgResult[] = $this->validation->getErrors();
        }

        return $this->response->setJSON($msgResult);
    }
}
