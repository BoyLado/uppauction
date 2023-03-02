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
    public function loadBidders()
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

        $builder = $this->db->table('bidders a')->select($columns)->orderBy('a.id','DESC');
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
}
