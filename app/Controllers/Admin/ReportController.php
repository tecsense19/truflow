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

class ReportController extends BaseController
{
    public function order_report()
    {
        $session = session();

        $ordermodel = new OrderModel();
        $orderitemmodel = new OrderItemModel();
        $cartData = $orderitemmodel->find();

             $query = $ordermodel->select('*')
            ->join('users', 'users.user_id = tbl_order.user_id', 'left')
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
        if (!$newCartData) {
            $newCartData = null;
        }
        
        // echo "<pre>";
        //     print_r($newCartData);
        //     die();
     
        return view('admin/report/order_report',
        [
            'cartData' => $newCartData,
        ]);
    }
    
}
