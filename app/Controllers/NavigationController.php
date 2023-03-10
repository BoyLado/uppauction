<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class NavigationController extends BaseController
{
    public function index()
    {
        // $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        // $uri = (isset($_SERVER['HTTPS']))? 'https://' : 'http://' . $_SERVER['SERVER_NAME'] . '/' . $uriSegments[1] . '/login';
        // return redirect()->to($uri);
        $data['pageTitle'] = "U Pick A Pallet | Pre Registration";
        $data['userAuthCode'] = "";
        return $this->slice->view('pre_registration_form', $data);
    }

    public function login()
    {
        if($this->session->has('upp_user_loggedIn'))
        {
            if($this->session->get('upp_user_loggedIn'))
            {
                return redirect()->to(base_url() . '/portal/auction-dashboard');
            }
        }
        $data['pageTitle'] = "U Pick A Pallet | Login";
        $data['userAuthCode'] = "";
        return $this->slice->view('login', $data);
    }

    public function forgotPassword()
    {
        $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        if(!file_exists(FCPATH . '.env'))
        {
            $uri = (isset($_SERVER['HTTPS']))? 'https://' : 'http://' . $_SERVER['SERVER_NAME'] . '/' . $uriSegments[1] . '/install';
            return redirect()->to($uri); 
        }
        if($this->session->has('upp_user_loggedIn'))
        {
            if($this->session->get('upp_user_loggedIn'))
            {
                return redirect()->to(base_url() . '/portal/auction-dashboard');
            }
        }
        $data['pageTitle'] = "U Pick A Pallet | Forgot Password";
        return $this->slice->view('forgot_password', $data);
    }

    public function changePassword($userId, $userAuthCode, $passwordAuthCode)
    {
        $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        if(!file_exists(FCPATH . '.env'))
        {
            $uri = (isset($_SERVER['HTTPS']))? 'https://' : 'http://' . $_SERVER['SERVER_NAME'] . '/' . $uriSegments[1] . '/install';
            return redirect()->to($uri); 
        }
        if($this->session->has('upp_user_loggedIn'))
        {
            if($this->session->get('upp_user_loggedIn'))
            {
                return redirect()->to(base_url() . '/portal/auction-dashboard');
            }
        }
        $data['pageTitle'] = "U Pick A Pallet | Change Password";
        $data['userId'] = $userId;
        $data['userAuthCode'] = $userAuthCode;
        $data['passwordAuthCode'] = $passwordAuthCode;
        return $this->slice->view('change_password', $data);
    }

    public function signUp($userId, $userAuthCode)
    {
        $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        if(!file_exists(FCPATH . '.env'))
        {
            $uri = (isset($_SERVER['HTTPS']))? 'https://' : 'http://' . $_SERVER['SERVER_NAME'] . '/' . $uriSegments[1] . '/install';
            return redirect()->to($uri); 
        }
        if($this->session->has('upp_user_loggedIn'))
        {
            if($this->session->get('upp_user_loggedIn'))
            {
                return redirect()->to(base_url() . '/portal/auction-dashboard');
            }
        }
        $data['pageTitle'] = "U Pick A Pallet | Sign Up";
        $data['userId'] = $userId;
        $data['userAuthCode'] = $userAuthCode;
        return $this->slice->view('sign_up', $data);
    }

    public function preRegistration()
    {
        return $this->slice->view('pre_registration_form');
    }

    public function preRegistrationConfirmation($result)
    {
        $data['confirmation_result'] = $result;
        return $this->slice->view('pre_registration_confirmation',$data);
    }
}
