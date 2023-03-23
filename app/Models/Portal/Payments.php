<?php

namespace App\Models\Portal;

use CodeIgniter\Model;

class Payments extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'payments';
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
    ///// PaymentsController->loadPayments()
    ////////////////////////////////////////////////////////////
    public function loadPayments($whereParams)
    {
        $columns = [
            'a.id',
            'a.bidder_id',
            '(SELECT CONCAT(first_name, " ", last_name) FROM bidders WHERE id = a.bidder_id) as bidder_name',
            '(SELECT bidder_number FROM bidders WHERE id = a.bidder_id) as bidder_number',
            'a.items_id',
            'a.sub_total',
            'a.tax',
            'a.card_transaction_fee',
            'a.cash_payment',
            'a.card_payment',
            'a.total_payment',
            'a.status',
            'a.created_by',
            'a.created_date',
        ];

        $builder = $this->db->table('payments a');
        $builder->select($columns);
        $builder->where($whereParams);
        $builder->orderBy('a.created_date','DESC');
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// PaymentsController->loadPaymentDetails()
    ////////////////////////////////////////////////////////////
    public function loadPaymentDetails($itemsId)
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
        $builder->whereIn('a.id',$itemsId);
        $builder->orderBy('a.id','DESC');
        $query = $builder->get();
        return  $query->getResultArray();
    }

    ////////////////////////////////////////////////////////////
    ///// PaymentsController->addPayment()
    ////////////////////////////////////////////////////////////
    public function addPayment($arrData)
    {
        try {
            $this->db->transStart();
                $builder = $this->db->table('payments');
                $builder->insert($arrData);
                $insertId = $this->db->insertID();
            $this->db->transComplete();
            return ($this->db->transStatus() === TRUE)? $insertId : 0;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    ////////////////////////////////////////////////////////////
    ///// PaymentsController->loadPaymentDetails()
    ////////////////////////////////////////////////////////////
    public function selectPayment($paymentId)
    {
        $columns = [
            'a.id',
            'a.bidder_id',
            '(SELECT CONCAT(first_name, " ", last_name) FROM bidders WHERE id = a.bidder_id) as bidder_name',
            '(SELECT bidder_number FROM bidders WHERE id = a.bidder_id) as bidder_number',
            'a.items_id',
            'a.sub_total',
            'a.tax',
            'a.card_transaction_fee',
            'a.cash_payment',
            'a.card_payment',
            'a.total_payment',
            'a.status',
            'a.created_by',
            'a.created_date',
        ];

        $builder = $this->db->table('payments a');
        $builder->select($columns);
        $builder->where('a.status',1);
        $builder->where('a.id',$paymentId);
        $query = $builder->get();
        return  $query->getRowArray();
    }
}
