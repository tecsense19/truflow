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



class Home extends BaseController
{
    public function index()
    {
        //home section
        $session = session();
        $model = new SettingsModel();
        $settingsImagesModel = new SettingsImagesModel();
        $welcomeData = $model->where('type', 'welcome')->first();
        $aboutData = $model->where('type', 'about')->first();
        $contactData = $model->where('type', 'contact')->first();
        $productData = $model->where('type', 'product')->first();
        $testominalData = $model->where('type', 'testominal')->first();
        $partnerData = $model->where('type', 'partner')->first();

        $imageData = $settingsImagesModel->where('setting_id', $welcomeData['setting_id'])->first();

        if (!$imageData) {
            $imageData = null;
        }

        //paertner images
        $partnerImageData = $settingsImagesModel->where('setting_id', $partnerData['setting_id'])->find();
        if (!$partnerImageData) {
            $partnerImageData = null;
        }

        //testominal section
        $testominalmodel = new TestominalModel();
        $testimonalData = $testominalmodel->find();
        if (!$testimonalData) {
            $testimonalData = null;
        }

        //header menu section
        $headermenumodel = new HeaderMenuModel();
        $headerData = $headermenumodel->find();
        if (!$headerData) {
            $headerData = null;
        }
        $productmodel = new ProductModel();
        $categorymodel = new CategoryModel();
        $subcategorymodel = new SubCategoryModel();
        $ChildSubCategoryModel = new ChildSubCategoryModel();

        $allcategoryData1 = $categorymodel->where('category_featured', 1)->findAll();
        $allcategoryData2 = $subcategorymodel->where('sub_category_featured', 1)->findAll();
        $allcategoryData3 = $ChildSubCategoryModel->where('child_sub_category_featured', 1)->findAll();
        $allcategoryData = [];

            $allcategoryData['category'] = $allcategoryData1;


            $allcategoryData['sub_category'] = $allcategoryData2;


            $allcategoryData['child_sub'] = $allcategoryData3;


        $subcategoryData = $subcategorymodel->orderBy('created_at', 'DESC')->findAll(5);
        $variantsmodel = new VariantsModel();
        foreach ($subcategoryData as &$category) {
            $newData2 = [];
            $productdata = $productmodel->where('sub_category_id', $category['sub_category_id'])->findAll();
            foreach ($productdata as $pnewdata) {
                $variantData = $variantsmodel->where('product_id', $pnewdata['product_id'])->first();

                if ($variantData !== null) {
                    $count = count($variantData);
                    // Your code here using $count
                } else {
                    $count = 0;
                }

                $pnewdata['parent'] = $count > 0 ? $variantData['parent'] : '';
                $newData2[] = $pnewdata;
            }
            $category['products'] =  $newData2;
        }
        $newProductdata = $productmodel->where('featured_category', 1)->findAll();
        if (!$newProductdata) {
            $newProductdata = null;
        }
        $variantsmodel = new VariantsModel();
        $newData1 = [];
        if(isset($newProductdata))
        {
            foreach ($newProductdata as $pdata) {
                $variantData = $variantsmodel->where('product_id', $pdata['product_id'])->first();
                $pdata['parent'] = $variantData ? $variantData['parent'] : '';

                $categorydata = $categorymodel->where('category_id', $pdata['category_id'])->first();
                $pdata['category_name'] = $categorydata ? $categorydata['category_name'] : '';


                $subcategory = $subcategorymodel->where('sub_category_id', $pdata['sub_category_id'])->first();
                $pdata['sub_category_name'] = $subcategory ? $subcategory['sub_category_name'] : '';

                if(isset($pdata['child_id']))
                {
                    $ChildSubCategory = $ChildSubCategoryModel->where('sub_category_id', $pdata['sub_category_id'])
                    ->where('child_id', $pdata['child_id'])
                    ->first();
                    $pdata['child_sub_category_name'] = isset($ChildSubCategory) ? $ChildSubCategory['child_sub_category_name'] : '';
                    $newData1[] = $pdata;
                }
            }
        }

        $session = session();
        $userId = $session->get('user_id');
        $addwishlistmodel = new AddwishlistModel();
        $wishlistData = $addwishlistmodel->select('*')->where('user_id', $userId)->findAll();
        $wishlistCount = count($wishlistData ?? []);
        $session->set('wishlistCount', $wishlistCount);
        $cartmodel = new CartModel();
        $cartData = $cartmodel->select('*')->where('user_id', $userId)->findAll();
        $cartCount = count($cartData ?? []);
        $session->set('cartCount', $cartCount);

        $slidermodel = new SliderModel();
        $sliderData = $slidermodel->findAll();
        if (!$sliderData) {
            $sliderData = null;
        }

        // echo "<pre>";
        // print_r($subcategoryData);
        // die;

        return view(
            'front/index',
            [
                'welcomeData' => $welcomeData,
                'aboutData' => $aboutData,
                'contactData' => $contactData,
                'productData' => $productData,
                'testominalData' => $testominalData,
                'partnerData' => $partnerData,
                'imageData' => $imageData,
                'partnerImageData' => $partnerImageData,
                'testimonalData' => $testimonalData,
                'headerData' => $headerData,
                // ---- add other
                'newProductdata' => $newData1,
                'categoryData' => $subcategoryData,

                // ---- allcategoryData

                'allcategoryData' => $allcategoryData,
                //count
                'wishlistCount' => $wishlistCount,
                'cartCount' => $cartCount,

                //
                'sliderData' => $sliderData
            ]
        );
    }
    public function about()
    {
        $headermenumodel = new HeaderMenuModel();
        $headerData = $headermenumodel->find();
        if (!$headerData) {
            $headerData = null;
        }
        return view('front/about', ['headerData' => $headerData]);
    }
    public function shop()
    {
        $headermenumodel = new HeaderMenuModel();
        $headerData = $headermenumodel->find();
        if (!$headerData) {
            $headerData = null;
        }
        $categorymodel = new CategoryModel();
        $subcategorymodel = new SubCategoryModel();
        $categoryData = $categorymodel->find();
        // $category1 = [];
        // foreach ($categoryData as $category) {
        //     $subcategory = $subcategorymodel->where('category_id', $category['category_id'])->findAll();
        //     $category['sub_category'] = $subcategory;
        //     $category1[] = $category;
        // }
        // if (!$category1) {
        //     $category1 = null;
        // }
        return view('front/shop', ['headerData' => $headerData, 'categoryData' => $this->processCategories()]);
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

    public function sub_category($category_id)
    {
        $ChildSubCategoryModel = new ChildSubCategoryModel();
        $ChildSubCategorydata = $ChildSubCategoryModel->where('sub_category_id', $category_id)->where('sub_chid_id', 0)->findAll();
        if (!$ChildSubCategorydata) {
            $ChildSubCategorydata = null;
        }

        $headermenumodel = new HeaderMenuModel();
        $headerData = $headermenumodel->find();
        if (!$headerData) {
            $headerData = null;
        }
        $categorymodel = new CategoryModel();
        $categoryData = $categorymodel->find($category_id);
        if (!$categoryData) {
            return redirect()->back();
        }
        $subcategorymodel = new SubCategoryModel();
        $subcategoryData = $subcategorymodel->where('category_id', $category_id)->findAll();
        $productmodel = new ProductModel();
        $variantsmodel = new VariantsModel();
        $subcategory1 = [];
        foreach ($subcategoryData as $subcategory) {
            $product = $productmodel->where('sub_category_id', $subcategory['sub_category_id'])->findAll();
            $ChildSubCategorydata = $ChildSubCategoryModel->where('sub_category_id', $subcategory['sub_category_id'])->findAll();
            $newPro = [];
            foreach ($product as $variant) {

                $variantData = $variantsmodel->where('product_id', $variant['product_id'])->first();
                $variant['parent'] = $variantData ? $variantData['parent'] : '';

                $newPro[] = $variant;
            }
            $subcategory['product_array'] = $newPro;
            $subcategory['is_child'] = count($ChildSubCategorydata) > 0 ? true : false;
            $subcategory1[] = $subcategory;

        }

        return view('front/sub_category', [
            'headerData' => $headerData,
            'subcategoryData' => $subcategory1,
            'ChildSubCategorydata' => $ChildSubCategorydata,
            'categoryData' => $categoryData
        ]);
    }

    public function child_sub_category($subcategory_id)
    {

        $subcategorymodel = new SubCategoryModel();

        $ChildSubCategoryModel = new ChildSubCategoryModel();
       // $ChildSubCategorydata = $ChildSubCategoryModel->where('sub_category_id' , $category_id)
                                                     // ->where('sub_chid_id', 0)->findAll();

        // if (!$ChildSubCategorydata) {
        //     $ChildSubCategorydata = null;
        // }
        $headermenumodel = new HeaderMenuModel();
        $headerData = $headermenumodel->find();
        if (!$headerData) {
            $headerData = null;
        }
        $categorymodel = new CategoryModel();
        // $categoryData = $categorymodel->find($category_id);
        // if (!$categoryData) {
        //     return redirect()->back();
        // }

        $productmodel = new ProductModel();
        $variantsmodel = new VariantsModel();

        $responseArr = [];
        $categoryData = $ChildSubCategoryModel->findAll();
        foreach ($categoryData as $key => $value)
        {
            $subcategories = $subcategorymodel->where('category_id', $value['category_id'])->findAll();

            $subArr = [];
            foreach ($subcategories as $sKey => $sValue)
            {
                $childsubcategories = $ChildSubCategoryModel->where('sub_chid_id', '0')->where('sub_category_id', $subcategory_id)->findAll();
                $childArr = [];
                foreach ($childsubcategories as $cKey => $cValue)
                {
                    $product = $productmodel->where('child_id', $cValue['child_id'])->findAll();
                    $child_prod_Arr = [];
                    foreach ($product as $variant) {
                        $variantData = $variantsmodel->where('product_id', $variant['product_id'])->first();
                        $variant['parent'] = $variantData ? $variantData['parent'] : '';
                        $child_prod_Arr[] = $variant;
                    }
                    $cValue['variant'] = $child_prod_Arr;

                    $allChild = $this->getCategoryTree($cValue['child_id'], $ChildSubCategoryModel);
                    $cValue['is_child'] = count($allChild) > 0 ? true : false;
                    $cValue['all_childs'] = $allChild;
                    $childArr[] = $cValue;

                }

                $sValue['child_arr'] = $childArr;
                $subArr[] = $sValue;

            }


        }
        $value['sub_cat'] = $subArr;
        $responseArr[] = $value;
    //    echo "<pre>";
    //     print_r($responseArr);
    //     die;
        // $subcategory1 = [];
        // foreach ($subcategoryData as $subcategory) {
        //     $product = $productmodel->where('sub_category_id', $subcategory['sub_category_id'])->findAll();

        //     $newPro = [];
        //     foreach ($product as $variant) {

        //         $variantData = $variantsmodel->where('product_id', $variant['product_id'])->first();
        //         $variant['parent'] = count($variantData) > 0 ? $variantData['parent'] : '';
        //         $newPro[] = $variant;

        //     }

        //     $subcategory['product_array'] = $newPro;


        // }

        // $subcategory['is_child'] = count($ChildSubCategorydata2) > 0 ? true : false;
        // $subcategory['child_array'] = $ChildSubCategorydata2 ;
        // $subcategory1[] = $subcategory;



        return view('front/child_sub_category', [
            'headerData' => $headerData,
            'ChildSubCategorydata' => $responseArr,
            'categoryData' => $categoryData
        ]);
    }

    public function child_sub_sub_category($category_id)
    {

        $ChildSubCategoryModel = new ChildSubCategoryModel();
        $ChildSubCategorydata1 = $ChildSubCategoryModel->where('sub_chid_id', $category_id)->where('sub_chid_id <>', 0)->findAll();

        if(!empty($ChildSubCategorydata1[0]['sub_chid_id'])){
            $ChildSubCategorydata = $ChildSubCategoryModel->where('sub_chid_id', $category_id)->where('sub_chid_id <>', 0)->findAll();
        }else{
            return redirect()->back();
        }
        //$ChildSubCategorydata2 = $ChildSubCategoryModel->findAll();

        if (!$ChildSubCategorydata) {
            $ChildSubCategorydata = null;
        }

        $headermenumodel = new HeaderMenuModel();
        $headerData = $headermenumodel->find();
        if (!$headerData) {
            $headerData = null;
        }
        // $categorymodel = new CategoryModel();
        // $categoryData = $categorymodel->find($category_id);
        // if (!$categoryData) {
        //     return redirect()->back();
        // }
        $subcategorymodel = new SubCategoryModel();
        $subcategoryData = $subcategorymodel->where('category_id', $category_id)->findAll();
        $productmodel = new ProductModel();
        $variantsmodel = new VariantsModel();
        $subcategory1 = [];
        foreach ($subcategoryData as $subcategory) {
            $product = $productmodel->where('sub_category_id', $subcategory['sub_category_id'])->findAll();

            $newPro = [];
            foreach ($product as $variant) {

                $variantData = $variantsmodel->where('product_id', $variant['product_id'])->first();
                $variant['parent'] = $variantData ? $variantData['parent'] : '';
                $newPro[] = $variant;
            }
            $subcategory['product_array'] = $newPro;
            $subcategory1[] = $subcategory;
        }

        return view('front/child_sub_sub_category', [
            'headerData' => $headerData,
            'subcategoryData' => $subcategory1,
            'ChildSubCategorydata' => $ChildSubCategorydata
        ]);
    }
    public function product($sub_category_id, $childId)
    {
        $session = session();
        $sub_category_id = session()->get('sub_category_id');
        $childId = session()->get('child_id');
        // if(!$childId){
        //     $childId = session()->get('childsubcategory_id');
        // }

        $ChildSubCategoryModel = new ChildSubCategoryModel();

        $ChildSubCategorydata = $ChildSubCategoryModel->where('sub_chid_id', '0')->where('sub_category_id', $sub_category_id)->findAll();
        if (!$ChildSubCategorydata) {
            $ChildSubCategorydata = null;
        }
        // echo "<pre>";
        // print_r($ChildSubCategorydata);
        // die;

        $headermenumodel = new HeaderMenuModel();
        $headerData = $headermenumodel->find();
        if (!$headerData) {
            $headerData = null;
        }
        $subcategorymodel = new SubCategoryModel();
        $subcategoryData = $subcategorymodel->find($sub_category_id);


        if (!$subcategoryData) {
            $subcategoryData = null;
        }
        $productmodel = new ProductModel();
        $productData = [];
        if($childId)
        {
            $productData = $productmodel->where('sub_category_id', $sub_category_id)
                                        ->where('child_id', $childId)
                                        ->findAll();
        }
        else
        {
            $productData = $productmodel->where('sub_category_id', $sub_category_id)->findAll();
        }

        $variantsmodel = new VariantsModel();
        $newData = [];
        foreach ($productData as $pdata) {
            $variantData = $variantsmodel->where('product_id', $pdata['product_id'])->first();
            $pdata['parent'] = $variantData ? $variantData['parent'] : '';
            $newData[] = $pdata;
        }
        // --------------------------------------------
        $subcategoryData1 = $subcategorymodel->find();
        $subCatData = [];
        foreach ($subcategoryData1 as $subCat) {
            $productData1 = [];
            if($childId)
            {
                $productData1 = $productmodel->where('sub_category_id', $subCat['sub_category_id'])
                                            ->where('child_id', $childId)
                                            ->findAll();
            }
            else
            {
                $productData1 = $productmodel->where('sub_category_id', $subCat['sub_category_id'])->findAll();
            }

            $varaints = [];
            foreach ($productData1 as $product) {
                $variantData1 = $variantsmodel->where('product_id', $product['product_id'])->first();
                $product['parent'] = $variantData1 ? $variantData1['parent'] : '';
                $varaints[] = $product;
            }
            $subCat['product_array'] = $varaints;
            $subCatData[] = $subCat;
        }

        $responseArr = [];
        $categoryData = $ChildSubCategoryModel->findAll();
        foreach ($categoryData as $key => $value)
        {
            $subcategories = $subcategorymodel->where('category_id', $value['category_id'])->findAll();
            $subArr = [];
            foreach ($subcategories as $sKey => $sValue)
            {
                $childsubcategories = $ChildSubCategoryModel->where('sub_chid_id', '0')->where('sub_category_id', $sValue['sub_category_id'])->findAll();
                $childArr = [];
                foreach ($childsubcategories as $cKey => $cValue)
                {
                    $allChild = $this->getCategoryTree($cValue['child_id'], $ChildSubCategoryModel);
                    $cValue['all_childs'] = $allChild;
                    $childArr[] = $cValue;
                }
                $sValue['child_arr'] = $childArr;
                $subArr[] = $sValue;
            }
            $value['sub_cat'] = $subArr;
            $responseArr[] = $value;
        }
        // --------------------------------------------

        // $sidebar_array = [];
        // foreach ($ChildSubCategorydata as $key => $value) {

        //     $subChild = $ChildSubCategoryModel->where('sub_chid_id', $value['child_id'])->findAll();

        //     $product = $productmodel->where('child_id', $value['child_id'])->findAll();
        //     $newPro = [];
        //     foreach ($product as $variant) {

        //         $variantData = $variantsmodel->where('product_id', $variant['product_id'])->first();
        //         $variant['parent'] = count($variantData) > 0 ? $variantData['parent'] : '';

        //         $newPro[] = $variant;
        //     }

        //     $value['child_arr'] = $subChild;
        //     $value['product_arr'] = $newPro;
        //     $sidebar_array[] = $value;
        // }



        // $product = $productmodel->where('child_id', $sub_category_id)->findAll();
        // $newPro = [];
        // foreach ($product as $variant) {

        //     $variantData = $variantsmodel->where('product_id', $variant['product_id'])->first();
        //     $variant['parent'] = count($variantData) > 0 ? $variantData['parent'] : '';

        //     $newPro[] = $variant;
        // }


        // echo "<pre>";
        // print_r($breadcrumbData);
        // die;
        //---------------------------------------------
        return view('front/product', [
            'headerData' => $headerData,
            'subcategoryData' => $subcategoryData,
            'subcategoryData1' => $subCatData,
            'ChildSubCategoryData' => $ChildSubCategorydata,
            'categories'=>$responseArr,
            'productData' => $newData,
            // 'sidebar_array' => $sidebar_array,
            // 'newPro' => $newPro,
            'subcategoryid' => $sub_category_id,
            'categoryData' => $this->processCategories()
        ]);
    }
    protected function getCategoryTree(int $parentCategoryId = null, ChildSubCategoryModel $model)
    {
        $categories = [];

    //     $query = $model->select('product.*, child_sub_category.child_sub_category_name')
    // ->join('child_sub_category', 'product.child_id = child_sub_category.child_id', 'inner')
    // ->get();

        $query = $model->select('child_id , sub_category_id, child_sub_category_name', )
                       ->where('sub_chid_id', $parentCategoryId)
                       ->get();
        foreach ($query->getResult() as $row) {
            $row->children = $this->getCategoryTree($row->child_id, $model);
            $categories[] = $row;
        }
        return $categories;
    }
    public function product_details($product_id)
    {

        $session = session();
        $product_id = session()->get('product_details_id');

        $headermenumodel = new HeaderMenuModel();
        $headerData = $headermenumodel->find();
        if (!$headerData) {
            $headerData = null;
        }

        $productmodel = new ProductModel();
        $variantsmodel = new VariantsModel();

        $productmodel = new ProductModel();

        $productData = $productmodel->join('product_variants', 'product_variants.product_id = product.product_id')
            ->where('product.product_id', $product_id)
            ->orderBy("CAST(sort AS SIGNED)", 'asc')
            ->findAll();

        $productDataPrice = $variantsmodel->table('product_variants')
            ->select('MIN(variant_price) AS min_price, MAX(variant_price) AS max_price')
            ->join('product', 'product.product_id = product_variants.product_id')
            ->where('product.product_id', $product_id)
            ->orderBy("CAST(sort AS SIGNED)", 'asc')
            ->findAll();

        if (!$productData) {
            $productData = null;
        }
        if (!$productDataPrice) {
            $productDataPrice = null;
        }
        $addwishlistmodel = new AddwishlistModel();
        $session = session();
        $userId = $session->get('user_id');


        $addwishData = $addwishlistmodel->select('*')
        ->where('product_id', $product_id)
        ->where('user_id', $userId)
            ->findAll();


        if (!$addwishData) {
            $addwishData = null;
        }

        $product_details = current_url(true);
        $session->set('product_details', $product_details);

        $subcategorymodel = new SubCategoryModel();
        $subcategoryData1 = $subcategorymodel->findAll();

        $get_product = $productmodel->where('product_id', $product_id)->first();


        $sub_cat_data = [];
            $productData1 = $productmodel->where('sub_category_id', $get_product['sub_category_id'])->findAll(4);
            $variantsmodel = new VariantsModel();
            $newData_p = [];
            foreach ($productData1 as $pdata1) {

                $variantData1 = $variantsmodel->where('product_id', $pdata1['product_id'])->first();
                $pdata1['parent'] = $variantData1 ? $variantData1['parent'] : '';
                $newData_p[] = $pdata1;
            }
            $sub_cat_data[] = $newData_p;

        $addwishlistmodel = new AddwishlistModel();
        $wishlistData = $addwishlistmodel->select('*')->where('user_id', $userId)->findAll();
        $wishlistCount = count($wishlistData ?? []);
        $session->set('wishlistCount', $wishlistCount);

        $productratingmodel = new ProductRatingModel();
        //$ratingData = $productratingmodel->select_avg('rat_number')->where('product_id', $product_id)->findAll();
        $ratingData = $productratingmodel->select('AVG(rat_number) as average_rating')->where('product_id', $product_id)->first();
        $averageRating = $ratingData['average_rating'];

        $rating = $productratingmodel->select('*')->where(['product_id' => $product_id])->countAllResults();
        // echo "<pre>";
        // print_r($averageRating);
        // die();

        return view('front/product_details', [
            'headerData' => $headerData,
            'productData' => $productData,
            'productDataPrice' => $productDataPrice,
            'addwishData' => $addwishData,
            'sub_cat_data' => $newData_p,
            'wishlistCount' => $wishlistCount,
            'averageRating' => $averageRating,
            'rating'=>$rating

        ]);
    }
    public function searchData()
    {
        $input = $this->request->getVar('search');
        $variantsModel = new VariantsModel();

        // Search for exact match
        $result = $variantsModel->where('variant_sku', $input)->find();

        // If no exact match found, search for similar words
        if (empty($result)) {
            $result = $variantsModel->like('variant_sku', '%' . $input . '%')->find();
        }

        header('Content-Type: application/json');

        if (!empty($result)) {
            echo json_encode($result);
        } else {
            echo json_encode(['error' => 'Not found']);
        }
    }
    public function searchSimilarData()
    {
        $input = $this->request->getVar('search');
        $variantsModel = new VariantsModel();

        // Search for exact match
        $result = $variantsModel->where('variant_sku', $input)->find();

        // If no exact match found, search for similar words
        if (empty($result)) {
            $result = $variantsModel->like('variant_sku', '%' . $input . '%')->find();
        }

        header('Content-Type: application/json');

        if (!empty($result)) {
            echo json_encode($result);
        } else {
            echo json_encode(['error' => 'Not found']);
        }
    }

    public function add_to_cart()
    {

        $cartmodel = new CartModel();
        $headermenumodel = new HeaderMenuModel();
        $headerData = $headermenumodel->find();

        if (!$headerData) {
            $headerData = null;
        }

        $session = session();
        $userId = $session->get('user_id');
        $componey_name = $session->get('company_name');

        $query = $cartmodel->select('*')
            ->join('product_variants', 'product_variants.variant_id = add_to_cart.variant_id', 'left')
            ->join('product', 'product.product_id = product_variants.product_id', 'left')
            ->join('sub_category', 'sub_category.sub_category_id = product.sub_category_id', 'left')
            ->join('category', 'category.category_id = sub_category.category_id', 'left')
            ->join('users', 'users.user_id = add_to_cart.user_id', 'left')
            ->join('company', 'company.company_name = users.company_name', 'left')
            ->where('add_to_cart.user_id', $userId)
            ->get();

        $cartData = $query->getResultArray();

        if (!$cartData) {
            $cartData = null;
        }
        $componeyModel = new CompanyModel;
        $usermodel = new UserModel;

        $query2 = $componeyModel->select('*')
            ->join('users', 'users.company_name = company.company_name', 'left')
            ->where('user_id', $userId)
            ->get();

        $componeyData = $query2->getResultArray();
        if (!$componeyData) {
            $componeyData = null;
        }

        $cartCount = count($cartData ?? []);

        $session->set('cartCount', $cartCount);

        $couponModel = new CouponModel;
        $discount = 000.00;
        if(isset($cartData) && !empty($cartData))
        {
            foreach($cartData as $cartD)
            {
                $getCoupon = $couponModel->where('coupon_id', $cartD['coupon_id'])->first();
                if(!empty($getCoupon))
                {
                    if ($getCoupon['coupon_price_type'] == 'Percentage')
                    {
                        $discount += ($cartD['total_amount'] * $getCoupon['coupon_price']) / 100;
                    } else if ($getCoupon['coupon_price_type'] == 'Flat') {
                        $discount += $cartD['total_amount'] - $getCoupon['coupon_price'];
                    }
                }
            }
        }

        return view('front/add_to_cart', [
            'cartData' => $cartData,
            'headerData' => $headerData,
            'userId' => $userId,
            'cartCount' => $cartCount,
            'componeyData' => $componeyData,
            'total_auto_discount' => $discount
        ]);
    }
    public function add_cart()
    {
        $cartmodel = new CartModel();
        $session = session();
        $variantQtys = $this->request->getVar('variant_qty');
        $variantIds = $this->request->getVar('variant_id');
        $productIds = $this->request->getVar('product_id');
        $categoryIds = $this->request->getVar('category_id');
        $subCategoryIds = $this->request->getVar('sub_category_id');
        $prices = $this->request->getVar('prices');
        $totalPrices = $this->request->getVar('total_prices');

        $userId = $session->get('user_id');

        for ($i = 0; $i < count($variantQtys); $i++) {
            if ($variantQtys[$i] > 0) {
                $data = array(
                    'user_id' => $userId,
                    'product_quantity' => $variantQtys[$i],
                    'variant_id' => $variantIds[$i],
                    'product_id' => $productIds[$i],
                    'category_id' => $categoryIds[$i],
                    'sub_category_id' => $subCategoryIds[$i],
                    'product_amount' => $prices[$i],
                    'total_amount' => $totalPrices[$i]
                );


                $cartmodel->insert($data);
            }
        }
        $session->setFlashdata('success', 'Data add to cart successfully.');

        return redirect()->back();
    }
    public function cartDelete($cart_id)
    {
        $session = session();
        $cartmodel = new CartModel();
        $cartmodel->delete($cart_id);
        $session->setFlashdata('success', 'remove cart item succesfully.');
        return redirect()->to(base_url('add/cart'));
    }
    public function cartDelete_check($cart_id)
    {
        $session = session();
        $cartmodel = new CartModel();
        $cartmodel->delete($cart_id);
        $session->setFlashdata('success', 'remove item succesfully.');
        return redirect()->back();
    }
    public function add_to_cart_new()
    {
        $cartmodel = new CartModel();
        $session = session();
        $userId = $session->get('user_id');

        $partno = $this->request->getPost('search');
        $quantity = $this->request->getPost('quality');

        $variantsModel = new VariantsModel();
        $productmodel = new ProductModel();


        $variantRecords = array();

        for ($i = 0; $i < count($partno); $i++) {
            $variantSku = $partno[$i];
            $quantityValue = $quantity[$i];

            $variant = $variantsModel->where('variant_sku', $variantSku)->first();
            if ($variant) {
                $product = $productmodel->where('product_id', $variant['product_id'])->first();

                $add_cart = array(
                    'user_id' => $userId,
                    'variant_id' => $variant['variant_id'],
                    'product_id' => $product['product_id'],
                    'category_id' => $product['category_id'],
                    'sub_category_id' => $product['sub_category_id'],
                    'product_amount' => $variant['variant_price'],
                    'product_quantity' => $quantityValue,
                    'total_amount' => $variant['variant_price'] * $quantityValue
                );

                $cartmodel->insert($add_cart);
            }
        }
        $session->setFlashdata('success', 'Data added to cart successfully.');

        return redirect()->back();
    }
    public function searchData1()
    {
        $input = $this->request->getVar('search');
        $variantsModel = new VariantsModel();

        // Search for exact match
        $result = $variantsModel->where('variant_sku', $input)->find();

        // If no exact match found, search for similar words
        if (empty($result)) {
            $result = $variantsModel->like('variant_sku', '%' . $input . '%')->find();
        }

        header('Content-Type: application/json');

        if (!empty($result)) {
            echo json_encode($result);
        } else {
            echo json_encode(['error' => 'Not found']);
        }
    }

    public function wish_list()
    {
        $cartmodel = new CartModel();
        $headermenumodel = new HeaderMenuModel();
        $addwishlistmodel = new AddwishlistModel();
        $productmodel = new ProductModel();
        $variantsModel = new VariantsModel();
        $headerData = $headermenumodel->find();

        if (!$headerData) {
            $headerData = null;
        }
        $session = session();
        $userId = $session->get('user_id');
        $wishlistData = $addwishlistmodel->where('user_id', $userId)->findAll();
        $newwish = [];
        foreach ($wishlistData as $pnewdata) {
            $productData = $productmodel->where('product_id', $pnewdata['product_id'])->first();

            $pnewdata['product_name'] = $productData['product_name'];
            $pnewdata['product_img'] = $productData['product_img'];
            $productvariantData = $variantsModel->where('product_id', $productData['product_id'])->first();
            $pnewdata['variant_sku'] = $productvariantData['variant_sku'];
            $pnewdata['variant_price'] = $productvariantData['variant_price'];

            $newwish[] = $pnewdata;
        }

        if (!$wishlistData) {
            $wishlistData = null;
        }

        $wishlistCount = count($wishlistData ?? []);
        $session->set('wishlistCount', $wishlistCount);

        return view('front/wish_list', [
            'wishlistData' => $newwish,
            'headerData' => $headerData,
            'userId' => $userId,
            'wishlistCount' => $wishlistCount,
        ]);
    }
    public function deleteWishList_data($cart_id)
    {
        $session = session();
        $addwishlistmodel = new AddwishlistModel();
        $addwishlistmodel->delete($cart_id);
        $session->setFlashdata('success', 'remove succesfully.');
        return redirect()->to(base_url('wishlist'));
    }
    public function add_wishlist() //image change
    {

        $product_id = $this->request->getVar('product_id');
        $user_id = session()->get('user_id');
        $addwishlistmodel = new AddwishlistModel();

        $data = [
            'product_id' => $product_id,
            'user_id' => $user_id,
            'isDeleted' => 0
        ];

        $addwishlistmodel->insert($data);
        return redirect()->back();
    }
    public function deleteWishList() //image change
    {
        $product_id = $this->request->getVar('product_id');
        $user_id = session()->get('user_id');
        $addwishlistmodel = new AddwishlistModel();

        $condition = [
            'product_id' => $product_id,
            'user_id' => $user_id

        ];
        // Delete the record from the wishlist table
        $addwishlistmodel->where($condition)->delete();

        return redirect()->back();
    }

    public function terms_and_condition()
    {
        $headermenumodel = new HeaderMenuModel();
        $headerData = $headermenumodel->find();
        if (!$headerData) {
            $headerData = null;
        }
        return view('front/terms_and_condition', ['headerData' => $headerData]);
    }

    public function privacy_policy()
    {
        $headermenumodel = new HeaderMenuModel();
        $headerData = $headermenumodel->find();
        if (!$headerData) {
            $headerData = null;
        }
        return view('front/privacy_policy', ['headerData' => $headerData]);
    }

    public function disclaimer()
    {
        $headermenumodel = new HeaderMenuModel();
        $headerData = $headermenumodel->find();
        if (!$headerData) {
            $headerData = null;
        }
        return view('front/disclaimer', ['headerData' => $headerData]);
    }
    public function userContact()
    {
        $headermenumodel = new HeaderMenuModel();
        $headerData = $headermenumodel->find();
        if (!$headerData) {
            $headerData = null;
        }
        return view('front/user_contact', ['headerData' => $headerData]);
    }
    public function contactSave()
    {

        $usercontactmodel = new UserContactModel();
        $session = session();
        $contact_name = $this->request->getVar('contact_name');
        $contact_email = $this->request->getVar('contact_email');
        $company_name = $this->request->getVar('company_name');
        $contact_phone = $this->request->getVar('contact_phone');
        $message = $this->request->getVar('message');

        $data = array(

            'contact_name' => $contact_name,
            'contact_email' => $contact_email,
            'company_name' => $company_name,
            'contact_phone' => $contact_phone,
            'message' => $message

        );
        $usercontactmodel->insert($data);

        $html = view('front/contact_email', $data);

        $emailService = \Config\Services::email();

        $fromEmail = 'sendmail@testweb4you.com';
        $fromName = 'Truflow Hydraulics';
        // sales@truflowhydraulic.com.au
        $emailService->setFrom($fromEmail, $fromName);
        $emailService->setTo('sales@truflowhydraulic.com.au');
        $emailService->setSubject('Get in touch');
        $emailService->setMessage('
                <html>
                    <body>
                        '. $html .'
                    </body>
                </html>
            ');

        if ($emailService->send()) {
            echo "Yes";
        } else {
            echo "No";
        }

        $session->setFlashdata('success', 'Submit Your Details Successfully.');

        return redirect()->back();
    }
    public function addfeedback()
    {

        $productratingmodel = new ProductRatingModel();
        $session = session();
        $user_id = session()->get('user_id');
        $rat_number = $this->request->getVar('rating');
        $rat_message = $this->request->getVar('message');
        $product_id = $this->request->getVar('product_id');


        $data = array(

            'rat_user' => $user_id,
            'rat_message' => $rat_message,
            'rat_number' => $rat_number,
            'rat_date' => date("Y-m-d"),
            'product_id' => $product_id

        );
        $productratingmodel->insert($data);

        $session->setFlashdata('success', 'Submit Your Feedback Successfully.');

        return redirect()->back();
    }

    public function main_sub_category($category_id)
    {
        $session = session();
        $category_id = session()->get('category_id');

        $categorymodel = new CategoryModel();
        $breadcrumbData = $categorymodel->where('category_id', $category_id)->first();

        if($breadcrumbData)
        {
            $breadcrumb = "<div> / <a href='". base_url() ."shop'> ".strtoupper($breadcrumbData['category_name'])." </a> </div>";
            session()->set('breadcrumb', $breadcrumb);
        }

        $subcategorymodel = new SubCategoryModel();
        $productmodel = new ProductModel();
        $variantsmodel = new VariantsModel();

        //header menu section
        $headermenumodel = new HeaderMenuModel();
        $headerData = $headermenumodel->find();
        if (!$headerData) {
            $headerData = null;
        }

        $subcategoryData = $subcategorymodel->where('category_id', $category_id)->findAll();

        $sidebar_array = [];
        foreach ($subcategoryData as $key => $value) {
            $ChildSubCategoryModel = new ChildSubCategoryModel();
            $ChildSubCategorydata = $ChildSubCategoryModel->where('sub_chid_id', '0')->where('sub_category_id', $value['sub_category_id'])->findAll();

            $product = $productmodel->where('sub_category_id', $value['sub_category_id'])->where('child_id',-1)->findAll();
            $newPro = [];
            foreach ($product as $variant) {

                $variantData = $variantsmodel->where('product_id', $variant['product_id'])->first();
                $variant['parent'] = $variantData ? $variantData['parent'] : '';

                $newPro[] = $variant;
            }

            $value['child_arr'] = $ChildSubCategorydata;
            $value['product_arr'] = $newPro;
            $sidebar_array[] = $value;
        }
        $array = [];
        foreach ($subcategoryData as $key => $value) {
            $product = $productmodel->where('sub_category_id', $value['sub_category_id'])->where('child_id',-1)->findAll();
            $value['isProduct'] = count($product) > 0 ? true : false;
            $array[]=$value;
        }

    // echo "<pre>";
    // print_r($array);
    // die;

        return view('front/subcategory', ['subcategoryData' => $array, 'sidebar_array' => $sidebar_array, 'headerData' => $headerData, 'categoryData' => $category1 = $this->processCategories()]);

    }

    public function main_child_category($subcategory_id)
    {

        $session = session();
        $subcategory_id = session()->get('sub_category_id');

        $ChildSubCategoryModel = new ChildSubCategoryModel();

        $subcategorymodel = new SubCategoryModel();
        $productmodel = new ProductModel();
        $variantsmodel = new VariantsModel();
        $ChildSubCategorydata = $ChildSubCategoryModel->where('sub_chid_id', '0')->where('sub_category_id', $subcategory_id)->findAll();

        //header menu section
        $headermenumodel = new HeaderMenuModel();
        $headerData = $headermenumodel->find();
        if (!$headerData) {
            $headerData = null;
        }

        $categoryData = $subcategorymodel->find($subcategory_id);
        if (!$categoryData) {
            return redirect()->back();
        }


        $sidebar_array = [];
        foreach ($ChildSubCategorydata as $key => $value) {

            $subChild = $ChildSubCategoryModel->where('sub_chid_id', $value['child_id'])->findAll();

            $product = $productmodel->where('child_id', $value['child_id'])->findAll();
            $newPro = [];
            foreach ($product as $variant) {

                $variantData = $variantsmodel->where('product_id', $variant['product_id'])->first();
                $variant['parent'] = $variantData ? $variantData['parent'] : '';

                $newPro[] = $variant;
            }

            $value['child_arr'] = $subChild;
            $value['product_arr'] = $newPro;
            $sidebar_array[] = $value;
        }

        $array = [];
        foreach ($ChildSubCategorydata as $key => $value) {

            $subChild = $ChildSubCategoryModel->where('sub_chid_id', $value['child_id'])->findAll();

            $product = $productmodel->where('child_id', $value['child_id'])->findAll();

            $value['isProduct'] = count($product) > 0 ? true : false;

            $array[]=$value;
        }

        // Breadcrumbdata

        $getSubCatName = $subcategorymodel->where('sub_category_id', $subcategory_id)->first();

        $categorymodel = new CategoryModel();

        $catData = $categorymodel->where('category_id', $getSubCatName['category_id'])->first();

        $childCatLink = base_url('') . "childsub/category/" . $getSubCatName['sub_category_id'];

        $breadcrumb = "<div> / <a href='". base_url() ."shop'> ".strtoupper($catData['category_name'])." </a> </div> <div> / <a href='". $childCatLink ."'> ".strtoupper($getSubCatName['sub_category_name'])." </a> </div>";

        session()->set('breadcrumb', $breadcrumb);

        // Breadcrumbdata

        // echo "<pre>";
        // print_r($array);
        // die;
        return view('front/childsubcategory', ['ChildSubCategorydata' => $array, 'sidebar_array' => $sidebar_array,  'headerData' => $headerData, 'categoryData' => $category1 = $this->processCategories()]);

    }

    public function child_subchild_category($chid_id)
    {

        $session = session();
        $chid_id = session()->get('childsubcategory_id');

        $ChildSubCategoryModel = new ChildSubCategoryModel();
        $productmodel = new ProductModel();
        $variantsmodel = new VariantsModel();
        $ChildSubCategorydata = $ChildSubCategoryModel->where('sub_chid_id', $chid_id)->findAll();

         //header menu section
         $headermenumodel = new HeaderMenuModel();
         $headerData = $headermenumodel->find();
         if (!$headerData) {
             $headerData = null;
         }

        $sidebar_array = [];
        foreach ($ChildSubCategorydata as $key => $value) {

            $subChild = $ChildSubCategoryModel->where('sub_chid_id', $value['child_id'])->findAll();

            $product = $productmodel->where('child_id', $value['child_id'])->findAll();
            $newPro = [];
            foreach ($product as $variant) {

                $variantData = $variantsmodel->where('product_id', $variant['product_id'])->first();
                $variant['parent'] = $variantData ? $variantData['parent'] : '';

                $newPro[] = $variant;
            }
            $value['child_arr'] = $subChild;
            $value['product_arr'] = $newPro;
            $sidebar_array[] = $value;
        }

        $array = [];
        foreach ($ChildSubCategorydata as $key => $value) {

            $subChild = $ChildSubCategoryModel->where('sub_chid_id', $value['child_id'])->findAll();

            $product = $productmodel->where('child_id', $value['child_id'])->findAll();

            $value['isProduct'] = count($product) > 0 ? true : false;

            $array[]=$value;
        }
        // echo "<pre>";
        // print_r($array);
        // die;

        return view('front/child_subchild', ['child_subchild' => $array, 'sidebar_array' => $sidebar_array,  'headerData' => $headerData, 'categoryData' => $category1 = $this->processCategories()]);
    }

    public function getMetaTags()
    {
        $input = $this->request->getVar();

        $headerModel = new HeaderMenuModel();
        $metaModel = new MetaContentsModel();

        $getHeaderMenu = $headerModel->where('menu_link', $input['current_page'])->first();
        $getMetaTags = [];
        if(isset($getHeaderMenu))
        {
            $getMetaTags = $metaModel->where('menu_id', $getHeaderMenu['header_id'])->get()->getResultArray();
        }

        $metaHtml = '';

        if(count($getMetaTags) > 0)
        {
            foreach ($getMetaTags as $key => $value)
            {
                $metaHtml .= '<meta name="'.$value['meta_name'].'" content="'.$value['meta_content'].'">';
            }
        }

        echo $metaHtml;
    }

    public function breadcrumbStore()
    {
        $request = service('request');
        $breadcrumb = $request->getPost('breadcrumb');

        // Store the breadcrumb in the session
        session()->set('breadcrumb', $breadcrumb);

        return $this->response->setJSON(['message' => 'Breadcrumb stored successfully']);
    }

    public function breadcrumbUpdate()
    {
        $request = service('request');
        $breadcrumb = $request->getPost('breadcrumb');

        $oldBreadcrumb = session()->get('breadcrumb');

        // Store the breadcrumb in the session
        session()->set('breadcrumb', $oldBreadcrumb . $breadcrumb);

        return $this->response->setJSON(['message' => 'Breadcrumb stored successfully']);
    }

    public function breadcrumbReplace()
    {
        $request = service('request');
        $breadcrumb = $request->getPost('breadcrumb');

        // Store the breadcrumb in the session
        session()->set('breadcrumb', $breadcrumb);

        return $this->response->setJSON(['message' => 'Breadcrumb stored successfully']);
    }

    public function sessionStore()
    {
        $request = service('request');
        $category_id = $request->getPost('category_id');
        $sub_category_id = $request->getPost('sub_category_id');
        $child_id = $request->getPost('child_id');
        $product_details_id = $request->getPost('product_details_id');
        $childsubcategory_id = $request->getPost('childsubcategory_id');
        // echo $sub_category_id;
        // die();
        // Store the breadcrumb in the session
        if($category_id)
        {
            session()->set('category_id', $category_id);
        }
        if($sub_category_id)
        {
            session()->set('sub_category_id', $sub_category_id);
        }
        if($child_id)
        {
            session()->set('child_id', $child_id);
        }
        if($product_details_id)
        {
            session()->set('product_details_id', $product_details_id);
        }
        if($childsubcategory_id)
        {
            session()->set('childsubcategory_id', $childsubcategory_id);
        }

        return $this->response->setJSON(['message' => 'Session stored successfully']);
    }
}
