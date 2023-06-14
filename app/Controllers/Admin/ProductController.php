<?php

namespace App\Controllers\Admin;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use App\Models\VariantsModel;
use CodeIgniter\HTTP\RequestInterface;

class ProductController extends BaseController
{
    public function index()
    {
        $productmodel = new ProductModel();

        $productData = $productmodel->select('product.*, category.category_name, sub_category.sub_category_name')
            ->join('category', 'category.category_id = product.category_id')
            ->join('sub_category', 'sub_category.sub_category_id = product.sub_category_id')
            ->find();

        if (!$productData) {
            $productData = null;
        }

        return view('admin/product/product_list', ['productData' => $productData]);
    }
    public function product()
    {
        $productmodel = new ProductModel();
        $categorymodel = new CategoryModel();
        $subcategorymodel = new SubCategoryModel();

        $categoryData = $categorymodel->find();


        if (!$categoryData) {
            $categoryData = null;
        }

        $subcategoryData = $subcategorymodel->find();

        return view('admin/product/product', ['categoryData' => $categoryData, 'subcategoryData' => $subcategoryData]);
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
        $productArr['product_name'] = isset($input['product_name']) ? $input['product_name'] : '';
        // $productArr['product_price'] = isset($input['product_price']) ? $input['product_price'] : '';
        $productArr['product_description'] = isset($input['product_description']) ? $input['product_description'] : '';

        if ($file = $this->request->getFile('product_img')) {
            $path = 'public/admin/images/product/';
            if ($file->getClientName()) {
                $filename = time() . '_productImg_' . $file->getClientName();
                $file->move($path, $filename);
                $productArr['product_img'] = 'public/admin/images/product/' . $filename;
            }
        }

         $productId = '';
        if (isset($input['product_id']) && $input['product_id'] != '') {
            $productmodel->update(['product_id', $input['product_id']], $productArr);
            $productId  = $input['product_id'];
        } else {
            $productId = $productmodel->insert($productArr);
        }

        $this->variantProductSave($productId);

        $session->setFlashdata('success', 'product change succesfully.');
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

       
        return view('admin/product/product', [
            'productData' => $productData,  
            'categoryData' => $categoryData, 
            'subcategoryData' => $subcategoryData,
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

        // echo "hi";
        // die();
        $session = session();
        $variantsmodel = new VariantsModel();
        
        $variantsmodel->delete($variantId);
        $session->setFlashdata('success', 'Variant Delete succesfully.');
        return redirect()->back();
    }
   


}
