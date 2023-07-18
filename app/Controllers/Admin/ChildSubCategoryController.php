<?php

namespace App\Controllers\Admin;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use App\Models\VariantsModel;
use App\Models\ChildSubCategoryModel;
use CodeIgniter\HTTP\RequestInterface;

class ChildSubCategoryController extends BaseController
{
    public function index()
    {
        $childsubcategorymodel = new ChildSubCategoryModel();
        $subcategorymodel = new SubCategoryModel();
        $categorymodel = new CategoryModel();



        $childSubCategoryData = $childsubcategorymodel->select('child_sub_category.*, sub_category.sub_category_name, category.category_name')
            ->join('sub_category', 'sub_category.sub_category_id = child_sub_category.sub_category_id')
            ->join('category', 'category.category_id = sub_category.category_id')
            ->findAll();

        if (!$childSubCategoryData) {
            $childSubCategoryData = null;
        }
        
       
        // $subcategoryData = $subcategorymodel->find();
        // if (!$subcategoryData) {
        //     $subcategoryData = null;
        // }

        $subcategoryData = $subcategorymodel->select('sub_category.*, category.category_name')
        ->join('category', 'category.category_id = sub_category.category_id')
        ->find();

        if (!$subcategoryData) {
            $subcategoryData = null;
        }

        $responseArr = [];
        $categoryData = $categorymodel->findAll();
        foreach ($categoryData as $key => $value) 
        {
            $subcategories = $subcategorymodel->where('category_id', $value['category_id'])->findAll();
            $subArr = [];
            foreach ($subcategories as $sKey => $sValue) 
            {
                $childsubcategories = $childsubcategorymodel->where('sub_chid_id', '0')->where('sub_category_id', $sValue['sub_category_id'])->findAll();
                $childArr = [];
                foreach ($childsubcategories as $cKey => $cValue) 
                {
                    $allChild = $this->getCategoryTree($cValue['child_id'], $childsubcategorymodel);
                    $cValue['all_childs'] = $allChild;
                    $childArr[] = $cValue;
                }
                $sValue['child_arr'] = $childArr;
                $subArr[] = $sValue;
            }
            $value['sub_cat'] = $subArr;
            $responseArr[] = $value;
        }
        // $categories = $this->getCategoryTree(31, $childsubcategorymodel);
        // echo "<pre>";
        // print_r($responseArr);
        // die;
        
   
        return view('admin/child_sub_category/child_sub_category_list', ['childSubCategoryData' => $childSubCategoryData, 'subcategoryData'=>$subcategoryData, 'categories'=>$responseArr]);
    }

    protected function getCategoryTree(int $parentCategoryId = null, ChildSubCategoryModel $model)
    {
        $categories = [];

        $query = $model->select('child_id , sub_category_id, child_sub_category_name')
                       ->where('sub_chid_id', $parentCategoryId)
                       ->get();

        foreach ($query->getResult() as $row) {
            $row->children = $this->getCategoryTree($row->child_id, $model);
            $categories[] = $row;
        }

        return $categories;
    }
    public function child_sub_category()
    {
        $productmodel = new ProductModel();
        $categorymodel = new CategoryModel();
        $subcategorymodel = new SubCategoryModel();
        $childsubcategorymodel = new ChildSubCategoryModel();


        $categoryData = $categorymodel->findAll();



        if (!$categoryData) {
            $categoryData = null;
        }

        $subcategoryData = $subcategorymodel->find();



        //die();
        return view('admin/child_sub_category/child_sub_category', ['categoryData' => $categoryData, 'subcategoryData' => $subcategoryData]);
    }
    public function getSubcategories($category_id)
    {
        $subcategorymodel = new SubCategoryModel();
        $subcategories = $subcategorymodel->where('category_id', $category_id)->find();

        // Return subcategories as JSON
        echo json_encode($subcategories);
        // return $this->response->setJSON($subcategories);
    }
    public function getChildSubcategories($sub_category_id)
    {
        $childsubcategorymodel = new ChildSubCategoryModel();
        $childsubcategories = $childsubcategorymodel->where('sub_chid_id', '0')->where('sub_category_id', $sub_category_id)->find();

        // echo "<pre>";
        // print_r($childsubcategories);
        // die();
        
        // Return subcategories as JSON
        return $this->response->setJSON($childsubcategories);
    }
    public function getChildSubId($sub_chid_id)
    {
        $childsubcategorymodel = new ChildSubCategoryModel();
        $childsubcategoriesId = $childsubcategorymodel->where('sub_chid_id', $sub_chid_id)->findAll();

        echo json_encode($childsubcategoriesId);
        // Return subcategories as JSON
        // return $this->response->setJSON($childsubcategoriesId);
    }
    public function child_sub_categorySave()
    {
        $session = session();
        $childsubcategorymodel = new ChildSubCategoryModel();
        // echo "<pre>";
        // print_r($_POST);
        // die();
        // Retrieve form input
        $childsubcategory = [
            'sub_chid_id' => $this->request->getPost('child_id') ? $this->request->getPost('child_id') : 0,
            'category_id' => $this->request->getPost('category_id'),
            'sub_category_id' => $this->request->getPost('sub_category_id'),
            'child_sub_category_name' => $this->request->getPost('child_sub_category_name'),
        ];

        if (!empty($childsubcategory['child_id'])) {
            $childsubcategorymodel->update($childsubcategory['child_id'], $childsubcategory);
            $child_sub_category_id = $childsubcategory['child_id'];
            $session->setFlashdata('success', 'Child subcategory updated successfully.');
        } else {
            $child_sub_category_id = $childsubcategorymodel->insert($childsubcategory);
            $session->setFlashdata('success', 'Child subcategory added successfully.');
        }

        return redirect()->to('admin/child_sub_category_list');
    }

