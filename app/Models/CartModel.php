<?php

namespace App\Models;  
use CodeIgniter\Model;

class CartModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'add_to_cart';
    protected $primaryKey       = 'cart_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'category_id',
        'sub_category_id',
        'product_id',
        'variant_id',
        'product_quantity',
        'product_amount',
        'product_discount',
        'total_amount',
        'shipping',
        'discount_type',
        'final_total_ammount',
        'coupon_code',
        'product_url'
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