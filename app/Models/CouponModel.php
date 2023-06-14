<?php

namespace App\Models; 
use CodeIgniter\Model;

class CouponModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'coupon';
    protected $primaryKey       = 'coupon_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'coupon_code',
        'coupon_price',
        'coupon_type',
        'user_id',
        'category_id',
        'sub_category_id',
        'product_id',
        'coupon_status',
        'isDeleted',
        'coupon_price_type',
        'from_date',
        'to_date'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

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
}