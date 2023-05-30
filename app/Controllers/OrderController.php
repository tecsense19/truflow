<?php

namespace App\Controllers;

use App\Models\SettingsModel;
use App\Models\SettingsImagesModel;
use App\Models\TestominalModel;
use App\Models\HeaderMenuModel;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use App\Models\ProductModel;
use App\Models\VariantsModel;
use App\Models\CartModel;
use App\Models\OrderModel;

class OrderController extends BaseController
{
   
    public function checkout()
    {

        $session = session();
        $ordermodel = new OrderModel();
        $cartmodel = new CartModel();
        $userId = $session->get('user_id');

        $query = $cartmodel->select('*')
            ->join('product_variants', 'product_variants.variant_id = add_to_cart.variant_id', 'left')
            ->join('product', 'product.product_id = product_variants.product_id', 'left')
            ->join('sub_category', 'sub_category.sub_category_id = product.sub_category_id', 'left')
            ->join('category', 'category.category_id = sub_category.category_id', 'left')
            ->where('user_id', $userId)
            ->get();

        $cartData = $query->getResultArray();
        // echo "<pre>";
        // print_r($cartData);
        // die();

        if (!$cartData) {
            $cartData = null;
        }
        return view('front/checkout', [
            'cartData' => $cartData,
        ]);
    }
}
