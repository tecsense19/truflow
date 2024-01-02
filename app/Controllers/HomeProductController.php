<?php

namespace App\Controllers;

use App\Models\SettingsModel;
use App\Models\SettingsImagesModel;
use App\Models\TestominalModel;
use App\Models\HeaderMenuModel;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use App\Models\ProductModel;
use App\Models\VariantsModel;
use App\Models\CartModel;
use App\Models\AddwishlistModel;
use App\Models\UserContactModel;
use App\Models\UserModel;
use App\Models\CompanyModel;
use App\Models\SliderModel;
use App\Models\ChildSubCategoryModel;
use App\Models\ProductRatingModel;
use App\Models\CouponModel;
use App\Models\MetaContentsModel;

$session = \Config\Services::session();

class HomeProductController extends BaseController
{
    public function index($cateId = "", $subCatId = "", $childId = "" , $productId = "")
    {
        $headermenumodel = new HeaderMenuModel();
        $categorymodel = new CategoryModel();
        $subcategorymodel = new SubCategoryModel();
        $productmodel = new ProductModel();
        $ChildSubCategoryModel = new ChildSubCategoryModel();
        $variantsmodel = new VariantsModel();

        $headerData = $headermenumodel->find();
        if (!$headerData) {
            $headerData = null;
        }
        $categoryData = $categorymodel->findAll();

        if($cateId)
        {
            $getCategoryData = $categorymodel->where('category_name', str_replace('-', ' ', $cateId))->get()->getRow();

            $subCatResult = [];
            if($getCategoryData)
            {
                $subcategoryData = $subcategorymodel->where('category_id', $getCategoryData->category_id)->findAll();
                foreach ($subcategoryData as $key => $value) {
                    $product = $productmodel->where('sub_category_id', $value['sub_category_id'])->where('child_id',-1)->findAll();
                    $value['isProduct'] = count($product) > 0 ? true : false;
                    $subCatResult[] = $value;
                }    
            }

            $getCategoryData->subCategory = $subCatResult;

            if($subCatId)
            {
                $getSubCategoryData = $subcategorymodel->where('sub_category_name', str_replace('-', ' ', $subCatId))->get()->getRow();

                $ChildSubCategorydata = $ChildSubCategoryModel->where('sub_chid_id', '0')->where('sub_category_id', $getSubCategoryData->sub_category_id)->findAll();
                $childCatResult = [];
                $productData = [];

                if($childId)
                {
                    $getChild = $ChildSubCategoryModel->where('child_sub_category_name', str_replace('-', ' ', $childId))->get()->getRow();

                    $ChildSubCategorydata = $ChildSubCategoryModel->where('sub_chid_id', $getChild->child_id)->findAll();
                    
                    if($ChildSubCategorydata)
                    {
                        foreach ($ChildSubCategorydata as $key => $value) {
    
                            $subChild = $ChildSubCategoryModel->where('sub_chid_id', $value['child_id'])->findAll();
    
                            $product = $productmodel->where('child_id', $value['child_id'])->findAll();
    
                            $value['isProduct'] = count($product) > 0 ? true : false;
    
                            $childCatResult[] = $value;
                        }
                    }
                    else
                    {
                        $productData = $productmodel->where('sub_category_id', $getSubCategoryData->sub_category_id)->where('child_id', $getChild->child_id)->findAll();
                    }                
                }
                else
                {
                    foreach ($ChildSubCategorydata as $key => $value) {

                        $subChild = $ChildSubCategoryModel->where('sub_chid_id', $value['child_id'])->findAll();
    
                        $product = $productmodel->where('child_id', $value['child_id'])->findAll();
    
                        $value['isProduct'] = count($product) > 0 ? true : false;
    
                        $childCatResult[] = $value;
                    }
                }
                if($productId){

                }

                return view('front/products/index', ['headerData' => $headerData, 'sidebarData' => $this->processCategories(), 'categoryData' => [], 'subCategoryData' => [], 'childCategoryData' => $childCatResult, 'catName' => $cateId, 'subCatName' => $subCatId, 'productData' => $productData]);
            }

            return view('front/products/index', ['headerData' => $headerData, 'sidebarData' => $this->processCategories(), 'categoryData' => [], 'subCategoryData' => $getCategoryData]);
        }
        else
        {
            return view('front/products/index', ['headerData' => $headerData, 'sidebarData' => $this->processCategories(), 'categoryData' => $categoryData, 'subCategoryData' => []]);
        }
    }

