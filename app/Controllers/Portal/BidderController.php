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
        $this->validation->setRules([
            'txt_addBidderNumber' => [
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

            $validateBidderNumber = $this->bidders->validateBidderNumber($fields['txt_addBidderNumber']);

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
                            'bidder_number' => $fields['txt_addBidderNumber'],
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
                $msgResult[] = "Bidder Number (".$fields['txt_addBidderNumber'].") exist!";
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
        $emails = [];
        foreach($forUpload as $key => $value)
        {
            $emails[] = $value['email'];
        }

        $resultForUpdate = $this->bidders->checkOnDb($emails);

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
                    if($value1['email'] == $value2['email'])
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

        $arrDbResult['forIgnore'] = $emails;
        $arrDbResult['forUpdate'] = $forUpdate;
        $arrDbResult['forInsert'] = $forInsert;

        return $arrDbResult;
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
            if(count($validColumns) == 10 && count($arrData) > 0)
            {
                $newArrData = [];
                foreach ($arrData as $key => $value) 
                {
                    $newArrData[] = [
                        'date_of_purchase'  => checkData($value[1]),
                        'first_name'        => checkData($value[2]),
                        'last_name'         => checkData($value[3]),
                        'email'             => checkData($value[4]),
                        'contact_number'    => checkData($value[5]),
                        'address'           => checkData($value[6]),
                        'user_name'         => checkData($value[7]),
                        'season_pass'       => checkData($value[8]),
                        'remarks'           => checkData($value[9])
                    ];
                }
                $uniqueColumns = ['email'];
                $checkDuplicateResult = checkDuplicateRows($newArrData, $uniqueColumns);

                // $arrResult[] = $checkDuplicateResult;

                if(count($checkDuplicateResult['rowData']) > 0)
                {
                    $checkOnDbResult = $this->checkOnDb($checkDuplicateResult['rowData']);

                    $arrResult['for_update'] = $checkOnDbResult['forUpdate'];
                    $arrResult['for_insert'] = $checkOnDbResult['forInsert'];
                    $arrResult['for_ignore'] = $checkOnDbResult['forIgnore'];
                    $arrResult['conflict_rows'] = $checkDuplicateResult['rowConflictData'];
                }
                else
                {
                    $arrResult['for_update'] = [];
                    $arrResult['for_insert'] = [];
                    $arrResult['for_ignore'] = [];
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
    }
}
