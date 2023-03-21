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

    public function loadItems()
    {
        // if(session()->has('upp_user_loggedIn'))
        // {
        //     if(session()->get('upp_user_loggedIn'))
        //     {
                $arrResult = $this->items->loadItems(date('Y-m-d'));
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

        $sourceId = $fields['sourceId'];
        $amount = $fields['txt_amount'];

        $client = new SquareClient([
            'accessToken' => getenv('SQUARE_ACCESS_TOKEN'),
            'environment' => getenv('SQUARE_ENVIRONMENT'),
        ]);

        $amount_money = new \Square\Models\Money();
        $amount_money->setAmount($amount);
        $amount_money->setCurrency('USD');

        $idempotencyKey = uniqid('upp_'); 
        $body = new \Square\Models\CreatePaymentRequest(
            $sourceId,
            $idempotencyKey,
            $amount_money
        );
        $body->setAutocomplete(true);
        $body->setLocationId(getenv('SQUARE_LOCATION_ID'));

        $api_response = $client->getPaymentsApi()->createPayment($body);
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

    public function addItem()
    {
        $fields = $this->request->getPost();

        $this->validation->setRules([
            'txt_itemNumber' => [
                'label'  => 'Item Number',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Item Number is required',
                ],
            ],
            'txt_itemDescription' => [
                'label'  => 'Item Description',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Item Description is required',
                ],
            ],
            'slc_bidderNumber' => [
                'label'  => 'Bidder Number',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Bidder Number is required',
                ],
            ],
            'txt_winningAmount' => [
                'label'  => 'Amount',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Amount is required',
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $arrData = [
                'item_number'       => $fields['txt_itemNumber'],
                'item_description'  => $fields['txt_itemDescription'],
                'bidder_id'         => $fields['slc_bidderNumber'],
                'winning_amount'    => $fields['txt_winningAmount'],
                'created_by'        => $this->session->get('upp_user_id'),
                'created_date'      => date('Y-m-d H:i:s')
            ];

            $result = $this->items->addItem($arrData);
            $msgResult[] = ($result > 0)? "Success" : "Database error";
        }
        else
        {
            $msgResult[] = $this->validation->getErrors();
        }

        return $this->response->setJSON($msgResult);
    }

    public function selectItem()
    {
        $fields = $this->request->getGet();

        $data = $this->items->selectItem($fields['itemId']);
        return $this->response->setJSON($data);
    }

    public function editItem()
    {
        $fields = $this->request->getPost();

        $this->validation->setRules([
            'txt_editItemNumber' => [
                'label'  => 'Item Number',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Item Number is required',
                ],
            ],
            'txt_editItemDescription' => [
                'label'  => 'Item Description',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Item Description is required',
                ],
            ],
            'slc_editBidderNumber' => [
                'label'  => 'Bidder Number',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Bidder Number is required',
                ],
            ],
            'txt_editWinningAmount' => [
                'label'  => 'Amount',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Amount is required',
                ],
            ]
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $arrData = [
                'item_number'       => $fields['txt_editItemNumber'],
                'item_description'  => $fields['txt_editItemDescription'],
                'bidder_id'         => $fields['slc_editBidderNumber'],
                'winning_amount'    => $fields['txt_editWinningAmount'],
                'updated_by'        => $this->session->get('upp_user_id'),
                'updated_date'      => date('Y-m-d H:i:s')
            ];

            $result = $this->items->editItem($arrData, $fields['txt_itemId']);
            $msgResult[] = ($result > 0)? "Success" : "Database error";
        }
        else
        {
            $msgResult[] = $this->validation->getErrors();
        }

        return $this->response->setJSON($msgResult);
    }

    // public function removeItem()
    // {
    //     $fields = $this->request->getPost();

    //     $result = $this->items->removeItem($fields['itemId']);
    //     $msgResult[] = ($result > 0)? "Success" : "Database error";
    //     return $this->response->setJSON($msgResult);
    // }
}
