<?php

namespace App\Controllers\Admin;

use App\Models\CategoryModel;

class CategoryController extends BaseController
{
    public function index()
    {
        $categorymodel = new CategoryModel();
        $categoryData = $categorymodel->find();
        if (!$categoryData) {
            $categoryData = null;
        }
        return view('admin/category/category_list', ['categoryData' => $categoryData]);
    }
    public function category()
    {
        $categorymodel = new CategoryModel();
        return view('admin/category/category');
    }
    public function categorySave()
    {

        $categorymodel = new CategoryModel();
        $session = session();
        $input = $this->request->getVar();
        $category_id = $input['category_id'];

        $categoryArr = [];

        $categoryArr['category_name'] = isset($input['category_name']) ? $input['category_name'] : '';
        $categoryArr['category_description'] = isset($input['category_description']) ? $input['category_description'] : '';

        if ($file = $this->request->getFile('category_img')) {
            $path = 'public/admin/images/category/';
            if ($file->getClientName()) {
                $filename = time() . '_categoryImg_' . $file->getClientName();
                $file->move($path, $filename);
                $categoryArr['category_img'] = 'public/admin/images/category/' . $filename;
            }
        }

        if (isset($input['category_id']) && $input['category_id'] != '') {
            $categorymodel->update(['category_id', $input['category_id']], $categoryArr);
        } else {
            $categorymodel->insert($categoryArr);
        }

        $session->setFlashdata('success', 'category change succesfully.');
        return redirect()->to('admin/category_list');
       
    }
    public function categoryEdit($category_id)
    {

        $categorymodel = new CategoryModel();
        $categoryData = $categorymodel->find($category_id);

        if (!$categoryData) {
            $categoryData = null;
        }
        return view('admin/category/category', ['categoryData' => $categoryData]);
    }
    public function categoryDelete($category_id)
{
    $session = session();
    $categorymodel = new CategoryModel();
    $categorymodel->delete($category_id);
    $session->setFlashdata('success', 'category Delete succesfully.');
    return redirect()->to('admin/category_list');
}

}
