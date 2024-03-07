<?php

namespace App\Controllers\Admin;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use App\Models\VariantsModel;
use App\Models\CouponModel;
use App\Models\ChildSubCategoryModel;
use CodeIgniter\HTTP\RequestInterface;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ProductController extends BaseController
{
    public function index()
    {
        $session = session();
        $user_id = $session->get('user_id');
        if($user_id){
            $variantsmodel = new VariantsModel();
            $productmodel = new ProductModel();
            $CouponModel = new CouponModel();
    
            $productData = $productmodel->select('product.*, category.category_name, sub_category.sub_category_name')->where('deleted_at', 0)
                ->join('category', 'category.category_id = product.category_id')
                ->join('sub_category', 'sub_category.sub_category_id = product.sub_category_id')
                ->find();
            $newData2 = [];
            foreach ($productData as $pnewdata) {
                $variantData = $variantsmodel->where('product_id', $pnewdata['product_id'])->first();
                if ($variantData !== null) {
                    $count = count($variantData);
                    // Your code here using $count
                } else {
                    $count = 0;
                }
                $pnewdata['parent'] = $count > 0 ? $variantData['parent'] : '';
    
                $CouponData = $CouponModel->where('coupon_id', $pnewdata['coupon_id'])->findAll();
                if(count($CouponData) > 0)
                {
                    foreach ($CouponData as $couponcode) {
                        if(isset($couponcode)){
                            $pnewdata['coupon_code'] = $couponcode['coupon_code'];
                        }
                    }
                }else{
                    $pnewdata['coupon_code'] = "-";
                }
                $newData2[] = $pnewdata;
            }
            if (!$newData2) {
                $newData2 = null;
            }
    
            return view('admin/product/product_list', ['productData' => $newData2]);
        }else{
            return redirect()->to('/admin');
        }
    }

    public function product()
    {
        $productmodel = new ProductModel();
        $categorymodel = new CategoryModel();
        $subcategorymodel = new SubCategoryModel();
        $CouponModel = new CouponModel();

        $childsubcategorymodel = new ChildSubCategoryModel();
        $childsubcategoryData = $childsubcategorymodel->find();
        if (!$childsubcategoryData) {
            $childsubcategoryData = null;
        }

        $CouponData = $CouponModel->find();
        if (!$CouponData) {
            $CouponData = null;
        }
        $categoryData = $categorymodel->find();
        if (!$categoryData) {
            $categoryData = null;
        }
        $subcategoryData = $subcategorymodel->find();

        return view('admin/product/product', ['categoryData' => $categoryData, 'subcategoryData' => $subcategoryData , 'childsubcategoryData' => $childsubcategoryData , 'CouponData' => $CouponData]);
    }
    public function getSubcategories($category_id)
    {
        $subcategorymodel = new SubCategoryModel();
        $subcategories = $subcategorymodel->where('category_id', $category_id)->findAll();

        // Return subcategories as JSON
        return $this->response->setJSON($subcategories);
    }
    public function productSave()
    {
        // echo "<pre>";
        // print_r($_POST);
        // die;
        $productmodel = new ProductModel();
        $session = session();
        $input = $this->request->getVar();
        $product_id = $input['product_id'];

        $productArr = [];

        $productArr['product_id'] = isset($input['product_id']) ? $input['product_id'] : '';
        $productArr['coupon_id'] = isset($input['coupon_id']) ? $input['coupon_id'] : '';
        $productArr['category_id'] = isset($input['category_id']) ? $input['category_id'] : '';
        $productArr['sub_category_id'] = isset($input['sub_category_id']) ? $input['sub_category_id'] : '';
        $productArr['child_id'] = isset($input['lastchild_id']) && $input['lastchild_id'] !== '' ? $input['lastchild_id'] : -1;
        $productArr['featured_category'] = isset($input['featured_category']) ? $input['featured_category'] : '';
        $productArr['product_name'] = isset($input['product_name']) ? $input['product_name'] : '';
        $productArr['product_description'] = isset($input['product_description']) ? $input['product_description'] : '';
        $productArr['product_short_description'] = isset($input['product_short_description']) ? $input['product_short_description'] : '';
        $productArr['product_additional_info'] = isset($input['product_additional_info']) ? $input['product_additional_info'] : '';

        $productArr['product_header1'] = isset($input['product_header1']) ? $input['product_header1'] : '';
        $productArr['product_header2'] = isset($input['product_header2']) ? $input['product_header2'] : '';
        $productArr['product_header3'] = isset($input['product_header3']) ? $input['product_header3'] : '';
        $productArr['product_header4'] = isset($input['product_header4']) ? $input['product_header4'] : '';
        // print_r($input['lastchild_id']);
        // die;
        // Check if new images are uploaded
        if ($files = $this->request->getFiles()) {
            $path = 'public/admin/images/product/';
            $uploadedFiles = [];
            $uploadedFilescsv = [];
            if(isset($files['product_img']))
            {
                // Loop through each uploaded file
                foreach ($files['product_img'] as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $newName = $file->getRandomName();
                        $file->move($path, $newName);
                        $uploadedFiles[] = $path . $newName;
                    }
                }

                // Merge the existing images with the new uploaded images
                if (!empty($uploadedFiles)) {
                    // Retrieve existing images if available
                    $existingImages = isset($input['product_img']) ? explode(',', $input['product_img']) : [];
                    $productArr['product_img'] = implode(',', array_merge($existingImages, $uploadedFiles));
                }
            }

            foreach ($files['product_img_csv'] as $filecsv) {
                if ($filecsv->isValid() && !$filecsv->hasMoved()) {
                    $newNamecsv = $filecsv->getRandomName();
                    $filecsv->move($path, $newNamecsv);
                    $uploadedFilescsv[] = $path . $newNamecsv;
                }
            }

            if (!empty($uploadedFilescsv)) {
                // Retrieve existing images if available
                $existingImagescsv = isset($input['product_img_csv']) ? explode(',', $input['product_img_csv']) : [];
                $productArr['product_img_csv'] = implode(',', array_merge($existingImagescsv, $uploadedFilescsv));
            }

        }

        $productId = '';

        if (isset($input['product_id']) && $input['product_id'] != '') {
           // Given input strings
           $productData = $productmodel->find($input['product_id']);

           if(!empty($productData['product_img']) && !empty($productArr['product_img'])){
            // Split the strings by commas (,) into arrays
            $array1 = explode(',', $productData['product_img']);
            $array2 = explode(',', $productArr['product_img']);

            // Merge the arrays into a single array
            $mergedArray = array_merge($array1, $array2);

            // Convert the merged array into a string separated by commas (,)
            $mergedString = implode(',', $mergedArray);

            // Output the merged string
            $productArr['product_img'] = $mergedString;
           }

           if(!empty($productData['product_img_csv']) && !empty($productArr['product_img_csv'])){
            // Split the strings by commas (,) into arrays
            $array3 = explode(',', $productData['product_img_csv']);
            $array4 = explode(',', $productArr['product_img_csv']);

            // Merge the arrays into a single array
            $mergedArray1 = array_merge($array3, $array4);

            // Convert the merged array into a string separated by commas (,)
            $mergedString1 = implode(',', $mergedArray1);

            // Output the merged string
            $productArr['product_img_csv'] = $mergedString1;
           }

            $productmodel->update($input['product_id'], $productArr);
            $productId = $input['product_id'];
            $session->setFlashdata('success', 'product Update succesfully.');
        } else {
            $productId = $productmodel->insert($productArr);
            $session->setFlashdata('success', 'product Add succesfully.');
        }

        $this->variantProductSave($productId);

        return redirect()->to('admin/product_list');
    }
    public function productEdit($product_id)
    {
        $session = session();
        $user_id = $session->get('user_id');
        if($user_id){

            $productmodel = new ProductModel();
            $productData = $productmodel->find($product_id);
            $CouponModel = new CouponModel();
    
            $CouponData = $CouponModel->find();
            if (!$CouponData) {
                $CouponData = null;
            }
    
            if (!$productData) {
                $productData = null;
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
            $variantData = $variantsmodel->where('product_id', $product_id)->findAll();
            if (!$variantData) {
                $variantData = null;
            }
    
            $childsubcategorymodel = new ChildSubCategoryModel();
            $childsubcategoryData = $childsubcategorymodel->find();
            if (!$childsubcategoryData) {
                $childsubcategoryData = null;
            }
    
            return view('admin/product/product', [
                'productData' => $productData,
                'categoryData' => $categoryData,
                'subcategoryData' => $subcategoryData,
                'childsubcategoryData' => $childsubcategoryData,
                'variantData' => $variantData,
                'CouponData' => $CouponData
            ]);
        }else{
            return redirect()->to('/admin');
        }
    }
    public function productDelete($product_id)
    {
        $session = session();
        $productmodel = new ProductModel();
        $productmodel->delete($product_id);
        $session->setFlashdata('success', 'product Delete succesfully.');
        return redirect()->to('admin/product_list');
    }

    public function variantProductSave($productId)
    {
        $variantsmodel = new VariantsModel();
        $input = $this->request->getVar();
        $productVariantArr = [
            'product_id' => $productId
        ];


        foreach ($input['variant_name'] as $key => $VariantArr) {
            $productVariantArr = [
                'product_id' => $productId,
                'variant_name' => $input['variant_name'][$key],
                'variant_price' => $input['variant_price'][$key],
                // 'variant_header' => $input['variant_header'][$key],
                'variant_description' => $input['variant_description'][$key],

                // 'variant_header_1' => $input['variant_header1'][$key],
                'variant_description_1' => $input['variant_description1'][$key],
                // 'variant_header_2' => $input['variant_header2'][$key],
                'variant_description_2' => $input['variant_description2'][$key],
                // 'variant_header_3' => $input['variant_header3'][$key],
                'variant_description_3' => $input['variant_description3'][$key],

                'variant_sku' => $input['variant_sku'][$key],
                'variant_stock' => $input['variant_stock'][$key],
                'group_name' => $input['group_name'][$key],
                'sort' => $input['sort'][$key],

                'parent' => $input['parent'][$key],

            ];

            if (isset($input['variant_id'][$key]) && !empty($input['variant_id'][$key])) {
                // Update existing variant
                $variantId = $input['variant_id'][$key];
                $variantsmodel->update($variantId, $productVariantArr);
            } else {
                // Insert new variant
                $variantsmodel->insert($productVariantArr);
            }
        }

        return redirect()->to('admin/product_list');
    }
    public function variantDelete($variantId)
    {
        $session = session();
        $variantsmodel = new VariantsModel();

        $variantsmodel->delete($variantId);
        $session->setFlashdata('success', 'Variant Delete succesfully.');
        return redirect()->back();
    }

    // public function exportToCSV()
    // {
    //     $header = ['product_name','variant_name','variant_price','variant_sku',	'Variant values Stock',	'parent', 'Favourite', 'Product Description', 'Short Description',	'Information', 'Variant Header 1', 'Variant Header 2', 'Variant Header 3', 'Variant Header 4', 'discount code', 'GroupName', 'Sort', 'Image', 'category_name', 'sub_category_name', 'child_level_1', 'child_level_2', 'child_level_3', 'child_level_4', 'child_level_5'];

    //     // Create a new CSV file in memory
    //     $file = fopen('php://temp', 'w');

    //     // Write the header row
    //     fputcsv($file, $header);

    //     // Move the file pointer to the beginning of the file
    //     rewind($file);

    //     // Set the appropriate headers for file download
    //     header('Content-Type: application/csv');
    //     header('Content-Disposition: attachment; filename="export.csv"');
    //     header('Pragma: no-cache');

    //     // Output the contents of the file
    //     fpassthru($file);

    //     // Close the file handle
    //     fclose($file);
    //     exit;
    // }

    // Recursive function to process child_arr and product_arr for each child subcategory
    function processChildArr($childArr) {
        $productmodel = new ProductModel();
        $ChildSubCategoryModel = new ChildSubCategoryModel();
        foreach ($childArr as &$child) {
            // Fetch products for the current child subcategory
            $childSubCategoryProducts = $productmodel->where('child_id', $child['child_id'])->where('deleted_at', 0)->orderBy("CAST(sort AS SIGNED)", 'asc')->findAll();
            $childProductArr = $this->fetchProductDetails($childSubCategoryProducts);

            $subChild = $ChildSubCategoryModel->where('sub_chid_id', $child['child_id'])->findAll();
            $product = $productmodel->where('child_id', $child['child_id'])->orderBy("CAST(sort AS SIGNED)", 'asc')->findAll();
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
            $firstVariant = $variantsmodel->where('product_id', $variant['product_id'])->orderBy("CAST(sort AS SIGNED)", 'asc')->first();
            $variantData = $variantsmodel->where('product_id', $variant['product_id'])->orderBy("CAST(sort AS SIGNED)", 'asc')->findAll();
            $variant['parent'] = $firstVariant ? $firstVariant['parent'] : '';
            $variant['variant_arr'] = $variantData;
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
                $subCategoryProducts = $productmodel->where('sub_category_id', $subCategory['sub_category_id'])->where('deleted_at', 0)->where('child_id', -1)->orderBy("CAST(sort AS SIGNED)", 'asc')->findAll();
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

    // xlsx export code
    /*public function exportToCSV()
    {
        // Assuming you have a model named YourCategoryModel
        $categoryModel = new CategoryModel();
        $subCategoryModel = new SubCategoryModel();

        // Fetch data from the database
        $allData = $this->processCategories();

        // echo "<pre>";
        // print_r($allData);
        // die;

        // Create a new Spreadsheet
        $fileName = 'category.xlsx';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'product_name');
        $sheet->setCellValue('B1', 'variant_name');
        $sheet->setCellValue('C1', 'variant_price');
        $sheet->setCellValue('D1', 'variant_sku');
        $sheet->setCellValue('E1', 'Variant values Stock');
        $sheet->setCellValue('F1', 'parent');
        $sheet->setCellValue('G1', 'Favourite');
        $sheet->setCellValue('H1', 'Product Description');
        $sheet->setCellValue('I1', 'Short Description');
        $sheet->setCellValue('J1', 'Information');
        $sheet->setCellValue('K1', 'Variant Header 1');
        $sheet->setCellValue('L1', 'Variant Header 2');
        $sheet->setCellValue('M1', 'Variant Header 3');
        $sheet->setCellValue('N1', 'Variant Header 4');
        $sheet->setCellValue('O1', 'discount code');
        $sheet->setCellValue('P1', 'GroupName');
        $sheet->setCellValue('Q1', 'Sort');
        $sheet->setCellValue('R1', 'Image');
        $sheet->setCellValue('S1', 'category_name');
        $sheet->setCellValue('T1', 'sub_category_name');
        $sheet->setCellValue('U1', 'child_level_1');
        $sheet->setCellValue('V1', 'child_level_2');
        $sheet->setCellValue('W1', 'child_level_3');
        $sheet->setCellValue('X1', 'child_level_4');
        $sheet->setCellValue('Y1', 'child_level_5');

        // echo "<pre>";
        // print_r($allData);
        // die;

        $columns = array();
        for ($i = ord('V'); $i <= ord('Z'); $i++) {
            $columns[] = chr($i);
        }

        // Adding the range 'AA' to 'AZ'
        for ($i = ord('A'); $i <= ord('Z'); $i++) {
            for ($j = ord('A'); $j <= ord('Z'); $j++) {
                $columns[] = chr($i) . chr($j);
            }
        }

        $rows = 2;
        $column = 'U';
        foreach ($allData as $val){
            $sheet->setCellValue('A' . $rows, '');
            $sheet->setCellValue('B' . $rows, '');
            $sheet->setCellValue('C' . $rows, '');
            $sheet->setCellValue('D' . $rows, '');
            $sheet->setCellValue('E' . $rows, '');
            $sheet->setCellValue('F' . $rows, '');
            $sheet->setCellValue('G' . $rows, '');
            $sheet->setCellValue('H' . $rows, '');
            $sheet->setCellValue('I' . $rows, '');
            $sheet->setCellValue('J' . $rows, '');
            $sheet->setCellValue('K' . $rows, '');
            $sheet->setCellValue('L' . $rows, '');
            $sheet->setCellValue('M' . $rows, '');
            $sheet->setCellValue('N' . $rows, '');
            $sheet->setCellValue('O' . $rows, '');
            $sheet->setCellValue('P' . $rows, '');
            $sheet->setCellValue('Q' . $rows, '');
            $sheet->setCellValue('R' . $rows, '');
            $sheet->setCellValue('S' . $rows, $val['category_name']);

            $categoryName = $val['category_name'];

            foreach ($val['sub_category'] as $subCat)
            {
                $subCategoryName = $subCat['sub_category_name'];
                $sheet->setCellValue('T' . $rows, $subCat['sub_category_name']);

                foreach ($subCat['child_arr'] as $key => $child)
                {
                    $sheet->setCellValue('U' . $rows, $child['child_sub_category_name']);

                    foreach ($child['child_arr'] as $key => $value) {

                        $sheet->setCellValue('V' . $rows, $value['child_sub_category_name']);

                        foreach ($value['child_arr'] as $key => $values)
                        {
                            $sheet->setCellValue('W' . $rows, $values['child_sub_category_name']);
                            foreach ($values['product_arr'] as $product) {
                                $sheet->setCellValue('A' . $rows, $product['product_name']);
                                $sheet->setCellValue('G' . $rows, $product['product_favourite']);
                                $sheet->setCellValue('H' . $rows, $product['product_description']);
                                $sheet->setCellValue('I' . $rows, $product['product_short_description']);
                                $sheet->setCellValue('J' . $rows, $product['product_additional_info']);
                                $sheet->setCellValue('K' . $rows, $product['product_header1']);
                                $sheet->setCellValue('L' . $rows, $product['product_header2']);
                                $sheet->setCellValue('M' . $rows, $product['product_header3']);
                                $sheet->setCellValue('N' . $rows, $product['product_header4']);
                                $sheet->setCellValue('Q' . $rows, $product['sort']);
                                $sheet->setCellValue('R' . $rows, base_url() . $product['product_img_csv']);

                                foreach ($product['variant_arr'] as $variant) {
                                    $rows++;
                                    $sheet->setCellValue('B' . $rows, $variant['variant_name']);
                                    $sheet->setCellValue('C' . $rows, $variant['variant_price']);
                                    $sheet->setCellValue('D' . $rows, $variant['variant_sku']);
                                    $sheet->setCellValue('E' . $rows, $variant['variant_stock']);
                                    $sheet->setCellValue('F' . $rows, $variant['parent']);
                                    $sheet->setCellValue('K' . $rows, $variant['variant_description']);
                                    $sheet->setCellValue('L' . $rows, $variant['variant_description_1']);
                                    $sheet->setCellValue('M' . $rows, $variant['variant_description_2']);
                                    $sheet->setCellValue('N' . $rows, $variant['variant_description_3']);
                                    $sheet->setCellValue('P' . $rows, $variant['group_name']);
                                    $sheet->setCellValue('Q' . $rows, $variant['sort']);
                                }
                                $rows++;
                            }
                        }

                        foreach ($value['product_arr'] as $product) {
                            $sheet->setCellValue('A' . $rows, $product['product_name']);
                            $sheet->setCellValue('G' . $rows, $product['product_favourite']);
                            $sheet->setCellValue('H' . $rows, $product['product_description']);
                            $sheet->setCellValue('I' . $rows, $product['product_short_description']);
                            $sheet->setCellValue('J' . $rows, $product['product_additional_info']);
                            $sheet->setCellValue('K' . $rows, $product['product_header1']);
                            $sheet->setCellValue('L' . $rows, $product['product_header2']);
                            $sheet->setCellValue('M' . $rows, $product['product_header3']);
                            $sheet->setCellValue('N' . $rows, $product['product_header4']);
                            $sheet->setCellValue('Q' . $rows, $product['sort']);
                            $sheet->setCellValue('R' . $rows, base_url() . $product['product_img_csv']);

                            foreach ($product['variant_arr'] as $variant) {
                                $rows++;
                                $sheet->setCellValue('B' . $rows, $variant['variant_name']);
                                $sheet->setCellValue('C' . $rows, $variant['variant_price']);
                                $sheet->setCellValue('D' . $rows, $variant['variant_sku']);
                                $sheet->setCellValue('E' . $rows, $variant['variant_stock']);
                                $sheet->setCellValue('F' . $rows, $variant['parent']);
                                $sheet->setCellValue('K' . $rows, $variant['variant_description']);
                                $sheet->setCellValue('L' . $rows, $variant['variant_description_1']);
                                $sheet->setCellValue('M' . $rows, $variant['variant_description_2']);
                                $sheet->setCellValue('N' . $rows, $variant['variant_description_3']);
                                $sheet->setCellValue('P' . $rows, $variant['group_name']);
                                $sheet->setCellValue('Q' . $rows, $variant['sort']);
                            }
                            $rows++;
                        }
                    }

                    foreach ($child['product_arr'] as $product) {
                        $sheet->setCellValue('A' . $rows, $product['product_name']);
                        $sheet->setCellValue('G' . $rows, $product['product_favourite']);
                        $sheet->setCellValue('H' . $rows, $product['product_description']);
                        $sheet->setCellValue('I' . $rows, $product['product_short_description']);
                        $sheet->setCellValue('J' . $rows, $product['product_additional_info']);
                        $sheet->setCellValue('K' . $rows, $product['product_header1']);
                        $sheet->setCellValue('L' . $rows, $product['product_header2']);
                        $sheet->setCellValue('M' . $rows, $product['product_header3']);
                        $sheet->setCellValue('N' . $rows, $product['product_header4']);
                        $sheet->setCellValue('Q' . $rows, $product['sort']);
                        $sheet->setCellValue('R' . $rows, base_url() . $product['product_img_csv']);

                        foreach ($product['variant_arr'] as $variant) {
                            $rows++;
                            $sheet->setCellValue('B' . $rows, $variant['variant_name']);
                            $sheet->setCellValue('C' . $rows, $variant['variant_price']);
                            $sheet->setCellValue('D' . $rows, $variant['variant_sku']);
                            $sheet->setCellValue('E' . $rows, $variant['variant_stock']);
                            $sheet->setCellValue('F' . $rows, $variant['parent']);
                            $sheet->setCellValue('K' . $rows, $variant['variant_description']);
                            $sheet->setCellValue('L' . $rows, $variant['variant_description_1']);
                            $sheet->setCellValue('M' . $rows, $variant['variant_description_2']);
                            $sheet->setCellValue('N' . $rows, $variant['variant_description_3']);
                            $sheet->setCellValue('P' . $rows, $variant['group_name']);
                            $sheet->setCellValue('Q' . $rows, $variant['sort']);
                        }
                        $rows++;
                    }
                }

                // if (isset($subCat['child_arr']) && count($subCat['child_arr']) > 0) {
                //     $this->handleChildArrays($subCat['child_arr'], $rows, $sheet, $column, $categoryName, $subCategoryName);
                // }
            }
            $rows++;
        }
        // die;
        // Set headers for download
        $filename = 'exported_data.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Save the Excel file to php://output
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }*/

    // csv export code
    public function exportToCSV()
    {
        // Fetch data from the database
        $allData = $this->processCategories();

        // Set CSV file name
        $filename = 'exported_data.csv';

        // Open file handle for writing
        $file = fopen('php://output', 'w');

        // Write CSV headers
        fputcsv($file, [
            'product_name',
            'variant_name',
            'variant_price',
            'variant_sku',
            'variant_stock',
            'parent',
            'Favourite',
            'Product Description',
            'Short Description',
            'Information',
            'Variant Header 1',
            'Variant Header 2',
            'Variant Header 3',
            'Variant Header 4',
            'discount code',
            'GroupName',
            'Sort',
            'Image',
            'category_name',
            'sub_category_name',
            'child_level_1',
            'child_level_2',
            'child_level_3',
            'child_level_4',
            'child_level_5'
        ]);

        // Write data to CSV
        foreach ($allData as $val) {
            $categoryName = $val['category_name'];
            foreach ($val['sub_category'] as $subCat) {
                $subCategoryName = $subCat['sub_category_name'];
                foreach ($subCat['child_arr'] as $child) {
                    foreach ($child['child_arr'] as $value) {
                        foreach ($value['child_arr'] as $values) {
                            foreach ($values['product_arr'] as $product) {
                                // echo '<pre>';print_r($product);echo '</pre>';
                                fputcsv($file, [
                                    $product['product_name'],
                                    '', // variant_name
                                    '', // variant_price
                                    '', // variant_sku
                                    '', // variant_stock
                                    '', // parent
                                    $product['product_favourite'],
                                    $product['product_description'],
                                    $product['product_short_description'],
                                    $product['product_additional_info'],
                                    $product['product_header1'],
                                    $product['product_header2'],
                                    $product['product_header3'],
                                    $product['product_header4'],
                                    '', // discount code
                                    '', // groupname
                                    $product['sort'],
                                    base_url() . $product['product_img_csv'],
                                    $categoryName,
                                    $subCategoryName,
                                    $child['child_sub_category_name'],
                                    $value['child_sub_category_name'],
                                    $values['child_sub_category_name'],
                                    '', // child_level_4
                                    '' // child_level_5
                                ]);
                                foreach ($product['variant_arr'] as $variant) {
                                    fputcsv($file, [
                                        '', // product_name
                                        $variant['variant_name'],
                                        $variant['variant_price'],
                                        $variant['variant_sku'],
                                        $variant['variant_stock'],
                                        $variant['parent'],
                                        '', // product_favourite
                                        '', // product_description
                                        '', // product_short_description
                                        '', // product_additional_info
                                        "'".$variant['variant_description'],
                                        "'".$variant['variant_description_1'],
                                        "'".$variant['variant_description_2'],
                                        "'".$variant['variant_description_3'],
                                        '', // product_header1
                                        // '', // product_header2
                                        // '', // product_header3
                                        // '', // product_header4
                                        // '', // discount code
                                        $variant['group_name'],
                                        "'".$variant['sort'],
                                        '', // Image - Not included as it's already in the product row
                                        '', // category_name - Not included as it's already in the product row
                                        '', // sub_category_name - Not included as it's already in the product row
                                        '', // child_level_1 - Not included as it's already in the product row
                                        '', // child_level_2 - Not included as it's already in the product row
                                        '', // child_level_3 - Not included as it's already in the product row
                                        '', // child_level_4
                                        '' // child_level_5
                                    ]);
                                }
                            }
                        }

                        foreach ($value['product_arr'] as $product) {
                            // echo '<pre>';print_r($product);echo '</pre>';
                            fputcsv($file, [
                                $product['product_name'],
                                '', // variant_name
                                '', // variant_price
                                '', // variant_sku
                                '', // variant_stock
                                '', // parent
                                $product['product_favourite'],
                                $product['product_description'],
                                $product['product_short_description'],
                                $product['product_additional_info'],
                                $product['product_header1'],
                                $product['product_header2'],
                                $product['product_header3'],
                                $product['product_header4'],
                                '', // discount code
                                '', // group_name
                                "'".$product['sort'],
                                base_url() . $product['product_img_csv'],
                                $categoryName,
                                $subCategoryName,
                                $child['child_sub_category_name'],
                                $value['child_sub_category_name'],
                                // $values['child_sub_category_name'],
                                '', // child_level_4
                                '' // child_level_5
                            ]);
                            foreach ($product['variant_arr'] as $variant) {
                                fputcsv($file, [
                                    '', // product_name
                                    $variant['variant_name'],
                                    $variant['variant_price'],
                                    $variant['variant_sku'],
                                    $variant['variant_stock'],
                                    $variant['parent'],
                                    '', // product_favourite
                                    '', // product_description
                                    '', // product_short_description
                                    '', // product_additional_info
                                    "'".$variant['variant_description'],
                                    "'".$variant['variant_description_1'],
                                    "'".$variant['variant_description_2'],
                                    "'".$variant['variant_description_3'],
                                    '', // product_header1
                                    // '', // product_header2
                                    // '', // product_header3
                                    // '', // product_header4
                                    // '', // discount code
                                    $variant['group_name'],
                                    "'".$variant['sort'],
                                    '', // Image - Not included as it's already in the product row
                                    '', // category_name - Not included as it's already in the product row
                                    '', // sub_category_name - Not included as it's already in the product row
                                    '', // child_level_1 - Not included as it's already in the product row
                                    '', // child_level_2 - Not included as it's already in the product row
                                    '', // child_level_3 - Not included as it's already in the product row
                                    '', // child_level_4
                                    '' // child_level_5
                                ]);
                            }
                        }
                    }
                    foreach ($child['product_arr'] as $product) {
                        // echo '<pre>';print_r($product);echo '</pre>';
                        fputcsv($file, [
                            $product['product_name'],
                            '', // variant_name
                            '', // variant_price
                            '', // variant_sku
                            '', // variant_stock
                            '', // parent
                            $product['product_favourite'],
                            $product['product_description'],
                            $product['product_short_description'],
                            $product['product_additional_info'],
                            $product['product_header1'],
                            $product['product_header2'],
                            $product['product_header3'],
                            $product['product_header4'],
                            '', // discount code
                            '', // group_name
                            "'".$product['sort'],
                            base_url() . $product['product_img_csv'],
                            $categoryName,
                            $subCategoryName,
                            $child['child_sub_category_name'],
                            // $value['child_sub_category_name'],
                            // $values['child_sub_category_name'],
                            '', // child_level_4
                            '' // child_level_5
                        ]);
                        foreach ($product['variant_arr'] as $variant) {
                            fputcsv($file, [
                                '', // product_name
                                $variant['variant_name'],
                                $variant['variant_price'],
                                $variant['variant_sku'],
                                $variant['variant_stock'],
                                $variant['parent'],
                                '', // product_favourite
                                '', // product_description
                                '', // product_short_description
                                '', // product_additional_info
                                "'".$variant['variant_description'],
                                "'".$variant['variant_description_1'],
                                "'".$variant['variant_description_2'],
                                "'".$variant['variant_description_3'],
                                '', // product_header1
                                // '', // product_header2
                                // '', // product_header3
                                // '', // product_header4
                                // '', // discount code
                                $variant['group_name'],
                                "'".$variant['sort'],
                                '', // Image - Not included as it's already in the product row
                                '', // category_name - Not included as it's already in the product row
                                '', // sub_category_name - Not included as it's already in the product row
                                '', // child_level_1 - Not included as it's already in the product row
                                '', // child_level_2 - Not included as it's already in the product row
                                '', // child_level_3 - Not included as it's already in the product row
                                '', // child_level_4
                                '' // child_level_5
                            ]);
                        }
                    }
                }
            }
        }

        // Close the file handle
        fclose($file);

        // Set headers for download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Exit script
        exit;
    }


    function handleChildArrays($childArr, &$rows, $sheet) {
        foreach ($childArr as $child) {
            $sheet->setCellValue('U' . $rows, $child['child_sub_category_name']);

            if (isset($child['child_arr']) && is_array($child['child_arr'])) {
                $this->handleChildArrays($child['child_arr'], $rows, $sheet);
            }

            foreach ($child['product_arr'] as $product) {
                $sheet->setCellValue('A' . $rows, $product['product_name']);
                $sheet->setCellValue('G' . $rows, $product['product_favourite']);
                $sheet->setCellValue('H' . $rows, $product['product_description']);
                $sheet->setCellValue('I' . $rows, $product['product_short_description']);
                $sheet->setCellValue('J' . $rows, $product['product_additional_info']);
                $sheet->setCellValue('K' . $rows, $product['product_header1']);
                $sheet->setCellValue('L' . $rows, $product['product_header2']);
                $sheet->setCellValue('M' . $rows, $product['product_header3']);
                $sheet->setCellValue('N' . $rows, $product['product_header4']);
                $sheet->setCellValue('Q' . $rows, $product['sort']);
                $sheet->setCellValue('R' . $rows, base_url().$product['product_img_csv']);

                foreach ($product['variant_arr'] as $variant) {
                    $rows++;
                    $sheet->setCellValue('B' . $rows, $variant['variant_name']);
                    $sheet->setCellValue('C' . $rows, $variant['variant_price']);
                    $sheet->setCellValue('D' . $rows, $variant['variant_sku']);
                    $sheet->setCellValue('E' . $rows, $variant['variant_stock']);
                    $sheet->setCellValue('F' . $rows, $variant['parent']);
                    $sheet->setCellValue('K' . $rows, $variant['variant_description']);
                    $sheet->setCellValue('L' . $rows, $variant['variant_description_1']);
                    $sheet->setCellValue('M' . $rows, $variant['variant_description_2']);
                    $sheet->setCellValue('N' . $rows, $variant['variant_description_3']);
                    $sheet->setCellValue('P' . $rows, $variant['group_name']);
                    $sheet->setCellValue('Q' . $rows, $variant['sort']);
                }
                $rows++;
            }
            // $rows++;
        }
    }

    public function getChildArr($childArr, $rows, $sheet, $columns, $columnsCount)
    {
        $rows = $rows;
        foreach ($childArr as $key => $value)
        {
            $sheet->setCellValue($columns[$columnsCount] . $rows, $value['child_sub_category_name']);

            if(isset($value['product_arr']))
            {
                foreach ($value['product_arr'] as $product)
                {
                    $sheet->setCellValue('A' . $rows, $product['product_name']);

                    $sheet->setCellValue('G' . $rows, $product['product_favourite']);

                    $sheet->setCellValue('H' . $rows, $product['product_description']);
                    $sheet->setCellValue('I' . $rows, $product['product_short_description']);
                    $sheet->setCellValue('J' . $rows, $product['product_additional_info']);
                    $sheet->setCellValue('K' . $rows, $product['product_header1']);
                    $sheet->setCellValue('L' . $rows, $product['product_header2']);
                    $sheet->setCellValue('M' . $rows, $product['product_header3']);
                    $sheet->setCellValue('N' . $rows, $product['product_header4']);

                    $sheet->setCellValue('R' . $rows, base_url().$product['product_img_csv']);

                    foreach ($product['variant_arr'] as $variant)
                    {
                        $rows++;
                        $sheet->setCellValue('B' . $rows, $variant['variant_name']);
                        $sheet->setCellValue('C' . $rows, $variant['variant_price']);
                        $sheet->setCellValue('D' . $rows, $variant['variant_sku']);
                        $sheet->setCellValue('E' . $rows, $variant['variant_stock']);
                        $sheet->setCellValue('F' . $rows, $variant['parent']);

                        $sheet->setCellValue('K' . $rows, $variant['variant_description']);
                        $sheet->setCellValue('L' . $rows, $variant['variant_description_1']);
                        $sheet->setCellValue('M' . $rows, $variant['variant_description_2']);
                        $sheet->setCellValue('N' . $rows, $variant['variant_description_3']);

                        $sheet->setCellValue('P' . $rows, $variant['group_name']);
                        $sheet->setCellValue('Q' . $rows, $variant['sort']);
                    }
                    $rows++;
                }
                $rows++;
            }

            if(isset($childArr['child_arr']))
            {
                $this->getChildArr($childArr['child_arr'], $rows, $sheet, $columns, ($columnsCount+1));
            }
        }
    }

    public function processCSV()
    {
        $session = session();
        $categoryModel = new CategoryModel();
        $subcategoryModel = new SubcategoryModel();
        $childsubcategorymodel = new ChildSubCategoryModel();
        $productModel = new ProductModel();
        $variantModel = new VariantsModel();
        $CouponModel = new CouponModel();

        // Get the uploaded CSV file
        $csvFile = $this->request->getFile('csv_file');

        // Check if a file was uploaded
        if ($csvFile && $csvFile->isValid() && !$csvFile->hasMoved()) {
            // Open the CSV file
            $csv = array_map('str_getcsv', file($csvFile->getPathname()));
            $categoryName = null;
            $subcategoryName = null;
            $categoryId = null;
            $subcategoryId = null;
            $productId = null;
            $child_id =null;
            $isFirstRow = true; // Flag variable to skip the first row
            // // Process each row of the CSV file
            foreach ($csv as $row) {
                if ($isFirstRow) {
                    $isFirstRow = false;
                    continue; // Skip the first row
                }
                if (isset($row[18]) && $row[18] != '') {
                    // Category name
                    $categoryName = utf8_encode($row[18]);

                    // Check if the category already exists
                    $category = $categoryModel->where('category_name', $categoryName)->first();

                    if (!$category) {
                        // Insert the new category
                        $category = [
                            'category_name' => $categoryName
                        ];
                        $categoryId = $categoryModel->insert($category);
                    } else {
                        $category = $categoryModel->where('category_name', $categoryName)->get()->getRow();
                        $categoryId = $category->category_id;
                    }
                }



                if (isset($row[19]) && $row[19] != '') {
                    // Subcategory name
                    $subcategoryName = utf8_encode($row[19]);

                    // Check if the subcategory already exists
                    $subcategory = $subcategoryModel
                        ->where('sub_category_name', $subcategoryName)
                        ->where('category_id', $categoryId)
                        ->first();

                    if (!$subcategory) {
                        // Insert the new subcategory with the parent category ID
                        $subcategory = [
                            'sub_category_name' => $subcategoryName,
                            'category_id' => $categoryId
                        ];
                        $subcategoryId = $subcategoryModel->insert($subcategory);
                    } else {
                        $subcategory = $subcategoryModel
                        ->where('sub_category_name', $subcategoryName)
                        ->where('category_id', $categoryId)
                        ->get()->getRow();
                        $subcategoryId = $subcategory->sub_category_id;
                    }
                }


                // if (isset($row[17]) && $row[17] != '') {
                //     $imageName = basename($row[17]);

                //     // Define the destination folder for the product images
                //     $destinationFolder = 'public/admin/images/product/';

                //                         // Generate a unique filename based on the current timestamp
                //          // You can change the file extension to .png if needed

                //         $encodedFilename = str_replace('+', '%20', urlencode(basename($row[17])));
                //         $product_img_csv = dirname($row[17]) . '/' . $encodedFilename;

                //         $imageName = time(). '_' . $encodedFilename;

                //         // Download the image and save it to the destination folder
                //         $imageData = file_get_contents($product_img_csv);
                //         if ($imageData !== false) {
                //             $destinationPath = $destinationFolder . $imageName;
                //             if (file_put_contents($destinationPath, $imageData) !== false) {
                //                 echo "Image downloaded and saved successfully as $imageName.";
                //             } else {
                //                 echo "Error saving the image.";
                //             }
                //         } else {
                //             echo "Error downloading the image.";
                //         }
                //     }

                if (isset($row[17]) && $row[17] != '') {
                    $imageName = basename($row[17]);

                    // Define the destination folder for the product images
                    $destinationFolder = 'public/admin/images/product/';

                    // Generate a unique filename based on the current timestamp
                    // You can change the file extension to .png if needed
                    $encodedFilename = str_replace('+', '%20', urlencode(basename($row[17])));
                    $product_img_csv = dirname($row[17]) . '/' . $encodedFilename;

                    $imageName = time(). '_' . $encodedFilename;

                    // Download the image and save it to the destination folder
                    $imageData = file_get_contents($product_img_csv);

                    if ($imageData !== false) {
                        $destinationPath = $destinationFolder . $imageName;

                        // Save the original image
                        if (file_put_contents($destinationPath, $imageData) !== false) {
                            $config = [
                                'quality' => 80, // Adjust the quality as needed (0-100)
                            ];

                            $compressedPath = $destinationFolder . $imageName;

                            // Load the Image library
                            $imageLib = \Config\Services::image();

                            if($imageLib)
                            {
                                $img = $imageLib->withFile($compressedPath);

                                $img->save($compressedPath, 50);
                            }
                        }
                    }
                }

                if (isset($row[20]) && $row[20] != '') {
                    // Subcategory name
                    // Assuming the first column (index 0) contains the variable names var1, var2, var3, etc.
                    // Loop through each column starting from index 1 (skipping the first column with variable names)

                    for ($i=20; $i < count($row); $i++) {
                        if($i != 20)
                        {
                            $childsubcategoryName = utf8_encode($row[$i]);
                            $existingChildSubCategory = $childsubcategorymodel
                                ->where('child_sub_category_name', $childsubcategoryName)
                                ->where('category_id', $categoryId)
                                ->get()
                                ->getRow();

                            if (isset($row[$i]) && $row[$i] != '' && !$existingChildSubCategory) {
                                $childsubcategory = $childsubcategorymodel
                                    ->where('child_sub_category_name', $row[$i - 1])
                                    ->where('category_id', $categoryId)
                                    ->get()
                                    ->getRow();

                                $childsubcategory_1 = [
                                    'child_sub_category_name' => isset($childsubcategoryName) ? $childsubcategoryName : '',
                                    'sub_chid_id' => isset($childsubcategory) ? $childsubcategory->child_id : '0',
                                    'sub_category_id' =>  isset($childsubcategory) ? $childsubcategory->sub_category_id : '0',
                                    'category_id' => $categoryId
                                ];

                                $child_id = $childsubcategorymodel->insert($childsubcategory_1);
                            }
                        }
                        else
                        {
                            $childsubcategoryName = utf8_encode($row[$i]);
                                $subcategory = $subcategoryModel
                                    ->where('sub_category_name', $row[$i - 1])
                                    ->where('category_id', $categoryId)
                                    ->get()
                                    ->getRow();

                            if (isset($row[$i]) && $row[$i] != '') {
                                $existingChildSubCategory = $childsubcategorymodel
                                    ->where('child_sub_category_name', $childsubcategoryName)
                                    ->where('category_id', $categoryId)
                                    ->get()
                                    ->getRow();

                                if (!$existingChildSubCategory) {
                                    $childsubcategory_1 = [
                                        'child_sub_category_name' => $childsubcategoryName,
                                        'sub_chid_id' => 0,
                                        'sub_category_id' => isset($subcategory) ? $subcategory->sub_category_id : '0',
                                        'category_id' => $categoryId
                                    ];
                                    $child_id = $childsubcategorymodel->insert($childsubcategory_1);
                                }
                            }
                        }
                    }
                }


                    // Product details
                    $productName = utf8_encode($row[0]);
                    $Favourite   = utf8_encode($row[6]);
                    $ProductDescription = utf8_encode($row[7]);
                    $shortDescription = utf8_encode($row[8]);
                    $information = utf8_encode($row[9]);

                    if($row[10] || $row[11] || $row[12] || $row[13])
                    {

                    }else{

                    }
                    $vheader1 = utf8_encode($row[10]);
                    $vheader2 = utf8_encode($row[11]);
                    $vheader3 = utf8_encode($row[12]);
                    $vheader4 = utf8_encode($row[13]);

                    $discount_code = utf8_encode($row[14]);
                    $group_name = utf8_encode($row[15]);
                    $sort = utf8_encode($row[16]);

                    $db = \Config\Database::connect();
                    $query_test = $db->table('coupon')
                    ->select('coupon_id')
                    ->where('coupon_code', $discount_code)
                    ->get();

                    if ($query_test->getNumRows() > 0) {
                        $row_num = $query_test->getRow(); // Fetch the row
                        $CouponId = $row_num->coupon_id; // Get the coupon_id
                        //echo "Coupon ID: " . $CouponId;
                    } else{
                        $CouponId = "0";
                    }



                    if ($productName != '') {
                        // Insert the product
                        $product = [
                            'product_name' => $productName,
                            'category_id' => $categoryId,
                            'child_id' => $child_id,
                            'sub_category_id' => $subcategoryId,
                            'product_description' => $ProductDescription,
                            'product_short_description' => $shortDescription,
                            'product_img_csv' => isset($compressedPath) ? $compressedPath : '',
                            'product_img' => isset($compressedPath) ? $compressedPath : '',
                            'product_header1' => trim($vheader1, "'") ? trim($vheader1, "'") : '',
                            'product_header2' => trim($vheader2, "'") ? trim($vheader2, "'") : '',
                            'product_header3' => trim($vheader3, "'") ? trim($vheader3, "'") : '',
                            'product_header4' => trim($vheader4, "'") ? trim($vheader4, "'") : '',
                            'product_additional_info' => $information,
                            'product_favourite' => $Favourite,
                            'coupon_id' => $CouponId,

                        ];
                        $productId = $productModel->insert($product);
                    }

                // Variant details
                $variantName = utf8_encode($row[1]);
                $variantPrice = utf8_encode($row[2]);
                $variantSku = utf8_encode($row[3]);
                $parent = utf8_encode($row[5]);
                $stock = utf8_encode($row[4]);


                if ($variantName != '') {
                    // Insert the variant
                    $variant = [
                        'product_id' => $productId,
                        'variant_name' => $variantName,
                        'variant_price' => $variantPrice,
                        'variant_sku' => $variantSku,
                        'parent' => $parent,
                        'variant_stock' => $stock,
                        'group_name' => $group_name,
                        'sort' => trim($sort, "'"),
                        'variant_description' => trim($vheader1, "'") ? trim($vheader1, "'") : '',
                        'variant_description_1' => trim($vheader2, "'") ? trim($vheader2, "'") : '',
                        'variant_description_2' => trim($vheader3, "'") ? trim($vheader3, "'") : '',
                        'variant_description_3' => trim($vheader4, "'") ? trim($vheader4, "'") : '',
                    ];
                    $variantModel->insert($variant);
                }


            }

            // Success message or redirect to a success page
            $session->setFlashdata('success', 'Uploaded the CSV file successfully.');
            return redirect()->back();
        } else {
            // Error message or redirect to an error page
            $session->setFlashdata('error', 'Failed to upload the CSV file.');
            return redirect()->back();
        }
    }

    public function product_path_delete()
    {
        $input = $this->request->getVar();
        // print_r($input['image_id']);
        // print_r($input['image_path']);

        $productModel = new ProductModel();
        $productData = $productModel->find($input['image_id']);

        // print_r($productData['product_img']);

        // Convert the comma-separated list into an array
            $targetArray = explode(",", $productData['product_img']);

            // Find the position of the given string in the array
            $position = array_search($input['image_path'], $targetArray);

            if ($position !== false) {
                // Remove the element at the found position
                array_splice($targetArray, $position, 1);

                // Create the new string by joining the array elements with commas
                $newString = implode(",", $targetArray);

                // echo "The given string was found and removed from the target string.";
                // echo "New string: " . $newString;
                $productArr = [ 'product_img' => $newString ];
                $productModel->update($input['image_id'], $productArr);
            } else {
               // echo "The given string was not found in the target string.";
            }

    }

    public function product_csv_delete()
    {
        $input = $this->request->getVar();
        // print_r($input['image_id']);
        // print_r($input['image_path']);

        $productModel = new ProductModel();
        $productData = $productModel->find($input['image_id']);

        // print_r($productData['product_img']);

        // Convert the comma-separated list into an array
            $targetArray = explode(",", $productData['product_img_csv']);

            // Find the position of the given string in the array
            $position = array_search($input['image_path'], $targetArray);

            if ($position !== false) {
                // Remove the element at the found position
                array_splice($targetArray, $position, 1);

                // Create the new string by joining the array elements with commas
                $newString = implode(",", $targetArray);

                // echo "The given string was found and removed from the target string.";
                // echo "New string: " . $newString;
                $productArr = [ 'product_img_csv' => $newString ];
                $productModel->update($input['image_id'], $productArr);
            } else {
               // echo "The given string was not found in the target string.";
            }

    }
}
