<?php

namespace App\Controllers\Admin;

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
use App\Models\OrderStatusModel;
use App\Models\OrderItemModel;
use App\Models\ShippingModel;

class OrderController extends BaseController
{
   
    public function order_list()
    {

        $session = session();

        $ordermodel = new OrderModel();
        $orderitemmodel = new OrderItemModel();
        $cartData = $orderitemmodel->find();
        

        
        // Get the request object
        $request = service('request');

        // Fetch the 'status' query parameter from the URL
        $status = $request->getGet('status');

        if($status == "pending")
        {
            $query = $ordermodel->select('*')
            ->join('users', 'users.user_id = tbl_order.user_id', 'left')->where('tbl_order.order_status', 'Pending')
            ->orderBy('tbl_order.order_id', 'desc')
            ->get();    

            $newCartData = [];
            $cartData = $query->getResultArray();
            foreach($cartData as $cart){
                $cart['product_item'] = $orderitemmodel->select('*')
                ->join('tbl_order', 'tbl_order.order_id = order_items.order_id', 'left')
            ->join('product_variants', 'product_variants.variant_id = order_items.variant_id', 'left')
            ->join('product', 'product.product_id = order_items.product_id', 'left')
            ->join('sub_category', 'sub_category.sub_category_id = order_items.sub_category_id', 'left')
            ->join('category', 'category.category_id = order_items.category_id', 'left')
            ->join('users', 'users.user_id = tbl_order.user_id', 'left')
            ->join('shipping_address', 'users.user_id = tbl_order.user_id', 'left')
            ->where('order_items.order_id', $cart['order_id'])
                
                ->findAll();

             
                $newCartData[] = $cart;
            }
            // $lastQuery = $orderitemmodel->getLastQuery();
            // echo "Last Query: " . $lastQuery . "<br>";
            // die;
        }elseif ($status == "approved") {
            $query = $ordermodel->select('*')
            ->join('users', 'users.user_id = tbl_order.user_id', 'left')->where('tbl_order.order_status', 'Approved')
            ->orderBy('tbl_order.order_id', 'desc')
            ->get();    

            $newCartData = [];
            $cartData = $query->getResultArray();
            foreach($cartData as $cart){
                $cart['product_item'] = $orderitemmodel->select('*')
                ->join('tbl_order', 'tbl_order.order_id = order_items.order_id', 'left')
            ->join('product_variants', 'product_variants.variant_id = order_items.variant_id', 'left')
            ->join('product', 'product.product_id = order_items.product_id', 'left')
            ->join('sub_category', 'sub_category.sub_category_id = order_items.sub_category_id', 'left')
            ->join('category', 'category.category_id = order_items.category_id', 'left')
            ->join('users', 'users.user_id = tbl_order.user_id', 'left')
            ->join('shipping_address', 'users.user_id = tbl_order.user_id', 'left')
            ->where('order_items.order_id', $cart['order_id'])
                
                ->findAll();

             
                $newCartData[] = $cart;
            }
        }
        else{
            $query = $ordermodel->select('*')
            ->join('users', 'users.user_id = tbl_order.user_id', 'left')
            ->orderBy('tbl_order.order_id', 'desc')
            ->get();    

            $newCartData = [];
            $cartData = $query->getResultArray();
            foreach($cartData as $cart){
                $cart['product_item'] = $orderitemmodel->select('*')
                ->join('tbl_order', 'tbl_order.order_id = order_items.order_id', 'left')
            ->join('product_variants', 'product_variants.variant_id = order_items.variant_id', 'left')
            ->join('product', 'product.product_id = order_items.product_id', 'left')
            ->join('sub_category', 'sub_category.sub_category_id = order_items.sub_category_id', 'left')
            ->join('category', 'category.category_id = order_items.category_id', 'left')
            ->join('users', 'users.user_id = tbl_order.user_id', 'left')
            ->join('shipping_address', 'users.user_id = tbl_order.user_id', 'left')
            ->where('order_items.order_id', $cart['order_id'])
                
                ->findAll();
                $newCartData[] = $cart;
            }
        }

        

            // echo "<pre>";
            // print_r($newCartData);
            // die();

        if (!$newCartData) {
            $newCartData = null;
        }
        $orderstatusmodel = new OrderStatusModel();
        $statusData = $orderstatusmodel->find();
        if (!$statusData) {
            $statusData = null;
        }
        return view('admin/order/order_list', [
            'cartData' => $newCartData,
            'statusData' => $statusData,
        ]);
    }
   
    public function orderDelete($order_id)
    {
       

         $session = session();
        $orderModel = new OrderModel();
        $orderItemModel = new OrderItemModel();

        // Delete the order items first
        $orderItemModel->where('order_id', $order_id)->delete();

        // Delete the order
        $orderModel->delete($order_id);

        $session->setFlashdata('success', 'Order Delete succesfully.');
        return redirect()->back();
    }

    public function change_order_status()
{
    
    
    $input = $this->request->getVar();

    // $orderID = $input['order_id']; 
    // $newStatus = $input['status']; 

    // print_r($input['orderId']);
    // die();

    $ordermodel = new OrderModel();
    $cartData = $ordermodel->where('order_id', $input['orderId'])->findAll();

    

    $ordermodel->where('order_id', $input['orderId'])->set(['order_status' => $input['status']])->update();

    
    return $this->response->setJSON(['success' => true]);
}

public function order_details($order_id){
    //print_r($order_id);

        $session = session();

        $ordermodel = new OrderModel();
        $orderitemmodel = new OrderItemModel();
        $cartData = $orderitemmodel->find();

        $newCartData1 = $orderitemmodel->select('*')
                ->join('tbl_order', 'tbl_order.order_id = order_items.order_id', 'left')
            ->join('product_variants', 'product_variants.variant_id = order_items.variant_id', 'left')
            ->join('product', 'product.product_id = order_items.product_id', 'left')
            ->join('sub_category', 'sub_category.sub_category_id = order_items.sub_category_id', 'left')
            ->join('category', 'category.category_id = order_items.category_id', 'left')
            ->join('users', 'users.user_id = tbl_order.user_id', 'left')
            ->where('order_items.order_id', $order_id)
                
                ->findAll();
               

            // echo "<pre>";
            // print_r($newCartData1);
            // die();

        if (!$newCartData1) {
            $newCartData1 = null;
        }

        $shippingmodel = new ShippingModel();

        $shippingData = $shippingmodel
        //->join('users', 'users.user_id = shipping_address.user_id', 'left')
        ->where('order_id', $order_id)->first();

        // echo "<pre>";
        //     print_r($shippingData);
        //     die();
    return view('admin/order/order_details', [
        'newCartData1' => $newCartData1 ,
        'shippingData' => $shippingData
    ]);
   
}


}
