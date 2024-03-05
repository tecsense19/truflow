<?php

namespace App\Controllers\Admin;

use App\Models\SubCategoryModel;
use App\Models\CategoryModel;

class SubCategoryController extends BaseController
{
    public function index()
    {
        $subcategorymodel = new SubCategoryModel();
       
        // $subcategoryData = $subcategorymodel->find();
        // if (!$subcategoryData) {
        //     $subcategoryData = null;
        // }

        $subcategoryData = $subcategorymodel->select('sub_category.*, category.category_name')
        ->join('category', 'category.category_id = sub_category.category_id')->orderBy('sub_category_sort','ASC')
        ->find();

        if (!$subcategoryData) {
            $subcategoryData = null;
        }

        return view('admin/sub_category/sub_category_list', ['subcategoryData'=>$subcategoryData]);
    }
    public function sub_category()
    {
        $subcategorymodel = new SubCategoryModel();
        $categorymodel = new CategoryModel();

        $categoryData = $categorymodel->find();

        if (!$categoryData) {
            $categoryData = null;
        }
        

        return view('admin/sub_category/sub_category',['categoryData'=>$categoryData]);
    }
    public function sub_categorySave()
    {

        $subcategorymodel = new SubCategoryModel();
        $session = session();
        $input = $this->request->getVar();
        $sub_category_id = $input['sub_category_id'];
        // echo "<pre>";
        // print_r($input);
        // die();

        $subCatArr = [];

        $subCatArr['sub_category_id'] = isset($input['sub_category_id']) ? $input['sub_category_id'] : '';
        $subCatArr['category_id'] = isset($input['category_id']) ? $input['category_id'] : '';
        $subCatArr['sub_category_name'] = isset($input['sub_category_name']) ? $input['sub_category_name'] : '';
        $subCatArr['sub_category_description'] = isset($input['sub_category_description']) ? $input['sub_category_description'] : '';
        $subCatArr['sub_category_featured'] = isset($input['sub_category_featured']) ? $input['sub_category_featured'] : '';
        $subCatArr['sub_category_sort'] = isset($input['sub_category_sort']) ? $input['sub_category_sort'] : '';

        if ($file = $this->request->getFile('sub_category_img')) {
            $path = 'public/admin/images/sub_category/';
            if ($file->getClientName()) {
                $filename = time() . '_sub_categoryImg_' . $file->getClientName();
                $file->move($path, $filename);
                $subCatArr['sub_category_img'] = 'public/admin/images/sub_category/' . $filename;
            }
        }

        if (isset($input['sub_category_id']) && $input['sub_category_id'] != '') {
            $subcategorymodel->update(['sub_category_id', $input['sub_category_id']], $subCatArr);
            $session->setFlashdata('success', 'sub category edit succesfully.');
        } else {
            $subcategorymodel->insert($subCatArr);
            $session->setFlashdata('success', 'sub category add succesfully.');
        }
        return redirect()->to('admin/sub_category_list');
       
    }
    public function sub_categoryEdit($sub_category_id)
    {

        $subcategorymodel = new SubCategoryModel();
        $subcategoryData = $subcategorymodel->find($sub_category_id);

        if (!$subcategoryData) {
            $subcategoryData = null;
        }

        $categorymodel = new CategoryModel();
        $categoryData = $categorymodel->find();
        if (!$categoryData) {
            $categoryData = null;
        }
        return view('admin/sub_category/sub_category', ['subcategoryData' => $subcategoryData,  'categoryData'=>$categoryData]);
    }
    public function sub_categoryDelete($sub_category_id)
{
    $session = session();
    $subcategorymodel = new SubCategoryModel();
    $subcategorymodel->delete($sub_category_id);
    $session->setFlashdata('success', 'sub category Delete succesfully.');
    return redirect()->to('admin/sub_category_list');
}

}