    public function child_sub_category_name_save()
    {
    $session = session();
    $childsubcategorymodel = new ChildSubCategoryModel();
    // Retrieve form input
    $childsubcategory = [
        'child_sub_category_name' => $this->request->getPost('child_sub_category_name')
    ];
    $childsubcategorymodel->update($_POST['child_id'], $childsubcategory);
    $session->setFlashdata('success', 'Child subcategory updated successfully.');
    return redirect()->to('admin/child_sub_category_list');
}
    public function child_sub_category_name_edit($child_id)
    {
        $childsubcategorymodel = new ChildSubCategoryModel();
        $childData = $childsubcategorymodel->find($child_id);

        if (!$childData) {
            $childData = null;
        }

        $categorymodel = new CategoryModel();
        $categoryData = $categorymodel->find();
        if (!$categoryData) {
            $categoryData = null;
        }
       
        $subcategorymodel = new SubCategoryModel();
        $subcategoryData = $subcategorymodel->find();
        if (!$subcategoryData) {
            $subcategoryData = null;
        }
       
        $variantsmodel = new VariantsModel();
        $variantData = $variantsmodel->where('product_id', $child_id)->findAll();
        if (!$variantData) {
            $variantData = null;
        }

        // print_r($subcategoryData);
        // die;
   
        return view('admin/child_sub_category/child_sub_categoryedit', [
            'childData' => $childData,
            'categoryData' => $categoryData,
            'subcategoryData' => $subcategoryData,

        ]);
    }

    public function child_sub_categoryEdit($child_id)
    {

        $childsubcategorymodel = new ChildSubCategoryModel();
        $childData = $childsubcategorymodel->find($child_id);

        if (!$childData) {
            $childData = null;
        }

        $categorymodel = new CategoryModel();
        $categoryData = $categorymodel->find();
        if (!$categoryData) {
            $categoryData = null;
        }
       
        $subcategorymodel = new SubCategoryModel();
        $subcategoryData = $subcategorymodel->find();
        if (!$subcategoryData) {
            $subcategoryData = null;
        }
       
        $variantsmodel = new VariantsModel();
        $variantData = $variantsmodel->where('product_id', $child_id)->findAll();
        if (!$variantData) {
            $variantData = null;
        }

        // print_r($subcategoryData);
        // die;
   
        return view('admin/child_sub_category/child_sub_category', [
            'childData' => $childData,
            'categoryData' => $categoryData,
            'subcategoryData' => $subcategoryData,

        ]);
    }

    

    public function child_sub_categoryDelete($child_id)
    {
        $session = session();
        $childsubcategorymodel = new ChildSubCategoryModel();
        $childsubcategorymodel->delete($child_id);
        $session->setFlashdata('success', 'product Delete succesfully.');
        return redirect()->to('admin/child_sub_category_list');
    }
}
