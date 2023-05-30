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
            ->join('users', 'users.user_id = add_to_cart.user_id', 'left')
            ->where('users.user_id', $userId)
            ->groupBy('users.user_id', $userId)
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
    public function place_order()
    {
        $ordermodel = new OrderModel();
        $session = session();
        $input = $this->request->getVar();
        $cart_id = $input['cart_id'];
        
        // echo "<pre>";
        // print_r($input);
        // die();

        $orderArr = [];

        
        $orderArr['pay_method'] = isset($input['pay_method']) ? $input['pay_method'] : '';
        $orderArr['user_id'] = isset($input['user_id']) ? $input['user_id'] : '';
        $orderArr['cart_id'] = isset($input['cart_id']) ? $input['cart_id'] : '';
        $orderArr['category_id'] = isset($input['category_id']) ? $input['category_id'] : '';
        $orderArr['sub_category_id'] = isset($input['sub_category_id']) ? $input['sub_category_id'] : '';
        $orderArr['product_id'] = isset($input['product_id']) ? $input['product_id'] : '';
        $orderArr['variant_id'] = isset($input['variant_id']) ? $input['variant_id'] : '';
        $orderArr['product_quantity'] = isset($input['product_quantity']) ? $input['product_quantity'] : '';
        $orderArr['product_amount'] = isset($input['product_amount']) ? $input['product_amount'] : '';
        $orderArr['product_discount'] = isset($input['product_discount']) ? $input['product_discount'] : '';
        $orderArr['total_amount'] = isset($input['total_amount']) ? $input['total_amount'] : '';


        if (isset($input['order_id']) && $input['order_id'] != '') {
            $ordermodel->update(['order_id', $input['order_id']], $orderArr);
        } else {
            $ordermodel->insert($orderArr);
        }
        $this->remove_checkout($cart_id);

        $session->setFlashdata('success', 'Order Placed succesfully.');
        return redirect()->back();

        
    }
    public function remove_checkout($cart_id)
    {
        $session = session();
        $cartmodel = new CartModel();
        $cartmodel->delete($cart_id);
        //$session->setFlashdata('success', 'remove succesfully.');
        return redirect()->back();
    }


}
