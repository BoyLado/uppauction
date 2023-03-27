<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class NavigationController extends BaseController
{
    public function index()
    {
        $data['pageTitle'] = "Pre Registration | U Pick A Pallet";
        $data['bidderAuthCode'] = "";
        $data['loggedId'] = $this->session->get('upp_bidder_loggedIn');
        $data['bidderName'] = $this->session->get('upp_bidder_firstName');
        $data['googleSiteKey'] = getenv('RECAPTCHA_SITE_KEY');
        return $this->slice->view('pre_registration_form', $data);
    }

    public function contactUs()
    {
        $data['pageTitle'] = "Contact Us | U Pick A Pallet";
        $data['bidderAuthCode'] = "";
        $data['loggedId'] = $this->session->get('upp_bidder_loggedIn');
        $data['bidderName'] = $this->session->get('upp_bidder_firstName');
        $data['googleSiteKey'] = getenv('RECAPTCHA_SITE_KEY');
        return $this->slice->view('contact_us', $data);
    }

    public function login()
    {
        if($this->session->has('upp_bidder_loggedIn'))
        {
            if($this->session->get('upp_bidder_loggedIn'))
            {
                return redirect()->to(base_url() . '/portal/auction-dashboard');
            }
        }
        $data['pageTitle'] = "Login | U Pick A Pallet";
        $data['bidderAuthCode'] = "";
        return $this->slice->view('login', $data);
    }

    public function forgotPassword()
    {
        if($this->session->has('upp_bidder_loggedIn'))
        {
            if($this->session->get('upp_bidder_loggedIn'))
            {
                return redirect()->to(base_url() . '/portal/auction-dashboard');
            }
        }
        $data['pageTitle'] = "Forgot Password | U Pick A Pallet";
        return $this->slice->view('forgot_password', $data);
    }

    public function changePassword($bidderId, $bidderAuthCode)
    {
        if($this->session->has('upp_bidder_loggedIn'))
        {
            if($this->session->get('upp_bidder_loggedIn'))
            {
                return redirect()->to(base_url() . '/portal/auction-dashboard');
            }
        }
        $data['pageTitle'] = "Change Password | U Pick A Pallet";
        $data['bidderId'] = $bidderId;
        $data['bidderAuthCode'] = $bidderAuthCode;
        return $this->slice->view('change_password', $data);
    }

    public function preRegistrationConfirmation($result)
    {
        $data['confirmation_result'] = $result;
        return $this->slice->view('pre_registration_confirmation',$data);
    }
}
