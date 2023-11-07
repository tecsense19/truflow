<?php

namespace App\Models;
use CodeIgniter\Model;

class VariantsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'product_variants';
    protected $primaryKey       = 'variant_id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'product_id',
        'variant_name',
        'parent',
        'variant_price',
        'variant_sku',
        'variant_stock',
        'variant_description',
        'variant_header',
        'variant_header_1',
        'variant_description_1',
        'variant_header_2',
        'variant_description_2',
        'variant_header_3',
        'variant_description_3',
        'group_name',
        'sort',
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