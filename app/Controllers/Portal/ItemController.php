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
        $this->items = model('Portal/Items');
    }

    public function loadWinningItems()
    {
        if(session()->has('upp_bidder_loggedIn'))
        {
            if(session()->get('upp_bidder_loggedIn'))
            {
                $bidderId = $this->session->get('upp_bidder_id');
                $arrResult = $this->items->loadWinningItems($bidderId);
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

    public function listPayments()
    {

        $client = new SquareClient([
            'accessToken' => getenv('SQUARE_ACCESS_TOKEN'),
            'environment' => getenv('SQUARE_ENVIRONMENT'),
        ]);

        $api_response = $client->getPaymentsApi()->listPayments();

        if ($api_response->isSuccess()) 
        {
            $arrResult = $api_response->getResult();
        } 
        else 
        {
            $arrResult = $api_response->getErrors();
        }

        return $this->response->setJSON($arrResult);
    }

    public function createPayment()
    {
        $fields = $this->request->getPost();

        $cardToken = $fields['cardToken'];
        $paymentAmount = 0;

        $bidderId = $this->session->get('upp_bidder_id');
        $arrWinningItems = $this->items->loadWinningItems($bidderId);

        foreach ($arrWinningItems as $key => $value) 
        {
            $paymentAmount += (float)$value['winning_amount'];
        }

        $paymentAmount = number_format($paymentAmount,2);
        $paymentAmount = preg_replace('/\./', '', $paymentAmount);

        $client = new SquareClient([
            'accessToken' => getenv('SQUARE_ACCESS_TOKEN'),
            'environment' => getenv('SQUARE_ENVIRONMENT'),
        ]);

        $amount_money = new \Square\Models\Money();
        $amount_money->setAmount($paymentAmount);
        $amount_money->setCurrency('USD');

        $idempotencyKey = uniqid('upp_'); 
        $body = new \Square\Models\CreatePaymentRequest(
            $cardToken,
            $idempotencyKey,
            $amount_money
        );
        $body->setAutocomplete(true);
        $body->setLocationId(getenv('SQUARE_LOCATION_ID'));

        $api_response = $client->getPaymentsApi()->createPayment($body);
        if ($api_response->isSuccess()) 
        {
            $arrResult['Success'] = $api_response->getResult();
        }
        else 
        {
            $arrResult['Error'] = $api_response->getErrors();
        }

        // $arrResult = [

        //     'cardToken' => $cardToken,
        //     'paymentAmount' => $paymentAmount

        // ];

        // $body->setCustomerId('1');
        // $body->setBuyerEmailAddress('ajhay.dev@gmail.com');
        // $body->setBillingAddress($billing_address);

        // $billing_address = new \Square\Models\Address();
        // $billing_address->setCountry('US');
        // $billing_address->setFirstName('Jay');
        // $billing_address->setLastName('Last');

        return $this->response->setJSON($arrResult);
    }

}
