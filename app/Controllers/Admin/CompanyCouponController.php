<?php

namespace App\Controllers\Admin;

use App\Models\CouponModel;
use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use App\Models\VariantsModel;
use App\Models\CompanyModel;

class CompanyCouponController extends BaseController
{
    public function index()
    {
       
        $couponmodel = new CouponModel();
      
        $couponData = $couponmodel;
        

        $query = $couponmodel->select('*')
            ->join('company', 'company.company_id = coupon.company_id', 'left')
            ->where('coupon.company_coupon', '1')
            ->get();

         

        $couponData = $query->getResultArray();

    //    echo "<pre>";
    //     print_r($couponData);
    //     die();
        
        if (!$couponData) {
            $couponData = null;
        }
        return view('admin/company_coupon/company_coupon_list', ['couponData' => $couponData]);
    }
    public function coupon()
    {
        $couponmodel = new CouponModel();
        $companymodel = new CompanyModel();
        //$categorymodel = new CategoryModel();
        $subcategorymodel = new SubCategoryModel();

        $variantsmodel = new VariantsModel();
        $productmodel = new ProductModel();

        $productData = $productmodel->select('product.*, category.category_name, sub_category.sub_category_name')
        ->join('category', 'category.category_id = product.category_id')
        ->join('sub_category', 'sub_category.sub_category_id = product.sub_category_id')
        ->find();
    $newData2 = [];
    foreach ($productData as $pnewdata) {
        $variantData = $variantsmodel->where('product_id', $pnewdata['product_id'])->first();
        $pnewdata['parent'] = count($variantData) > 0 ? $variantData['parent'] : '';
        $newData2[] = $pnewdata;
    }

    if (!$newData2) {
        $newData2 = null;
    }
        
        $subcategoryData = $subcategorymodel->find();
        $companyData = $companymodel->find();

        
        return view('admin/company_coupon/company_coupon',[
            'subcategoryData' => $subcategoryData,
            'companyData' => $companyData,
            'productData' => $newData2
    ]);
    }
    public function couponSave()
    {

        $couponmodel = new CouponModel();
        $session = session();
        $input = $this->request->getVar();
        $coupon_id = $input['coupon_id'];

        $couponArr = [];

        //$couponArr['coupon_code'] = isset($input['coupon_code']) ? $input['coupon_code'] : '';
        $couponArr['coupon_price'] = isset($input['coupon_price']) ? $input['coupon_price'] : '';
        $couponArr['coupon_price_type'] = isset($input['coupon_price_type']) ? $input['coupon_price_type'] : '';
        $couponArr['coupon_type'] = isset($input['coupon_type']) ? $input['coupon_type'] : '';
        $couponArr['from_date'] = isset($input['from_date']) ? $input['from_date'] : '';
        $couponArr['to_date'] = isset($input['to_date']) ? $input['to_date'] : '';
        $couponArr['coupon_status'] = isset($input['coupon_status']) ? $input['coupon_status'] : '';
        $couponArr['isDeleted'] = isset($input['isDeleted']) ? $input['isDeleted'] : '';
        $couponArr['sub_category_id'] = isset($input['sub_category_id']) ? implode(',', $input['sub_category_id']) : '';
        $couponArr['company_coupon'] = isset($input['company_coupon']) ? $input['company_coupon'] : '';
        $couponArr['company_id'] = isset($input['company_id']) ? $input['company_id'] : '';
      
        

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


    //$categorymodel = new CategoryModel();
    $subcategorymodel = new SubCategoryModel();
        
    $subcategoryData = $subcategorymodel->find();
       
    $selectedUserIds = [];
    $selectedsubCategoryIds = [];

    if ($couponData) {
        $selectedsubCategoryIds = explode(',', $couponData['sub_category_id']);
    }
    $companymodel = new CompanyModel();
    $companyData = $companymodel->find();


    return view(
        'admin/company_coupon/company_coupon',
        [
            'couponData' => $couponData,
            'subcategoryData' => $subcategoryData,
            'selectedsubCategoryIds' => $selectedsubCategoryIds,
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
