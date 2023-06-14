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

class OrderController extends BaseController
{
   
    public function order_list()
    {

        $session = session();
      
       

        $ordermodel = new OrderModel();

        $cartData = $ordermodel->find();

        $query = $ordermodel->select('*')
        ->join('product_variants', 'product_variants.variant_id = tbl_order.variant_id', 'left')
            ->join('product', 'product.product_id = product_variants.product_id', 'left')
            ->join('sub_category', 'sub_category.sub_category_id = product.sub_category_id', 'left')
            ->join('category', 'category.category_id = sub_category.category_id', 'left')
            ->join('users', 'users.user_id = tbl_order.user_id', 'left')
            ->get();

            $cartData = $query->getResultArray();
       
        // echo "<pre>";
        // print_r($cartData);
        // die();

        

        if (!$cartData) {
            $cartData = null;
        }
        $orderstatusmodel = new OrderStatusModel();
        $statusData = $orderstatusmodel->find();
        if (!$statusData) {
            $statusData = null;
        }
        return view('admin/order/order_list', [
            'cartData' => $cartData,
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
    $orderArr = [];
   
    $orderID = $input['order_id']; 
    $newStatus = $input['status']; 

    
    $cartmodel = new OrderModel();
    $cartmodel->where('order_id', $orderID)->set(['order_status' => $newStatus])->update();

    // Return a response if needed
    return $this->response->setJSON(['success' => true]);
}


}