    // Recursive function to process child_arr and product_arr for each child subcategory
    function processChildArr($childArr) {
        $productmodel = new ProductModel();
        $ChildSubCategoryModel = new ChildSubCategoryModel();
        foreach ($childArr as &$child) {
            // Fetch products for the current child subcategory
            $childSubCategoryProducts = $productmodel->where('child_id', $child['child_id'])->findAll();
            $childProductArr = $this->fetchProductDetails($childSubCategoryProducts);

            $subChild = $ChildSubCategoryModel->where('sub_chid_id', $child['child_id'])->findAll();
            $product = $productmodel->where('child_id', $child['child_id'])->findAll();
            $child['isProduct'] = count($product) > 0 ? true : false;

            $child['child_arr'] = $child['child_arr'] ?? [];
            $child['product_arr'] = $childProductArr;

            // Recursively process child_arr and product_arr for each child subcategory
            $child['child_arr'] = $this->processChildArr($child['child_arr']);
        }

        return $childArr;
    }

    // Recursive function to process categories
    function processCategory($category) {
        $ChildSubCategoryModel = new ChildSubCategoryModel();
        $childSubCategories = $ChildSubCategoryModel->where('sub_chid_id', '0')->where('sub_category_id', $category['sub_category_id'])->findAll();

        foreach ($childSubCategories as $childSubCategory) {
            $childSubCategory = $this->processChildCategory($childSubCategory);
            $category['child_arr'][] = $childSubCategory;
        }

        return $category;
    }

    // Recursive function to process child categories
    function processChildCategory($childCategory) {
        $ChildSubCategoryModel = new ChildSubCategoryModel();
        $productmodel = new ProductModel();
        $subChildCategories = $ChildSubCategoryModel->where('sub_chid_id', $childCategory['child_id'])->findAll();

        foreach ($subChildCategories as $subChildCategory) {
            $subChild = $ChildSubCategoryModel->where('sub_chid_id', $childCategory['child_id'])->findAll();
            $product = $productmodel->where('child_id', $childCategory['child_id'])->findAll();
            $subChildCategory['isProduct'] = count($product) > 0 ? true : false;

            $subChildCategory = $this->processChildCategory($subChildCategory);
            $childCategory['child_arr'][] = $subChildCategory;
        }

        return $childCategory;
    }

    // Function to fetch product details
    function fetchProductDetails($products) {
        $variantsmodel = new VariantsModel();
        $newPro = [];
        foreach ($products as $variant) {
            $variantData = $variantsmodel->where('product_id', $variant['product_id'])->first();
            $variant['parent'] = $variantData ? $variantData['parent'] : '';
            $newPro[] = $variant;
        }
        return $newPro;
    }

    // Define the function to process categories
    function processCategories() {

        $categorymodel = new CategoryModel();
        $subcategorymodel = new SubCategoryModel();
        $productmodel = new ProductModel();

        $categoryData = $categorymodel->find();

        $result = [];

        foreach ($categoryData as $category) {
            $subcategory_array = [];

            // Fetch subcategories for the current category
            $subcategories = $subcategorymodel->where('category_id', $category['category_id'])->findAll();

            foreach ($subcategories as $subCategory) {
                $subCategory = $this->processCategory($subCategory);

                // Fetch products for the current subcategory
                $subCategoryProducts = $productmodel->where('sub_category_id', $subCategory['sub_category_id'])->where('child_id', -1)->findAll();
                $subCategoryProductArr = $this->fetchProductDetails($subCategoryProducts);

                $subCategory['child_arr'] = $subCategory['child_arr'] ?? [];
                $subCategory['product_arr'] = $subCategoryProductArr;

                // Recursively process child_arr and product_arr for each child subcategory
                $subCategory['child_arr'] = $this->processChildArr($subCategory['child_arr']);

                $subcategory_array[] = $subCategory;
            }

            // Attach subcategories to the current category
            $category['sub_category'] = $subcategory_array;
            $result[] = $category;
        }

        return $result;
    }
}