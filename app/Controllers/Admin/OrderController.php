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

class OrderController extends BaseController
{
   
    public function order_list()
    {

        $session = session();
      
       

        $ordermodel = new OrderModel();
        $orderitemmodel = new OrderItemModel();
        $cartData = $orderitemmodel->find();

        $query = $orderitemmodel->select('*')
            ->join('tbl_order', 'tbl_order.order_id = order_items.order_id', 'left')
            ->join('product_variants', 'product_variants.variant_id = order_items.variant_id', 'left')
            ->join('product', 'product.product_id = product_variants.product_id', 'left')
            ->join('sub_category', 'sub_category.sub_category_id = product.sub_category_id', 'left')
            ->join('category', 'category.category_id = sub_category.category_id', 'left')
            ->join('users', 'users.user_id = tbl_order.user_id', 'left')
            ->groupBy('order_items.order_id')
            ->get();    

            $newCartData = [];
            $cartData = $query->getResultArray();
            foreach($cartData as $cart){
                $cart['product_item'] = $orderitemmodel->select('*')
                ->join('tbl_order', 'tbl_order.order_id = order_items.order_id', 'left')
            ->join('product_variants', 'product_variants.variant_id = order_items.variant_id', 'left')
            ->join('product', 'product.product_id = product_variants.product_id', 'left')
            ->join('sub_category', 'sub_category.sub_category_id = product.sub_category_id', 'left')
            ->join('category', 'category.category_id = sub_category.category_id', 'left')
            ->join('users', 'users.user_id = tbl_order.user_id', 'left')
            ->join('shipping_address', 'users.user_id = tbl_order.user_id', 'left')
            ->where('order_items.order_id', $cart['order_id'])
                
                ->findAll();
                $newCartData[] = $cart;
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
        $cartmodel = new OrderModel();
        $cartmodel->delete($order_id);
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


}
