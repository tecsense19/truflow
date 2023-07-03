<?php

namespace App\Controllers\Admin;

use App\Models\CouponModel;
use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use App\Models\CompanyModel;

class CompanyCouponController extends BaseController
{
    public function index()
    {
        $couponmodel = new CouponModel();
        $couponData = $couponmodel->where('company_coupon', '1')->findAll();

        
        if (!$couponData) {
            $couponData = null;
        }
        return view('admin/company_coupon/company_coupon_list', ['couponData' => $couponData]);
    }
    public function coupon()
    {
        $couponmodel = new CouponModel();
        $companymodel = new CompanyModel();
        $categorymodel = new CategoryModel();
        
        $categoryData = $categorymodel->find();
        $companyData = $companymodel->find();

        
        return view('admin/company_coupon/company_coupon',[
            'categoryData' => $categoryData,
            'companyData' => $companyData
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
        $couponArr['company_coupon'] = isset($input['company_coupon']) ? $input['company_coupon'] : '';
        $couponArr['company_id'] = isset($input['company_id']) ? $input['company_id'] : '';
      
        // echo "<pre>";
        // print_r($input);
        // die();

        if (isset($input['coupon_id']) && $input['coupon_id'] != '') {
            $couponmodel->update(['coupon_id', $input['coupon_id']], $couponArr);
        } else {
            $couponmodel->insert($couponArr);
        }

        $session->setFlashdata('success', 'coupon change succesfully.');
        return redirect()->to('admin/company_coupon_list');
       
    }
    public function couponEdit($coupon_id)
{
    $couponmodel = new CouponModel();
    $couponData = $couponmodel->find($coupon_id);


    $categorymodel = new CategoryModel();
    $categoryData = $categorymodel->findAll();

    $selectedUserIds = [];
    $selectedCategoryIds = [];

    if ($couponData) {
        $selectedCategoryIds = explode(',', $couponData['category_id']);
    }
    $companymodel = new CompanyModel();
    $companyData = $companymodel->find();


    return view(
        'admin/company_coupon/company_coupon',
        [
            'couponData' => $couponData,
            'categoryData' => $categoryData,
            'selectedCategoryIds' => $selectedCategoryIds,
            'companyData' =>$companyData
        ]
    );
}



    public function couponDelete($coupon_id)
{
    $session = session();
    $couponmodel = new CouponModel();
    $couponmodel->delete($coupon_id);
    $session->setFlashdata('success', 'coupon Delete succesfully.');
    return redirect()->to('admin/company_coupon_list');
}

}
