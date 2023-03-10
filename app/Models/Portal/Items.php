<?php

namespace App\Models\Portal;

use CodeIgniter\Model;

class Items extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'items';
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
    ///// ItemController->loadItems()
    ////////////////////////////////////////////////////////////
    public function loadItems($dateNow)
    {
        $columns = [
            'a.id',
            'a.item_number',
            'a.item_description',
            'a.bidder_id',
            '(SELECT bidder_number FROM bidders WHERE id = a.bidder_id) as bidder_number',
            '(SELECT CONCAT(first_name," ",last_name) FROM bidders WHERE id = a.bidder_id) as bidder_name',
            'a.winning_amount',
            'a.paid',
            'a.created_by',
            'a.created_date',
            'a.updated_by',
            'a.updated_date',
        ];

        $builder = $this->db->table('items a');
        $builder->select($columns);
        $builder->where('DATE_FORMAT(a.created_date,"%Y-%m-%d")',$dateNow);
        $builder->orderBy('a.id','DESC');
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// ItemController->addItem()
    ////////////////////////////////////////////////////////////
    public function addItem($arrData)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('items');
                $builder->insert($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }


    ////////////////////////////////////////////////////////////
    ///// ItemController->selectItem()
    ////////////////////////////////////////////////////////////
    public function selectItem($itemId)
    {
        $columns = [
            'a.id',
            'a.item_number',
            'a.item_description',
            'a.bidder_id',
            '(SELECT bidder_number FROM bidders WHERE id = a.bidder_id) as bidder_number',
            '(SELECT CONCAT(first_name," ",last_name) FROM bidders WHERE id = a.bidder_id) as bidder_name',
            'a.winning_amount',
            'a.paid',
            'a.created_by',
            'a.created_date',
            'a.updated_by',
            'a.updated_date',
        ];

        $builder = $this->db->table('items a')->select($columns);
        $builder->where('a.id',$itemId);
        $query = $builder->get();
        return  $query->getRowArray();
    }

    ////////////////////////////////////////////////////////////
    ///// ItemController->editItem()
    ////////////////////////////////////////////////////////////
    public function editItem($arrData, $itemId)
    {
        try {
            $this->db->transStart();
                $this->db->table('items')
                        ->where(['id'=>$itemId])
                        ->update($arrData);
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// ItemController->removeItem()
    ////////////////////////////////////////////////////////////
    // public function removeItem($itemId)
    // {
    //     try {
    //         $this->db->transStart();
    //             $builder = $this->db->table('items');
    //             $builder->where(['id'=>$itemId]);
    //             $builder->update(['status'=>0]);
    //         $this->db->transComplete();
    //         return ($this->db->transStatus() === TRUE)? 1 : 0;
    //     } catch (PDOException $e) {
    //         throw $e;
    //     }
    // }



    /////////////////////////////////////////////// WINNERS /////////////////////////////////////////////////



    ////////////////////////////////////////////////////////////
    ///// ItemController->loadWinners()
    ////////////////////////////////////////////////////////////
    public function loadWinners($order,$dateFilter,$textSearch)
    {
        $columns = [
            'a.id',
            'a.bidder_number',
            'a.first_name',
            'a.last_name',
            'a.email',
            'a.season_pass',
            'DATE_FORMAT(b.created_date,"%Y-%m-%d") as created_date',
        ];

        $builder = $this->db->table('bidders a');
        $builder->select($columns);
        if($textSearch != "")
        {
            $builder->groupStart();
                $builder->orLike('a.bidder_number',$textSearch);
                $builder->orLike('a.first_name',$textSearch);
                $builder->orLike('a.last_name',$textSearch);
                $builder->orLike('a.email',$textSearch);
            $builder->groupEnd();
        }
        $builder->join('items b','a.id = b.bidder_id','inner');
        $builder->groupBy('a.bidder_number');
        $builder->orderBy('a.id','DESC');
        $builder->where('DATE_FORMAT(b.created_date,"%Y-%m-%d")',$dateFilter);
        $query = $builder->get();
        return  $query->getResultArray();
    }   

    ////////////////////////////////////////////////////////////
    ///// ItemController->loadWinnerItems()
    ////////////////////////////////////////////////////////////
    public function loadWinnerItems($bidderId, $dateNow)
    {
        $columns = [
            'a.id',
            'a.item_number',
            'a.item_description',
            'a.bidder_id',
            '(SELECT bidder_number FROM bidders WHERE id = a.bidder_id) as bidder_number',
            '(SELECT CONCAT(first_name," ",last_name) FROM bidders WHERE id = a.bidder_id) as bidder_name',
            'a.winning_amount',
            'a.paid',
            'a.created_by',
            'a.created_date',
            'a.updated_by',
            'a.updated_date',
        ];

        $builder = $this->db->table('items a');
        $builder->select($columns);
        $builder->where('a.bidder_id', $bidderId);
        $builder->where('DATE_FORMAT(a.created_date,"%Y-%m-%d")', $dateNow);
        $builder->orderBy('a.id','DESC');
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// PaymentController->addPayment()
    ////////////////////////////////////////////////////////////
    public function changeStatus($arrData)
    {
        try {
            $this->db->transStart();
                $this->db->table('items')->updateBatch($arrData,'id');
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? 1 : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }   
}
