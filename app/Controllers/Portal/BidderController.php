<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class BidderController extends BaseController
{
    public function __construct()
    {
        $this->bidders = model('Portal/Bidders');
        helper('phpspreadsheet_helper');
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
        $fields = $this->request->getPost();

        $bidderNumber = $this->bidders->selectLastBidderNumber();

        $imageFile = $this->request->getFile('idPicture');

        if($imageFile != null)
        {
            $newFileName = $imageFile->getRandomName();
            $imageFile->move(ROOTPATH . 'public/assets/uploads/images/bidders', $newFileName);

            if($imageFile->hasMoved())
            {
                $arrPictureData = [
                    'bidder_number' => (int)$bidderNumber['bidder_number'] + 1,
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
            'txt_editBidderNumber' => [
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
                'bidder_number' => $fields['txt_editBidderNumber'],
                'first_name'    => $fields['txt_firstName'],
                'last_name'     => $fields['txt_lastName'],
                'address'       => $fields['txt_address'],
                'phone_number'  => $fields['txt_phoneNumber'],
                'email'         => $fields['txt_email'],
                'id_number'     => $fields['txt_idNumber'],
                'season_pass'   => $fields['txt_seasonPassLink'],
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

    function checkOnDb($forUpload = [])
    {
        $bidderNumbers = [];
        foreach($forUpload as $key => $value)
        {
            $bidderNumbers[] = $value['bidder_number'];
        }

        $resultForUpdate = $this->bidders->checkOnDb($bidderNumbers);

        $forUpdate = [];
        $forInsert = [];
        foreach ($forUpload as $key1 => $value1) 
        {
            $existing = false;
            $showInfo = false;
            if($resultForUpdate != null)
            {
                foreach ($resultForUpdate as $key2 => $value2) 
                {
                    if($value1['bidder_number'] == $value2['bidder_number'])
                    {
                        $existing = true;
                    }
                }
            }            

            if($existing)
            {
                // for update
                $forUpdate[] = $value1;
            }
            else
            {
                // for insert
                $forInsert[] = $value1;
            }
        }

        $arrDbResult['forUpdate'] = $forUpdate;
        $arrDbResult['forInsert'] = $forInsert;

        return $arrDbResult;

        // return $resultForUpdate;
    }

    public function checkUploadFile()
    {
        $file = $this->request->getFile('seasonPassList');

        if ($file->isValid() && ! $file->hasMoved()) 
        {
            $file_data = $file->getName();
            $path = $file->getTempName();

            $ext = pathinfo($path, PATHINFO_EXTENSION);

            $arrData = readUploadFile($path);

            $validColumns = [];
            foreach($arrData[0] as $key => $value)
            {
                $arrVal = ["NULL","null","","N/A","n/a","NA","na"];
                if(!in_array($value,$arrVal))
                {
                    $validColumns[] = $value;
                }
            }
            array_shift($arrData);
            $arrResult = [];
            $arrResult['upload_res'] = "";
            if(count($validColumns) == 7 && count($arrData) > 0)
            {
                $newArrData = [];
                foreach ($arrData as $key => $value) 
                {
                    $newArrData[] = [
                        'bidder_number'     => checkData($value[0]),
                        'first_name'        => checkData($value[1]),
                        'last_name'         => checkData($value[2]),
                        'email'             => checkData($value[3]),
                        'phone_number'    => checkData($value[4]),
                        'address'           => checkData($value[5]),
                        'season_pass'       => checkData($value[6])
                    ];
                }
                $uniqueColumns = ['bidder_number'];
                $checkDuplicateResult = checkDuplicateRows($newArrData, $uniqueColumns);

                // $arrResult[] = $checkDuplicateResult;

                if(count($checkDuplicateResult['rowData']) > 0)
                {
                    $checkOnDbResult = $this->checkOnDb($checkDuplicateResult['rowData']);

                    // $arrResult[] = $checkOnDbResult;

                    $arrResult['for_update'] = $checkOnDbResult['forUpdate'];
                    $arrResult['for_insert'] = $checkOnDbResult['forInsert'];
                    $arrResult['conflict_rows'] = $checkDuplicateResult['rowConflictData'];
                }
                else
                {
                    $arrResult['for_update'] = [];
                    $arrResult['for_insert'] = [];
                    $arrResult['conflict_rows'] = $checkDuplicateResult['rowConflictData'];
                }
                

                // $checkFileResult = checkDuplicate($newArrData);

                // $checkOnDb = $this->checkOnDb((array)$checkFileResult['forUploadRows']);

                
                // $this->arrConflictData = "Hello World";
                // $arrResult['duplicate_handling'] = $handling;

                // $arrResult['rawData'] = $checkResult;
            }
            else
            {
                $arrResult['upload_res'] = "Invalid file, maybe columns does not match or no data found!";
            }    
        }
        else
        {
            $arrResult[] = "Invalid File";
        }

        

        return $this->response->setJSON($arrResult);
    }

    public function uploadSeasonPass()
    {
        $fields = $this->request->getPost();

        $forInsert = (isset($fields['rawData']['forInsert']))? json_decode($fields['rawData']['forInsert'],true) : [];
        $forUpdate = (isset($fields['rawData']['forUpdate']))? json_decode($fields['rawData']['forUpdate'],true) : [];

        $arrWhere = 'bidder_number';

        //insert
        $uploadResult['inserted_rows'] = (count($forInsert) > 0)?$this->bidders->addBidders($forInsert) : 0;
        //update 
        $uploadResult['updated_rows'] = (count($forUpdate) > 0)?$this->bidders->editBidders($forUpdate, $arrWhere) : 0;

        return $this->response->setJSON($uploadResult);
    }
}
