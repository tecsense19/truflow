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
use App\Models\ShippingModel;
use App\Models\OrderItemModel;


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

    // $query = $cartmodel->select('*')
    //     ->join('product_variants', 'product_variants.variant_id = add_to_cart.variant_id', 'left')
    //     ->join('product', 'product.product_id = product_variants.product_id', 'left')
    //     ->join('sub_category', 'sub_category.sub_category_id = product.sub_category_id', 'left')
    //     ->join('category', 'category.category_id = sub_category.category_id', 'left')
    //     ->join('users', 'users.user_id = add_to_cart.user_id', 'left')
    //     ->where('users.user_id', $userId)
    //     ->get();

    // $cartData = $query->getResultArray();

    $query = $cartmodel->select('*')
    ->join('product_variants', 'product_variants.variant_id = add_to_cart.variant_id', 'left')
    ->join('product', 'product.product_id = product_variants.product_id', 'left')
    ->join('sub_category', 'sub_category.sub_category_id = product.sub_category_id', 'left')
    ->join('category', 'category.category_id = sub_category.category_id', 'left')
    ->join('users', 'users.user_id = add_to_cart.user_id', 'left')
    ->join('company', 'company.company_name = users.company_name', 'left')
    ->where('add_to_cart.user_id', $userId)
    //->where('company.company_name', $componey_name)
    ->get();


        $cartData = $query->getResultArray();

    if (!$cartData) {
        $cartData = null;
    }

    $usermodel = new UserModel();
    $userData = $usermodel->where('user_id', $userId)->findAll();

    $couponData = null;
    if (isset($cartData) && !empty($cartData)) {
        $couponCode = ""; 
        $couponData = $couponmodel->where('coupon_code', $couponCode)->findAll();
    }

    return view('front/checkout', [
        'cartData' => $cartData,
        'userData' => $userData,
        'couponData' => $couponData,
        'headerData' =>$headerData
    ]);
}

    public function place_order(){
        $ordermodel = new OrderModel();
        $shippingmodel = new ShippingModel();
        $orderitemmodel = new OrderItemModel();
        $session = session();
        $input = $this->request->getVar();

        $user_id = $this->request->getVar('user_id');
        $discount_type = $this->request->getVar('discount_type');
        $product_discount = $this->request->getVar('product_discount');
        $final_total_ammount = $this->request->getVar('final_total_ammount');
        $coupon = $this->request->getVar('coupon');
        $pay_method = $this->request->getVar('pay_method');
        $order_status = $this->request->getVar('order_status');
        $shipping = $this->request->getVar('shipping');
        $notes = $this->request->getVar('notes');
        $ship_to_diff_address = $this->request->getVar('ship_to_diff_address');

        $data = array(
            'user_id' =>$user_id,
            'discount_type' =>$discount_type,
            'product_discount' =>$product_discount,
            'final_total_ammount' =>$final_total_ammount,
            'coupon_code' =>$coupon,
            'pay_method' =>$pay_method,
            'order_status' =>$order_status,
            'shipping' =>$shipping,
            'notes' =>$notes,
            'ship_to_diff_address' =>$ship_to_diff_address
        );

        $order_id = $ordermodel->insert($data);

        $userId = $input['user_id'];
       
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
            
            $orderArr['order_id'] = $order_id;
            $orderArr['category_id'] = isset($row['category_id']) ? $row['category_id'] : '';
            $orderArr['sub_category_id'] = isset($row['sub_category_id']) ? $row['sub_category_id'] : '';
            $orderArr['product_id'] = isset($row['product_id']) ? $row['product_id'] : '';
            $orderArr['variant_id'] = isset($row['variant_id']) ? $row['variant_id'] : '';
            $orderArr['product_quantity'] = isset($row['product_quantity']) ? $row['product_quantity'] : '';
            $orderArr['product_amount'] = isset($row['product_amount']) ? $row['product_amount'] : '';
            $orderArr['product_quantity'] = isset($row['product_quantity']) ? $row['product_quantity'] : '';
            $orderArr['total_amount'] = isset($row['total_amount']) ? $row['total_amount'] : '';
            $orderitemmodel->insert($orderArr);
         
        }
            helper('session');
            $session->remove('coupon_code');
            $session->remove('discount_type');
            $session->remove('product_discount');
            $session->remove('final_total_ammount');
            $session->remove('discount_d');
            $session->remove('shipping');
            $session->remove('cartCount');

        $this->remove_checkout($userId);
        $this->shipping_add($userId,$order_id);
        $session->setFlashdata('success', 'Order Placed successfully.');
      
         return redirect()->back();  
        //die();
    }
    public function remove_checkout($userId)
    {
        $session = session();
       
        $cartmodel = new CartModel();
        $cartmodel->where('user_id', $userId)->delete();
        $session->setFlashdata('success', 'remove succesfully.');
        return redirect()->back();
    }
    public function shipping_add($userId,$order_id){

        $shippingmodel = new ShippingModel();
        $ordermodel = new OrderModel();
        $session = session();
        $input = $this->request->getVar();

        $query = $ordermodel->select('*')
        ->join('users', 'users.user_id = tbl_order.user_id', 'left')
        ->where('users.user_id', $userId)
        ->where('tbl_order.order_id', $order_id)
        ->get();
        $orderData = $query->getResultArray();

        $usermodel = new UserModel();




        // echo "<pre>";
        // print_r($orderData);
        // die();
        $orderArr = [];

    foreach ($orderData as $row) {
        if (isset($input['ship_to_diff_address'])) {
            $orderArr['city'] = isset($input['city']) ? $input['city'] : '';
            $orderArr['address_1'] = isset($input['address_1']) ? $input['address_1'] : '';
            $orderArr['address_2'] = isset($input['address_2']) ? $input['address_2'] : '';
        } else {
            
            $orderArr['city'] = isset($row['city']) ? $row['city'] : '';
            $orderArr['address_1'] = isset($row['address_1']) ? $row['address_1'] : '';
            $orderArr['address_2'] = isset($row['address_2']) ? $row['address_2'] : '';
        }
        $orderArr['user_id'] = isset($row['user_id']) ? $row['user_id'] : '';
        $orderArr['order_id'] = isset($row['order_id']) ? $row['order_id'] : '';

        if (isset($input['shipping_id']) && $input['shipping_id'] != '') {
            $shippingmodel->update(['shipping_id', $row['shipping_id']], $orderArr);
        } else {
            $shippingmodel->insert($orderArr);
        }

    }
    return redirect()->back();  
    }

public function check_coupon()
{
    $input = $this->request->getVar();

    $couponmodel = new CouponModel();
    $company_id = isset($input['company_id']) ? $input['company_id'] : '';

    $currentDate = date('Y-m-d'); 

    $couponData = $couponmodel->where('company_id', $company_id)
                              ->where('to_date >=', $currentDate)
                              ->where('from_date <=', $currentDate)
                              ->findAll();

    // echo "<pre>";
    // print_r($couponData);
    // die();
    
    if (!empty($couponData)) {
        // Coupon code exists in the database and is valid
        $response = ['status' => 'success', 'message' => 'Coupon code is valid', 'couponData' => $couponData];
    } else {
        // Coupon code does not exist in the database or has expired
        $response = ['status' => 'error', 'message' => 'Invalid or expired coupon code'];
    }

    return $this->response->setJSON($response);
}






}
