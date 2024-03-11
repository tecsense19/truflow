<?php

namespace App\Controllers\Admin;

use App\Models\CategoryModel;

class CategoryController extends BaseController
{
    public function index()
    {
        $session = session();
        $user_id = $session->get('user_id');
        if($user_id){
            $categorymodel = new CategoryModel();
            $categoryData = $categorymodel->orderBy('category_sort','ASC')->find();
            if (!$categoryData) {
                $categoryData = null;
            }
            return view('admin/category/category_list', ['categoryData' => $categoryData]);
        }else{
            return redirect()->to('/admin');
        }
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
        $categoryArr['category_sort'] = isset($input['category_sort']) ? $input['category_sort'] : '';
        $categoryArr['category_featured'] = isset($input['featured_category']) ? $input['featured_category'] : '';
        

        if ($file = $this->request->getFile('category_img')) {
            $path = 'public/admin/images/category/';
            if ($file->getClientName()) {
                $filename = time() . '_categoryImg_' . $file->getClientName();
                $file->move($path, $filename);
                $categoryArr['category_img'] = 'public/admin/images/category/' . $filename;
            }
        }

        if (isset($input['category_id']) && $input['category_id'] != '') {
            $category_sort = $categorymodel->where('category_id !=' ,$input['category_id'])->where('category_sort', $input['category_sort'])->first();
            

            if(isset($category_sort) && $category_sort != '') {
                $session->setFlashdata('error', 'Category sort already exit.');
                return redirect()->back();
            }

            $categorymodel->update(['category_id', $input['category_id']], $categoryArr);
            $session->setFlashdata('success', 'category edit succesfully.');
        } else {
            $category_sort = $categorymodel->where('category_sort', $input['category_sort'])->first();

            if(isset($category_sort) && $category_sort != '') {
                $session->setFlashdata('error', 'Category sort already exit.');
                return redirect()->back();
            }
            $categorymodel->insert($categoryArr);
            $session->setFlashdata('success', 'category add succesfully.');
        }

        
        return redirect()->to('admin/category_list');

       
    }
    public function categoryEdit($category_id)
    {
        $session = session();
        $user_id = $session->get('user_id');
        if($user_id){
            $categorymodel = new CategoryModel();
            $categoryData = $categorymodel->find($category_id);
    
            if (!$categoryData) {
                $categoryData = null;
            }
            return view('admin/category/category', ['categoryData' => $categoryData]);
        }else{
            return redirect()->to('/admin');
        }
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
