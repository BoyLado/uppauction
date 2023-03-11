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


    ////////////////////////////////////////////////////////////
    ///// BidderController->loadBidders()
    ////////////////////////////////////////////////////////////
    public function loadBidders($order, $textSearch = "")
    {
        $columns = [
            'a.id',
            'a.bidder_number',
            'a.first_name',
            'a.last_name',
            'a.address',
            'a.phone_number',
            'a.email',
            'a.id_number',
            'a.id_picture',
            'a.season_pass',
            'a.created_by',
            'a.created_date',
            'a.updated_by',
            'a.updated_date',
        ];

        $builder = $this->db->table('bidders a')->select($columns)->orderBy('a.id',$order);
        if($textSearch != "")
        {
            $builder->orLike('a.bidder_number',$textSearch);
            $builder->orLike('a.first_name',$textSearch);
            $builder->orLike('a.last_name',$textSearch);
            $builder->orLike('a.email',$textSearch);
        }
        $builder->where('a.status',1);
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// BidderController->addBidder()
    ////////////////////////////////////////////////////////////
    public function selectLastBidderNumber()
    {
        $columns = [
            'a.id',
            'a.bidder_number',
            'a.first_name',
            'a.last_name',
            'a.address',
            'a.phone_number',
            'a.email',
            'a.id_number',
            'a.id_picture',
            'a.season_pass',
            'a.created_by',
            'a.created_date',
            'a.updated_by',
            'a.updated_date',
        ];

        $builder = $this->db->table('bidders a')->select($columns);
        $builder->orderBy('a.id','DESC');
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// BidderController->addBidder()
    ////////////////////////////////////////////////////////////
    public function addBidder($arrData)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('bidders');
                $builder->insert($arrData);
                $insertId = $this->db->insertID();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? $insertId : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }


    ////////////////////////////////////////////////////////////
    ///// BidderController->selectBidder()
    ////////////////////////////////////////////////////////////
    public function selectBidder($bidderId)
    {
        $columns = [
            'a.id',
            'a.bidder_number',
            'a.first_name',
            'a.last_name',
            'a.address',
            'a.phone_number',
            'a.email',
            'a.id_number',
            'a.id_picture',
            'a.season_pass',
            'a.created_by',
            'a.created_date',
            'a.updated_by',
            'a.updated_date',
        ];

        $builder = $this->db->table('bidders a')->select($columns);
        $builder->where('a.id',$bidderId);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// BidderController->editBidder()
    ////////////////////////////////////////////////////////////
    public function editBidder($arrData, $bidderId)
    {
        try {
            $this->db->transStart();
                $this->db->table('bidders')
                        ->where(['id'=>$bidderId])
                        ->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// BidderController->removeBidder()
    ////////////////////////////////////////////////////////////
    public function removeBidder($bidderId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('bidders');
                $builder->where(['id'=>$bidderId]);
                $builder->update(['status'=>0]);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }


    ////////////////////////////////////////////////////////////
    ///// BidderController->checkOnDb()
    ////////////////////////////////////////////////////////////
    public function checkOnDb($bidderNumbers)
    {
        $columns = [
            'a.id',
            'a.bidder_number',
            'a.first_name',
            'a.last_name',
            'a.address',
            'a.phone_number',
            'a.email',
            'a.id_number',
            'a.id_picture',
            'a.created_by',
            'a.created_date',
            'a.updated_by',
            'a.updated_date',
        ];

        $builder = $this->db->table('bidders a')->select($columns);
        $builder->whereIn('a.bidder_number',$bidderNumbers);
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// BidderController->uploadSeasonPass()
    ////////////////////////////////////////////////////////////
    public function addBidders($arrData)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('bidders');
                $builder->insertBatch($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// BidderController->uploadSeasonPass()
    ////////////////////////////////////////////////////////////
    public function editBidders($arrData, $arrWhere)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('bidders');
                $builder->updateBatch($arrData, $arrWhere);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }


    ////////////////////////////////////////////////////////////
    ///// BidderController->uploadSeasonPass()
    ////////////////////////////////////////////////////////////
    public function loadRegisteredBidders($order, $textSearch = "", $dateFilter = "")
    {
        $columns = [
            'a.id',
            'a.auction_date',
            'a.confirmed',
            'a.confirmed_date',
            'a.created_date',
            'b.id as bidder_id',
            'b.bidder_number',
            'b.first_name',
            'b.last_name',
            'b.address',
            'b.phone_number',
            'b.email',
            'b.id_number',
            'b.id_picture',
            'b.season_pass'
        ];

        $builder = $this->db->table('bidder_registrations a');
        $builder->select($columns);
        $builder->join('bidders b','a.bidder_id = b.id','left');
        $builder->orderBy('a.id',$order);
        if($textSearch != "")
        {
            $builder->orLike('b.bidder_number',$textSearch);
            $builder->orLike('b.first_name',$textSearch);
            $builder->orLike('b.last_name',$textSearch);
            $builder->orLike('b.email',$textSearch);
        }
        if($dateFilter != "")
        {
            $builder->where('DATE_FORMAT(a.auction_date,"%Y-%m-%d")',$dateFilter);
        }
        $builder->where('b.status',1);
        $query = $builder->get();
        return  $query->getResultArray();
    }

    public function loadBidderDetails($bidderId)
    {
        $columns = [
            'a.id as registration_id',
            'a.auction_date',
            'a.confirmed',
            'a.confirmed_date',
            'a.created_date',
            'b.id as bidder_id',
            'b.bidder_number',
            'b.first_name',
            'b.last_name',
            'b.address',
            'b.phone_number',
            'b.email',
            'b.id_number',
            'b.id_picture',
            'b.season_pass'
        ];

        $builder = $this->db->table('bidder_registrations a');
        $builder->select($columns);
        $builder->join('bidders b','a.bidder_id = b.id','left');
        $builder->where('a.bidder_id',$bidderId);
        $builder->where('b.status',1);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    public function loadBidderGuests($registrationId)
    {
        $columns = [
            'a.id',
            'a.guest_first_name',
            'a.guest_last_name',
            'a.guest_email',
            'a.relation_to_bidder'
        ];

        $builder = $this->db->table('bidder_guests a');
        $builder->select($columns);
        $builder->where('a.registration_id',$registrationId);
        $query = $builder->get();
        return  $query->getResultArray();
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
