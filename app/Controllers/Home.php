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

        $categoryData = $categorymodel->orderBy('created_at', 'DESC')->findAll(5);

        foreach ($categoryData as &$category) {
            $productdata = $productmodel->where('category_id', $category['category_id'])->findAll();
            $category['products'] = $productdata ? $productdata : null;
        }

        $newProductdata = $productmodel->findAll();
        if (!$newProductdata) {
            $newProductdata = null;
        }

        $wishlistCount = count($wishlistData ?? []);
        $session->set('wishlistCount', $wishlistCount);

        $cartCount = count($cartData ?? []);
        $session->set('cartCount', $cartCount);

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
                'newProductdata' => $newProductdata,
                'categoryData' => $categoryData,

                //count
                'wishlistCount'=> $wishlistCount,
                'cartCount'=> $cartCount
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

        // $productDataPrice = $productmodel->select('product.*,product_variants.*, MIN(product_variants.variant_price) AS min_price, MAX(product_variants.variant_price) AS max_price')
        //     ->join('product_variants', 'product_variants.product_id = product.product_id')
        //     ->where('product.product_id', $product_id)
        //     ->groupBy('product.product_id',$product_id)
        //     ->findAll();

        $productDataPrice = $variantsmodel->table('product_variants')
        ->select('MIN(variant_price) AS min_price, MAX(variant_price) AS max_price')
        ->join('product', 'product.product_id = product_variants.product_id')
        ->where('product.product_id', $product_id)
        ->findAll();

        // print_r($productDataPrice);
        // die();
        //  $lastQuery = $productmodel->getLastQuery();
        //  echo $lastQuery;


        if (!$productData) {
            $productData = null;
        }
        if (!$productDataPrice) {
            $productDataPrice = null;
        }
        $addwishlistmodel = new AddwishlistModel();
        $session = session();
        $userId = $session->get('user_id');

        
            $addwishData1 = $addwishlistmodel->select('*')
       
            ->join('product', 'product.product_id = addwish_list.product_id', 'left')
            ->where('addwish_list.isdeleted', 0)
            ->where('addwish_list.user_id', $userId)
            ->get();

            $addwishData = $addwishData1->getResultArray();

            // $lastQuery = $addwishlistmodel->getLastQuery();
            // echo $lastQuery;
            // echo "<pre>";
            // print_r($addwishData);

        if (!$addwishData) {
            $addwishData = null;
        }
        //set session for user not login and click to cart
        $product_details = current_url(true);
        $session->set('product_details', $product_details);
        //------------

        return view('front/product_details', [
            'headerData' => $headerData,
            'productData' => $productData,
            'productDataPrice' => $productDataPrice,
            'addwishData' => $addwishData
            
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

        $cartCount = count($cartData ?? []);

        $session->set('cartCount', $cartCount);

        return view('front/add_to_cart', [
            'cartData' => $cartData,
            'headerData' => $headerData,
            'userId' => $userId,
            'cartCount' => $cartCount, // Pass the cart count to the view
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


        $wishlistData = $addwishlistmodel->select('*')
       
        ->join('product', 'product.product_id = addwish_list.product_id', 'left')
        ->join('product_variants', 'product_variants.product_id = product.product_id', 'left')
        ->where('addwish_list.user_id', $userId)
        ->where('addwish_list.isDeleted', 0)
        ->groupBy('addwish_list.product_id', 'addwish_list.user_id')
        ->findAll();

        $lastQuery = $cartmodel->getLastQuery();
            // echo $lastQuery;
            // echo "<pre>";
            // print_r($wishlistData);
            // die();
        if (!$wishlistData) {
            $wishlistData = null;
        }

        $wishlistCount = count($wishlistData ?? []);
        $session->set('wishlistCount', $wishlistCount);

        return view('front/wish_list', [
            'wishlistData' => $wishlistData,
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
        return redirect()->to(base_url('wish_list'));
    }
    public function add_wishlist()//image change
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
    public function deleteWishList()//image change
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
        $variantIds = $this->request->getVar('variant_id');
        $contact_email = $this->request->getVar('contact_email');
        $company_name = $this->request->getVar('company_name');
        $contact_phone = $this->request->getVar('contact_phone');
 
                $data = array(
                   
                    'contact_name' => $contact_name,
                    'contact_email' => $contact_email,
                    'company_name' => $company_name,
                    'contact_phone' => $contact_phone
                   
                );
                $usercontactmodel->insert($data);
        
        $session->setFlashdata('success', 'Submit Your Details Successfully.');

        return redirect()->back();
    }



    
}
