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
use App\Models\UserModel;
use App\Models\UserLoginReportModel;
use Config\Database;

class ReportController extends BaseController
{
    public function order_report()
    {
        $session = session();
        $user_id = $session->get('user_id');
        if($user_id){
            $ordermodel = new OrderModel();
            $orderitemmodel = new OrderItemModel();
            $cartData = $orderitemmodel->find();
    
            $query = $ordermodel->select('*')
                ->join('users', 'users.user_id = tbl_order.user_id', 'left')
                ->get();
    
            $newCartData = [];
            $cartData = $query->getResultArray();
            foreach ($cartData as $cart) {
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
            $orderstatusmodel = new OrderStatusModel();
            $statusData = $orderstatusmodel->find();
            if (!$statusData) {
                $statusData = null;
            }
    
            // echo "<pre>";
            //     print_r($newCartData);
            //     die();
    
            return view(
                'admin/report/order_report',
                [
                    'cartData' => $newCartData, 'statusData' => $statusData
                ]
            );
        }else{
            return redirect()->to('/admin');
        }

    }

    public function search_data()
    {
        $ordermodel = new OrderModel();
        $orderitemmodel = new OrderItemModel();
        $orderstatusmodel = new OrderStatusModel();

        $selectedStatus = $this->request->getPost('order_status');
        $selectedDate = $this->request->getPost('order_date');



        $query = $ordermodel->select('*')
            ->join('users', 'users.user_id = tbl_order.user_id', 'left');

        if ($selectedStatus) {
            $query->where('tbl_order.order_status', $selectedStatus);
        }
        if ($selectedDate) {

            $selectedDate = date('Y-m-d', strtotime($selectedDate));
            $query->where('DATE(tbl_order.order_date) >=', $selectedDate);
        }


        $result = $query->get()->getResultArray();

        $orderstatusmodel = new OrderStatusModel();
        $statusData = $orderstatusmodel->find();
        if (!$statusData) {
            $statusData = null;
        }
        return view(
            'admin/report/order_report',
            [
                'cartData' => $result,
                'statusData' => $statusData,
                'selectedStatus' => $selectedStatus,
                'selectedDate' => $selectedDate,
            ]
        );
    }
    public function order_export()
    {
        $ordermodel = new OrderModel();
        $orderitemmodel = new OrderItemModel();
        $orderstatusmodel = new OrderStatusModel();

        $selectedStatus = $this->request->getPost('order_status');
        $selectedDate = $this->request->getPost('order_date');

        $query = $ordermodel->select('*')
            ->join('users', 'users.user_id = tbl_order.user_id', 'left');

        if ($selectedStatus) {
            $query->where('tbl_order.order_status', $selectedStatus);
        }
        if ($selectedDate) {
            $selectedDate = date('Y-m-d', strtotime($selectedDate));
            $query->where('DATE(tbl_order.order_date) >=', $selectedDate);
        }

        $result = $query->get()->getResultArray();

        // Define CSV file name
        $filename = 'order_data.csv';

        // Set the appropriate headers for file download
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Create a file handler for output
        $file = fopen('php://output', 'w');

        // Write CSV headers
        $headers = ['#', 'Name', 'Total Amount', 'Order Status', 'Payment Method', 'Order Date'];
        fputcsv($file, $headers);

        // Write CSV rows
        foreach ($result as $row) {
            $rowData = [
                $row['order_id'],
                $row['full_name'],
                $row['final_total_ammount'],
                $row['order_status'],
                $row['pay_method'],
                date('d-m-Y', strtotime($row['order_date']))
            ];
            fputcsv($file, $rowData);
        }

        // Close the file handler
        fclose($file);

        // Stop script execution after file download
        exit();
    }
    public function user_report()
    {
        $session = session();
        $user_id = $session->get('user_id');

        if($user_id){
            $ordermodel = new OrderModel();
            $orderitemmodel = new OrderItemModel();
            $cartData = $orderitemmodel->find();
    
            $query = $ordermodel->select('*')
                ->join('users', 'users.user_id = tbl_order.user_id', 'left')
                ->join('shipping_address', 'users.user_id = tbl_order.user_id', 'left')
                ->where('order_items.order_id', $cart['order_id'])
                ->findAll();
            $newCartData[] = $cart;
        }
    }


    public function lost_cart_report()
    {
        $session = session();
        $cartModel = new CartModel();
        $cartData = $cartModel->find();

        // $query = $cartModel->select('*')
        //     ->join('users', 'users.user_id = add_to_cart.user_id', 'left')
        //     ->get();

        // $cartData = $query->getResultArray();
    
      
                $query = $cartModel->select('*')
                ->join('product_variants', 'product_variants.variant_id = add_to_cart.variant_id', 'left')
                ->join('coupon', 'coupon.coupon_code = product_variants.group_name','left')
                ->join('product', 'product.product_id = product_variants.product_id', 'left')
                ->join('sub_category', 'sub_category.sub_category_id = product.sub_category_id', 'left')
                ->join('category', 'category.category_id = sub_category.category_id', 'left')
                ->join('users', 'users.user_id = add_to_cart.user_id', 'left')
                // ->join('company', 'company.company_name = users.company_name', 'left')
                // ->where('add_to_cart.user_id', $userId)
                ->get();
    
            $cartData = $query->getResultArray();

        
        $usermodel = new UserModel();
        $userData = $usermodel->where('user_role', 'user')->find();
        if (!$userData) {
            $userData = null;
        }

        // echo '<pre>';print_r($cartData);echo '</pre>';
        // die;
      
        return view(
            'admin/report/lost_cart_report',
            [
                'cartData' => $cartData, 'userData' => $userData
            ]
        );
    }

    public function user_search_data()
    {
        $ordermodel = new OrderModel();
        $orderitemmodel = new OrderItemModel();
        $orderstatusmodel = new OrderStatusModel();
        $usermodel = new UserModel();

        $selectedUser = $this->request->getPost('user_id');
        $selectedDate = $this->request->getPost('order_date');

       
        $query = $ordermodel->select('*')
            ->join('users', 'users.user_id = tbl_order.user_id', 'left');

        if ($selectedUser) {
            $query->where('tbl_order.user_id', $selectedUser);
        }
        if ($selectedDate) {

            $selectedDate = date('Y-m-d', strtotime($selectedDate));
            $query->where('DATE(tbl_order.order_date) >=', $selectedDate);
        }
        

        $result = $query->get()->getResultArray();

        // echo "<pre>";
        // print_r($result);
        // die();


        $usermodel = new UserModel();
        $userData = $usermodel->where('user_role', 'user')->find();
        if (!$userData) {
            $userData = null;
        }
        return view(
            'admin/report/user_report',
            [
                'cartData' => $result,
                'userData' => $userData,
                'selectedUser' => $selectedUser,
                'selectedDate' => $selectedDate,
            ]
        );
    }
    public function user_export()
    {
        $ordermodel = new OrderModel();
        $orderitemmodel = new OrderItemModel();
        $orderstatusmodel = new OrderStatusModel();

        $selectedUser = $this->request->getPost('user_id');
        $selectedDate = $this->request->getPost('order_date');

        $query = $ordermodel->select('*')
            ->join('users', 'users.user_id = tbl_order.user_id', 'left');

        if ($selectedUser) {
            $query->where('tbl_order.user_id', $selectedUser);
        }
        if ($selectedDate) {
            $selectedDate = date('Y-m-d', strtotime($selectedDate));
            $query->where('DATE(tbl_order.order_date) >=', $selectedDate);
        }

        $result = $query->get()->getResultArray();

        // Define CSV file name
        $filename = 'order_data.csv';

        // Set the appropriate headers for file download
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Create a file handler for output
        $file = fopen('php://output', 'w');

        // Write CSV headers
        $headers = ['#', 'Name', 'Total Amount', 'Order Status', 'Payment Method', 'Order Date'];
        fputcsv($file, $headers);

        // Write CSV rows
        foreach ($result as $row) {
            $rowData = [
                $row['order_id'],
                $row['full_name'],
                $row['final_total_ammount'],
                $row['order_status'],
                $row['pay_method'],
                date('d-m-Y', strtotime($row['order_date']))
            ];
            fputcsv($file, $rowData);
        }

        // Close the file handler
        fclose($file);

        // Stop script execution after file download
        exit();
    }
    
    public function lost_cart_report()
    {
        $session = session();
        $user_id = $session->get('user_id');
        if($user_id){
            $cartModel = new CartModel();
            $cartData = $cartModel->find();

            // $user_query = $cartModel->select('*')
            // ->join('users', 'users.user_id = add_to_cart.user_id')
            // ->groupBy('add_to_cart.user_id') // Group by user_id
            // ->get();
            
            $user_query = $cartModel->distinct()
            ->select('users.user_id, users.*')
            ->join('users', 'users.user_id = add_to_cart.user_id')
            ->get();

            $usercartData = $user_query->getResultArray();

            $user_result = array();
            foreach ( $usercartData as $key => $value) {
                $value['cart_item'] = $cartModel
                ->join('users', 'users.user_id = add_to_cart.user_id')
                ->join('product_variants', 'product_variants.variant_id = add_to_cart.variant_id', 'left')
                ->join('coupon', 'coupon.coupon_code = product_variants.group_name','left')
                ->join('product', 'product.product_id = product_variants.product_id', 'left')
                ->join('sub_category', 'sub_category.sub_category_id = product.sub_category_id', 'left')
                ->join('category', 'category.category_id = sub_category.category_id', 'left')
                ->where('add_to_cart.user_id', $value['user_id'])->get()->getResultArray();
            
                $user_result[] = $value;
            }
            


            // $guestuser_query = $cartModel->select('*')
            // ->groupBy('add_to_cart.guest_id') // Group by guest_id
            // ->get();

            $guestuser_query = $cartModel->distinct()
            ->select('add_to_cart.guest_id')
            ->get();

            $guestcartData = $guestuser_query->getResultArray();
            
            $guest_result = array();
            foreach ( $guestcartData as $key => $value) {
                $value['cart_item'] = $cartModel
                ->join('product_variants', 'product_variants.variant_id = add_to_cart.variant_id', 'left')
                ->join('coupon', 'coupon.coupon_code = product_variants.group_name','left')
                ->join('product', 'product.product_id = product_variants.product_id', 'left')
                ->join('sub_category', 'sub_category.sub_category_id = product.sub_category_id', 'left')
                ->join('category', 'category.category_id = sub_category.category_id', 'left')
                ->where('add_to_cart.guest_id IS NOT NULL')
                ->where('add_to_cart.guest_id', $value['guest_id'])->get()->getResultArray();
                $guest_result[] = $value;
            }

            // echo '<pre>';print_r($guest_result);echo '</pre>';die;
            
            $usermodel = new UserModel();
            $userData = $usermodel->where('user_role', 'user')->find();
            if (!$userData) {
                $userData = null;
            }

        
            return view(
                'admin/report/lost_cart_report',
                [
                    'cartData' => $user_result,'guestcartData' => $guest_result, 'userData' => $userData
                ]
            );
        }else{
            return redirect()->to('/admin');
        }
    }


    public function user_statistics_report(){
        $session = session();
        $user_id = $session->get('user_id');
        if($user_id){
            $usermodel = new UserModel();
            $userData = $usermodel->where('user_role', 'user')->find();
            // echo '<pre>';print_r($userData);echo '</pre>';die;
            return view(
                'admin/report/user_statistics_report',
                [
                    'userData' => $userData
                ]
            );
        }else{
            return redirect()->to('/admin');
        }
    }
    public function user_statistics_report_detail($id){
        $UserLoginReportModel = new UserLoginReportModel();
        $userData = $UserLoginReportModel->join('users', 'users.user_id = user_login_detail_report.user_id', 'left')->where('user_login_detail_report.user_id', $id)
        ->orderBy('user_login_detail_report.last_login_time','DESC')->find();
        return view(
            'admin/report/user_statistics_report_detail',
            [
                'userData' => $userData
            ]
        );
    }

    public function top_selling_product_view(){
        $session = session();
        $user_id = $session->get('user_id');
        if($user_id){
            $usermodel = new UserModel();
            $userData = $usermodel->where('user_role', 'user')->find();
            return view('admin/report/top_selling_report',['userData' => $userData]);
        }else{
            return redirect()->to('/admin');
        }
    }
    public function top_selling_product(){

        $ordermodel = new OrderModel();
        $orderitemmodel = new OrderItemModel();

        $input = $this->request->getVar();
        $user_id = $input['search'];

        $user_order = $ordermodel->where('user_id',$user_id)->findAll();
        $order_ids = array_column($user_order, 'order_id');
        // echo '<pre>';print_r($order_ids);echo '</pre>';die;
        if(isset($user_id) && $user_id != ''){
    
            $db = Database::connect();
            if (!empty($order_ids)) {

                $subQueryString = '(SELECT SUM(product_quantity) 
                   FROM order_items 
                   WHERE order_items.product_id = product.product_id 
                   AND order_items.order_id IN (' . implode(',', $order_ids) . '))';
                $query = $db->table('product')
                    ->select('product.product_id, product.product_name, product.product_short_description, product.product_img, (' . $subQueryString . ') as total_quantity')
                    ->having('total_quantity IS NOT NULL')
                    ->orderBy('total_quantity', 'DESC')
                    ->get()
                    ->getResult();


                $result = $query;
            }else{
                $result = array();
            }
        }else{
            $db = Database::connect();
            
            $subQueryString = '(SELECT SUM(product_quantity) FROM order_items WHERE order_items.product_id = product.product_id)';

            $query = $db->table('product')
                ->select('product.product_id, product.product_name, product.product_short_description, product.product_img, (' . $subQueryString . ') as total_quantity')
                ->having('total_quantity IS NOT NULL')
                ->orderBy('total_quantity', 'DESC')
                ->get()
                ->getResult();

             $result = $query;
        }

        return view(
            'admin/report/top_selling_report_table',
            [
                'topSellingData' => $result,
            ]
        );
    }
}
