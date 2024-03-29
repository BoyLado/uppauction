<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class NavigationController extends BaseController
{
    public function __construct()
    {
        $this->users        = model('Portal/Users');
    }

    public function auctionDashboard()
    {
        if($this->session->has('upp_bidder_loggedIn'))
        {
            if($this->session->get('upp_bidder_loggedIn'))
            {
                $data['pageTitle'] = "Dashboard | UPP Auction Services";
                $data['customScripts'] = 'auction_dashboard';
                return $this->slice->view('portal.auction_dashboard', $data);
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function auctionItems()
    {
        if($this->session->has('upp_bidder_loggedIn'))
        {
            if($this->session->get('upp_bidder_loggedIn'))
            {
                $data['pageTitle'] = "Items | UPP Auction Services";
                $data['customScripts'] = 'auction_items';
                return $this->slice->view('portal.auction_items', $data);
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function auctionPayments()
    {
        if($this->session->has('upp_bidder_loggedIn'))
        {
            if($this->session->get('upp_bidder_loggedIn'))
            {
                $data['pageTitle'] = "Payments | UPP Auction Services";
                $data['customScripts'] = 'auction_payments';
                return $this->slice->view('portal.auction_payments', $data);
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function auctionCalendar()
    {
        if($this->session->has('upp_bidder_loggedIn'))
        {
            if($this->session->get('upp_bidder_loggedIn'))
            {
                $data['pageTitle'] = "Auction Calendar | UPP Auction Services";
                $data['customScripts'] = 'auction_calendar';
                return $this->slice->view('portal.auction_calendar', $data);
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }

    public function myAccount()
    {
        if($this->session->has('upp_bidder_loggedIn'))
        {
            if($this->session->get('upp_bidder_loggedIn'))
            {
                $data['pageTitle'] = "My Account | UPP Auction Services";
                $data['customScripts'] = 'my_account';
                return $this->slice->view('portal.my_account', $data);
            }
            else
            {
                return redirect()->to(base_url());
            }
        }
        else
        {
            return redirect()->to(base_url());
        }
    }
}
