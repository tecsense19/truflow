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


class Home extends BaseController
{
    public function index()
    {
        //home section
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
                'headerData' => $headerData
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
        $categoryData = $categorymodel->find();
        if (!$categoryData) {
            $categoryData = null;
        }
        return view('front/shop', ['headerData' => $headerData, 'categoryData' => $categoryData]);
    }
    public function sub_category($category_id)
    {
        $headermenumodel = new HeaderMenuModel();
        $headerData = $headermenumodel->find();
        if (!$headerData) {
            $headerData = null;
        }

        $categorymodel = new CategoryModel();
        $categoryData = $categorymodel->find($category_id);
        if (!$categoryData) {
            // If category with the given ID is not found, return an error view or redirect
            // For example: return view('errors/404');
            return redirect()->back();
        }

        $subcategorymodel = new SubCategoryModel();
        $subcategoryData = $subcategorymodel->where('category_id', $category_id)->findAll();

        return view('front/sub_category', [
            'headerData' => $headerData,
            'subcategoryData' => $subcategoryData,
            'categoryData' => $categoryData
        ]);
    }
    public function product($sub_category_id)
    {
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
        $productData = $productmodel->where('sub_category_id', $sub_category_id)->findAll();


        return view('front/product', [
            'headerData' => $headerData,
            'subcategoryData' => $subcategoryData,
            'productData' => $productData
        ]);
    }
    public function product_details($product_id)
    {
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
            ->findAll();

        $productDataPrice = $productmodel->select('product.*,product_variants.*, MIN(product_variants.variant_price) AS min_price, MAX(product_variants.variant_price) AS max_price')
            ->join('product_variants', 'product_variants.product_id = product.product_id')
            ->where('product.product_id', $product_id)
            ->findAll();


        if (!$productData) {
            $productData = null;
        }
        if (!$productDataPrice) {
            $productDataPrice = null;
        }

        return view('front/product_details', [
            'headerData' => $headerData,
            'productData' => $productData,
            'productDataPrice' => $productDataPrice
        ]);
    }
    public function searchData()
    {
        $input = $this->request->getVar('search');
        $variantsModel = new VariantsModel();
        $result = $variantsModel->where('variant_sku', $input)->find();

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
        $userId = $session->get('user_id'); // Retrieve user ID from session

        $query = $cartmodel->select('*')
            ->join('product_variants', 'product_variants.variant_id = add_to_cart.variant_id', 'left')
            ->join('product', 'product.product_id = product_variants.product_id', 'left')
            ->join('sub_category', 'sub_category.sub_category_id = product.sub_category_id', 'left')
            ->join('category', 'category.category_id = sub_category.category_id', 'left')
            ->where('user_id', $userId)
            ->get();

        $cartData = $query->getResultArray();

        if (!$cartData) {
            $cartData = null;
        }

        return view('front/add_to_cart', [
            'cartData' => $cartData,
            'headerData' => $headerData,
            'userId' => $userId,
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
        return redirect()->to(base_url('add_to_cart'));
    }
}
