<?php

namespace App\Controllers\Portal;

use App\Controllers\BaseController;

class MyAccountController extends BaseController
{
    public function __construct()
    {
        $this->bidders = model('Portal/Bidders');
    }


    ////////////////////////////////////////////////////////////////////
    ///// USER PROFILE SCRIPTS
    ////////////////////////////////////////////////////////////////////
    public function loadMyAccount()
    {
        $bidderId = $this->session->get('upp_bidder_id');

        $arrResult = $this->bidders->loadProfile($bidderId);
        return $this->response->setJSON($arrResult);
    }

    public function changeMyAccountPicture()
    {
        $this->validation->setRules([
            'profilePicture' => [
                'label'  => 'Profile Picture',
                'rules'  => 'uploaded[profilePicture]|max_size[profilePicture,3024]|ext_in[profilePicture,jpeg,jpg,png,gif]',
                'errors' => [
                    'max_size'    => 'Max size is 3024 KB',
                    'ext_in'      => 'Invalid file extention'
                ],
            ],
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $userId = $this->session->get('upp_user_id');
            $imageFile = $this->request->getFile('profilePicture');

            $newFileName = $imageFile->getRandomName();
            $imageFile->move(ROOTPATH . 'public/assets/uploads/images/users', $newFileName);

            if($imageFile->hasMoved())
            {
                $whereParams = ['id' => $userId];
                $arrResult = $this->users->loadUser($whereParams);

                if($arrResult['picture'] != null)
                {
                    unlink(ROOTPATH . 'public/assets/uploads/images/users/' . $arrResult['picture']);
                }                

                $arrData = [
                    'picture'      => $newFileName,
                    'updated_date' => date('Y-m-d H:i:s')
                ];

                $result = $this->users->changeProfilePicture($arrData, $userId);
                $msgResult[] = ($result > 0)? "Success" : "Database error";
            }
        }
        else
        {
            $msgResult[] = $this->validation->getErrors();
        }
        return $this->response->setJSON($msgResult);
    }

    public function loadMyAccountDetails()
    {
        $userId = $this->session->get('upp_user_id');

        $arrResult = $this->users->loadDetails($userId);
        return $this->response->setJSON($arrResult);
    }

    public function editMyAccountDetails()
    {
        $this->validation->setRules([
            'txt_firstName' => [
                'label'  => 'First Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'First Name is required'
                ],
            ],
            'txt_lastName' => [
                'label'  => 'Last Name',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Last Name is required'
                ],
            ],
            'txt_position' => [
                'label'  => 'Position',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Position is required'
                ],
            ],
            'txt_email' => [
                'label'  => 'Email Address',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required'    => 'User Email is required',
                    'valid_email' => 'User Email must be valid'
                ],
            ],
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();
            $userId = $this->session->get('upp_user_id');

            $arrData = [
                'first_name'    => $fields['txt_firstName'],
                'last_name'     => $fields['txt_lastName'],
                'position'      => $fields['txt_position'],
                'user_email'    => $fields['txt_email'],
                'updated_date'  => date('Y-m-d H:i:s')
            ];

            $result = $this->users->editDetails($arrData, $userId);
            $msgResult[] = ($result > 0)? "Success" : "Database error";
        }
        else
        {
            $msgResult[] = $this->validation->getErrors();
        }
        
        return $this->response->setJSON($msgResult);
    }

    public function editMyAccountPassword()
    {
        $this->validation->setRules([
            'txt_oldPassword' => [
                'label'  => 'Old Password',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'Old Password is required'
                ],
            ],
            'txt_newPassword' => [
                'label'  => 'New Password',
                'rules'  => 'required',
                'errors' => [
                    'required'    => 'New Password is required'
                ],
            ],
        ]);

        if($this->validation->withRequest($this->request)->run())
        {
            $fields = $this->request->getPost();
            $userId = $this->session->get('upp_user_id');

            $arrResult = $this->users->loadDetails($userId);

            $arrWhere = [
                'id' => $userId,
                'user_password' => encrypt_code($fields['txt_oldPassword']),
                'user_name' => $arrResult['user_name'],
                'user_email' => $arrResult['user_email']
            ];

            $checkOldPassword = $this->users->validateLogIn($arrWhere);

            if(!empty($checkOldPassword))
            {
                $arrData = [
                    'user_password' => encrypt_code($fields['txt_newPassword'])
                ];

                $result = $this->users->editPassword($arrData, $userId);
                $msgResult[] = ($result > 0)? "Success" : "Database error";
            }
            else
            {
                $msgResult[] = 'Old Password is Incorrect!';
            }
        }
        else
        {
            $msgResult[] = $this->validation->getErrors();
        }

        return $this->response->setJSON($msgResult);
    }

    public function addRole()
    {
        $arrAccessModules = ['dashboard'=>[1],'marketing'=>[1,0,1,0],'employees'=>[1]];
        $arrAccessFields = ['campaigns'=>[[2],[1,0,1,0]],'contacts'=>[[1],[1,0,1]]];

        $arrRoles = [
            'role_name'         => 'Admin',
            'access_modules'    => json_encode($arrAccessModules),
            'access_fields'     => json_encode($arrAccessFields),
        ];

        $this->users->addRole($arrRoles);
    }

    public function selectRole($roleId)
    {
        $arrResult = $this->users->selectRole($roleId);

        return $this->response->setJSON($arrResult);
    }
}
