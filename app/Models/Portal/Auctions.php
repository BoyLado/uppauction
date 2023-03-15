<?php

namespace App\Models\Portal;

use CodeIgniter\Model;

class Auctions extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'auctions';
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
    ///// AuctionController->loadAuctions()
    ///// PreRegistrationController->loadAuctions()
    ////////////////////////////////////////////////////////////
    public function loadAuctions($whereParams = [])
    {
        $columns = [
            'a.id',
            'a.auction_title',
            'a.auction_description',
            'DATE_FORMAT(a.auction_date,"%Y-%m-%d") as auction_date',
            'a.status',
            'a.created_by',
            'a.created_date',
            'a.updated_by',
            'a.updated_date',
        ];

        $builder = $this->db->table('auctions a');
        $builder->select($columns);
        $builder->where('a.status',1);
        if(count($whereParams) > 0)
        {
            $builder->where($whereParams);
        }
        $builder->orderBy('a.auction_date','ASC');
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// AuctionController->addAuction()
    ////////////////////////////////////////////////////////////
    public function addAuction($arrData)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('auctions');
                $builder->insert($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }


    ////////////////////////////////////////////////////////////
    ///// AuctionController->selectAuction()
    ////////////////////////////////////////////////////////////
    public function selectAuction($auctionId)
    {
        $columns = [
            'a.id',
            'a.auction_title',
            'a.auction_description',
            'DATE_FORMAT(a.auction_date,"%Y-%m-%d") as auction_date',
            'a.status',
            'a.created_by',
            'a.created_date',
            'a.updated_by',
            'a.updated_date',
        ];

        $builder = $this->db->table('auctions a')->select($columns);
        $builder->where('a.id',$auctionId);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// AuctionController->editAuction()
    ////////////////////////////////////////////////////////////
    public function editAuction($arrData, $auctionId)
    {
        try {
            $this->db->transStart();
                $this->db->table('auctions')
                        ->where(['id'=>$auctionId])
                        ->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// AuctionController->removeAuction()
    ////////////////////////////////////////////////////////////
    public function removeAuction($auctionId)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('auctions');
                $builder->where(['id'=>$auctionId]);
                $builder->update(['status'=>0]);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }


}
