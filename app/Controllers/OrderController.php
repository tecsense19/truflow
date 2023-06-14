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
use App\Models\UserModel;
use App\Models\CouponModel;

class OrderController extends BaseController
{

    public function checkout()
{
    $session = session();
    $ordermodel = new OrderModel();
    $cartmodel = new CartModel();
    $couponmodel = new CouponModel();

    $headermenumodel = new HeaderMenuModel();
        $headerData = $headermenumodel->find();
        if (!$headerData) {
            $headerData = null;
        }

    $userId = $session->get('user_id');

    $query = $cartmodel->select('*')
        ->join('product_variants', 'product_variants.variant_id = add_to_cart.variant_id', 'left')
        ->join('product', 'product.product_id = product_variants.product_id', 'left')
        ->join('sub_category', 'sub_category.sub_category_id = product.sub_category_id', 'left')
        ->join('category', 'category.category_id = sub_category.category_id', 'left')
        ->join('users', 'users.user_id = add_to_cart.user_id', 'left')
        ->where('users.user_id', $userId)
        ->get();

    $cartData = $query->getResultArray();

    if (!$cartData) {
        $cartData = null;
    }

    $usermodel = new UserModel();
    $userData = $usermodel->where('user_id', $userId)->findAll();

    $couponData = null;
    if (isset($cartData) && !empty($cartData)) {
        $couponCode = ""; // Set the coupon code here or get it from the user input
        $couponData = $couponmodel->where('coupon_code', $couponCode)->findAll();
    }

    return view('front/checkout', [
        'cartData' => $cartData,
        'userData' => $userData,
        'couponData' => $couponData,
        'headerData' =>$headerData
    ]);
}

    public function place_order()
    {
        $ordermodel = new OrderModel();
        $session = session();
        $input = $this->request->getVar();
        $userId = $input['user_id'];
        //  echo "<pre>";
        // print_r($input);
        // die();

        $cartmodel = new CartModel();
        $query = $cartmodel->select('*')
            ->join('product_variants', 'product_variants.variant_id = add_to_cart.variant_id', 'left')
            ->join('product', 'product.product_id = product_variants.product_id', 'left')
            ->join('sub_category', 'sub_category.sub_category_id = product.sub_category_id', 'left')
            ->join('category', 'category.category_id = sub_category.category_id', 'left')
            ->join('users', 'users.user_id = add_to_cart.user_id', 'left')
            ->where('users.user_id', $userId)
            ->get();
        $cartData = $query->getResultArray();

        $orderArr = [];

        foreach ($cartData as $row) {
            $orderArr['coupon_code'] = isset($input['coupon']) ? $input['coupon'] : '';
            $orderArr['discount_type'] = isset($input['discount_type']) ? $input['discount_type'] : '';
            $orderArr['product_discount'] = isset($input['product_discount']) ? $input['product_discount'] : '';
            $orderArr['final_total_ammount'] = isset($input['final_total_ammount']) ? $input['final_total_ammount'] : '';


            $orderArr['shipping'] = isset($input['shipping']) ? $input['shipping'] : '';
            $orderArr['pay_method'] = isset($input['pay_method']) ? $input['pay_method'] : '';
            $orderArr['order_status'] = isset($input['order_status']) ? $input['order_status'] : '';
            $orderArr['user_id'] = isset($row['user_id']) ? $row['user_id'] : '';
            $orderArr['cart_id'] = isset($row['cart_id']) ? $row['cart_id'] : '';
            $orderArr['category_id'] = isset($row['category_id']) ? $row['category_id'] : '';
            $orderArr['sub_category_id'] = isset($row['sub_category_id']) ? $row['sub_category_id'] : '';
            $orderArr['product_id'] = isset($row['product_id']) ? $row['product_id'] : '';
            $orderArr['variant_id'] = isset($row['variant_id']) ? $row['variant_id'] : '';
            $orderArr['product_quantity'] = isset($row['product_quantity']) ? $row['product_quantity'] : '';
            $orderArr['product_amount'] = isset($row['product_amount']) ? $row['product_amount'] : '';

            $orderArr['total_amount'] = isset($row['total_amount']) ? $row['total_amount'] : '';

        //    echo "<pre>";
        //    print_r($orderArr);

            

            
            if (isset($row['order_id']) && $row['order_id'] != '') {
                $ordermodel->update(['order_id', $row['order_id']], $orderArr);
            } else {
                $ordermodel->insert($orderArr);
            }
            
            
        }
        $this->remove_checkout($userId);
        $session->setFlashdata('success', 'Order Placed successfully.');
         return redirect()->back();  
        //die();
    }
    public function remove_checkout($userId)
    {
        // print_r($userId);
        // die();
        $session = session();
        $cartmodel = new CartModel();
        $cartmodel->where('user_id', $userId)->delete();
        $session->setFlashdata('success', 'remove succesfully.');
        return redirect()->back();
    }

    public function check_coupon()
{
    $input = $this->request->getVar();

    $couponmodel = new CouponModel();
    $couponCode = isset($input['coupon']) ? $input['coupon'] : '';

    $couponData = $couponmodel->where('coupon_code', $couponCode)->findAll();

    if (!empty($couponData)) {
        // Coupon code exists in the database
        $response = ['status' => 'success', 'message' => 'Coupon code is valid', 'couponData' => $couponData];
    } else {
        // Coupon code does not exist in the database
        $response = ['status' => 'error', 'message' => 'Invalid coupon code'];
    }

    return $this->response->setJSON($response);
}





}
