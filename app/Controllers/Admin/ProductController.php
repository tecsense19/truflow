<?php

namespace App\Controllers\Admin;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use App\Models\VariantsModel;
use App\Models\ChildSubCategoryModel;
use CodeIgniter\HTTP\RequestInterface;

class ProductController extends BaseController
{
    public function index()
    {
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

        return view('admin/product/product_list', ['productData' => $newData2]);
    }
    public function product()
    {
        $productmodel = new ProductModel();
        $categorymodel = new CategoryModel();
        $subcategorymodel = new SubCategoryModel();

        $childsubcategorymodel = new ChildSubCategoryModel();
        $childsubcategoryData = $childsubcategorymodel->find();
        if (!$childsubcategoryData) {
            $childsubcategoryData = null;
        }

        $categoryData = $categorymodel->find();


        if (!$categoryData) {
            $categoryData = null;
        }

        $subcategoryData = $subcategorymodel->find();

        return view('admin/product/product', ['categoryData' => $categoryData, 'subcategoryData' => $subcategoryData , 'childsubcategoryData' => $childsubcategoryData ]);
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
        

        $productmodel = new ProductModel();
        $session = session();
        $input = $this->request->getVar();
        $product_id = $input['product_id'];
       
        $productArr = [];

        $productArr['product_id'] = isset($input['product_id']) ? $input['product_id'] : '';
        $productArr['category_id'] = isset($input['category_id']) ? $input['category_id'] : '';
        $productArr['sub_category_id'] = isset($input['sub_category_id']) ? $input['sub_category_id'] : '';
        $productArr['child_id'] = isset($input['child_id']) ? $input['child_id'] : '';
        $productArr['product_name'] = isset($input['product_name']) ? $input['product_name'] : '';
        $productArr['product_description'] = isset($input['product_description']) ? $input['product_description'] : '';
        $productArr['product_additional_info'] = isset($input['product_additional_info']) ? $input['product_additional_info'] : '';
    
        // Check if new images are uploaded
        if ($files = $this->request->getFiles()) {
            $path = 'public/admin/images/product/';
            $uploadedFiles = [];

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

        $productId = '';
       
        if (isset($input['product_id']) && $input['product_id'] != '') {
           
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

        $productmodel = new ProductModel();
        $productData = $productmodel->find($product_id);


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
            'variantData' => $variantData
        ]);
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
                'variant_sku' => $input['variant_sku'][$key],
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

    public function exportToCSV()
    {
        $header = ['category_name', 'sub_category_name', 'product_name', 'variant_name', 'variant_price', 'variant_sku', 'parent'];

        // Create a new CSV file in memory
        $file = fopen('php://temp', 'w');

        // Write the header row
        fputcsv($file, $header);

        // Move the file pointer to the beginning of the file
        rewind($file);

        // Set the appropriate headers for file download
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="export.csv"');
        header('Pragma: no-cache');

        // Output the contents of the file
        fpassthru($file);

        // Close the file handle
        fclose($file);
        exit;
    }

    public function processCSV()
    {
        $session = session();
        $categoryModel = new CategoryModel();
        $subcategoryModel = new SubcategoryModel();
        $productModel = new ProductModel();
        $variantModel = new VariantsModel();

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

            $isFirstRow = true; // Flag variable to skip the first row

            // Process each row of the CSV file
            foreach ($csv as $row) {
                if ($isFirstRow) {
                    $isFirstRow = false;
                    continue; // Skip the first row
                }

                if ($row[0] != '') {
                    // Category name
                    $categoryName = utf8_encode($row[0]);

                    // Check if the category already exists
                    $category = $categoryModel->where('category_name', $categoryName)->get()->getRow();

                    if (!$category) {
                        // Insert the new category
                        $category = [
                            'category_name' => $categoryName
                        ];
                        $categoryId = $categoryModel->insert($category);
                    } else {
                        $categoryId = $category->category_id;
                    }
                }

                if ($row[1] != '') {
                    // Subcategory name
                    $subcategoryName = utf8_encode($row[1]);

                    // Check if the subcategory already exists
                    $subcategory = $subcategoryModel
                        ->where('sub_category_name', $subcategoryName)
                        ->where('category_id', $categoryId)
                        ->get()->getRow();

                    if (!$subcategory) {
                        // Insert the new subcategory with the parent category ID
                        $subcategory = [
                            'sub_category_name' => $subcategoryName,
                            'category_id' => $categoryId
                        ];
                        $subcategoryId = $subcategoryModel->insert($subcategory);
                    } else {
                        $subcategoryId = $subcategory->sub_category_id;
                    }
                }

                // Product details
                $productName = utf8_encode($row[2]);

                if ($productName != '') {
                    // Insert the product
                    $product = [
                        'product_name' => $productName,
                        'category_id' => $categoryId,
                        'sub_category_id' => $subcategoryId
                    ];
                    $productId = $productModel->insert($product);
                }

                // Variant details
                $variantName = utf8_encode($row[3]);
                $variantPrice = utf8_encode($row[4]);
                $variantSku = utf8_encode($row[5]);
                $parent = utf8_encode($row[6]);

                if ($variantName != '') {
                    // Insert the variant
                    $variant = [
                        'product_id' => $productId,
                        'variant_name' => $variantName,
                        'variant_price' => $variantPrice,
                        'variant_sku' => $variantSku,
                        'parent' => $parent
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
}
