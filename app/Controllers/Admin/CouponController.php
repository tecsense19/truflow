<?php

namespace App\Controllers\Admin;

use App\Models\CouponModel;
use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;

class CouponController extends BaseController
{
    public function index()
    {
        $couponmodel = new CouponModel();
        $couponData = $couponmodel->find();

        

        if (!$couponData) {
            $couponData = null;
        }
        return view('admin/coupon/coupon_list', ['couponData' => $couponData]);
    }
    public function coupon()
    {
        $couponmodel = new CouponModel();
        $usermodel = new UserModel();
        $productmodel = new ProductModel();
        $categorymodel = new CategoryModel();
        $subcategorymodel = new SubCategoryModel();

        $categoryData = $categorymodel->find();
        
        
        $userdata = $usermodel->where('user_role', 'user')->findAll();
        
        
        
        return view('admin/coupon/coupon',[
            'categoryData' => $categoryData,
            'userdata' => $userdata

    
    ]);
    }
    public function couponSave()
    {

        $couponmodel = new CouponModel();
        $session = session();
        $input = $this->request->getVar();
        $coupon_id = $input['coupon_id'];

        $couponArr = [];

        $couponArr['coupon_code'] = isset($input['coupon_code']) ? $input['coupon_code'] : '';
        $couponArr['coupon_price'] = isset($input['coupon_price']) ? $input['coupon_price'] : '';
        $couponArr['coupon_price_type'] = isset($input['coupon_price_type']) ? $input['coupon_price_type'] : '';
        $couponArr['coupon_type'] = isset($input['coupon_type']) ? $input['coupon_type'] : '';
        $couponArr['from_date'] = isset($input['from_date']) ? $input['from_date'] : '';
        $couponArr['to_date'] = isset($input['to_date']) ? $input['to_date'] : '';
        $couponArr['coupon_status'] = isset($input['coupon_status']) ? $input['coupon_status'] : '';
        $couponArr['isDeleted'] = isset($input['isDeleted']) ? $input['isDeleted'] : '';
        $couponArr['category_id'] = isset($input['category_id']) ? implode(',', $input['category_id']) : '';
        $couponArr['user_id'] = isset($input['user_id']) ? implode(',', $input['user_id']) : '';

      
        // echo "<pre>";
        // print_r($input);
        // die();

        if (isset($input['coupon_id']) && $input['coupon_id'] != '') {
            $couponmodel->update(['coupon_id', $input['coupon_id']], $couponArr);
        } else {
            $couponmodel->insert($couponArr);
        }

        $session->setFlashdata('success', 'coupon change succesfully.');
        return redirect()->to('admin/coupon_list');
       
    }
    public function couponEdit($coupon_id)
{
    $couponmodel = new CouponModel();
    $couponData = $couponmodel->find($coupon_id);

    $usermodel = new UserModel();
    $userdata = $usermodel->where('user_role', 'user')->findAll();

    $categorymodel = new CategoryModel();
    $categoryData = $categorymodel->findAll();

    $selectedUserIds = [];
    $selectedCategoryIds = [];

    if ($couponData) {
        $selectedUserIds = explode(',', $couponData['user_id']);
        $selectedCategoryIds = explode(',', $couponData['category_id']);
    }

    return view(
        'admin/coupon/coupon',
        [
            'couponData' => $couponData,
            'userdata' => $userdata,
            'categoryData' => $categoryData,
            'selectedUserIds' => $selectedUserIds,
            'selectedCategoryIds' => $selectedCategoryIds
        ]
    );
}



    public function couponDelete($coupon_id)
{
    $session = session();
    $couponmodel = new CouponModel();
    $couponmodel->delete($coupon_id);
    $session->setFlashdata('success', 'coupon Delete succesfully.');
    return redirect()->to('admin/coupon_list');
}

}
