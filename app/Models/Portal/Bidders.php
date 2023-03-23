<?php

namespace App\Models\Portal;

use CodeIgniter\Model;

class Bidders extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bidders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];



    ///////////////////////////////////////////// OUTSIDE SCRIPTS ///////////////////////////////////

    ////////////////////////////////////////////////////////////
    ///// IndexController->login();
    ////////////////////////////////////////////////////////////
    public function validateLogIn($logInRequirements)
    {
        $columns = [
          'id as bidder_id',
          'first_name',
          'last_name'
        ];

        $where = [
            'email'     => $logInRequirements['email'],
            'password'  => $logInRequirements['password'],
            'status'    => 1 
        ];

        $builder = $this->db->table('bidders')->select($columns)->where($where);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// IndexController->forgotPassword();
    ////////////////////////////////////////////////////////////
    public function createPasswordAuthCode($arrData, $emailReceiver)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('bidders');
                $builder->where('email',$emailReceiver);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// IndexController->forgotPassword();
    ///// PaymentController->createPayment();
    ////////////////////////////////////////////////////////////
    public function selectBidder($whereParams)
    {
        $columns = [
            'a.id as bidder_id',
            'a.bidder_number',
            'a.first_name',
            'a.last_name',
            'a.address',
            'a.phone_number',
            'a.email',
            'a.auth_code',
            'a.id_number',
            'a.id_picture',
            'a.season_pass',
            'a.created_by',
            'a.created_date',
            'a.updated_by',
            'a.updated_date',
        ];

        $builder = $this->db->table('bidders a')->select($columns);
        $builder->where($whereParams);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// IndexController->changePassword()
    ////////////////////////////////////////////////////////////
    public function changePassword($arrData, $whereParams)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('bidders');
                $builder->where($whereParams);
                $builder->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }


    ////////////////////////////////////////////////////////////
    ///// MyAccountController->loadProfile()
    ////////////////////////////////////////////////////////////
    public function loadProfile($bidderId)
    {
        $columns = [
          'id as bidder_id',
          'CONCAT(first_name," ",last_name) as complete_name'
        ];

        $builder = $this->db->table('bidders')->select($columns)->where('id',$bidderId);
        $query = $builder->get();
        return  $query->getRowArray();
    }



    /* -------------------------- FRONTEND FUNCTIONALITY ------------------------------ */ 

    ////////////////////////////////////////////////////////////
    ///// PreRegistrationController->preRegistrationWithSeasonPass()
    ////////////////////////////////////////////////////////////
    public function validateBidder($emailAddress,$seasonPassNumber)
    {
        $columns = [
            'a.id',
            'a.bidder_number',
            'a.email',
            'a.season_pass'
        ];

        $builder = $this->db->table('bidders a')->select($columns);
        $builder->where('a.email',$emailAddress);
        $builder->where('a.bidder_number',$seasonPassNumber);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// PreRegistrationController->preRegistrationWithoutSeasonPass()
    ////////////////////////////////////////////////////////////
    public function validateEmail($emailAddress)
    {
        $columns = [
            'a.id',
            'a.bidder_number',
            'a.email',
        ];

        $builder = $this->db->table('bidders a')->select($columns);
        $builder->where('a.email',$emailAddress);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// PreRegistrationController->preRegistrationWithoutSeasonPass()
    ////////////////////////////////////////////////////////////
    public function loadMaxBidder()
    {
        $columns = [
            'a.id',
            'COUNT(a.bidder_number) as max_bidder_number',
        ];

        $builder = $this->db->table('bidders a')->select($columns);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// PreRegistrationController->preRegistrationWithSeasonPass()
    ////////////////////////////////////////////////////////////
    public function addBidderRegistration($arrData)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('bidder_registrations');
                $builder->insert($arrData);
                $insertId = $this->db->insertID();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? $insertId : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// PreRegistrationController->preRegistrationWithSeasonPass()
    ////////////////////////////////////////////////////////////
    public function addBidderGuest($arrData)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('bidder_guests');
                $builder->insertBatch($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// PreRegistrationController->confirmPreRegistration()
    ////////////////////////////////////////////////////////////
    public function editBidderRegistration($arrData, $whereParams)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('bidder_registrations');
                $builder->where($whereParams);
                $builder->update($arrData);
                $id = $this->db->affectedRows();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? $id : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

}
