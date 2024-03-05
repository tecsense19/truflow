<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CountryModel;
use App\Models\OrderModel;
use App\Models\HeaderMenuModel;
use App\Models\CompanyModel;
use Config\Services;
use CodeIgniter\Email\Email;
use App\Models\OrderItemModel;
use App\Models\ShippingModel;
use App\Models\SettingsModel;
use App\Models\SettingsImagesModel;
use App\Models\TestominalModel;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use App\Models\ProductModel;
use App\Models\VariantsModel;
use App\Models\CartModel;
use App\Models\AddwishlistModel;
use App\Models\UserContactModel;
use App\Models\SliderModel;
use App\Models\ChildSubCategoryModel;
use App\Models\ProductRatingModel;
use App\Models\UserLoginReportModel;



class UserController extends BaseController
{

    public function register()
    {
        $session = session();
        $usermodel = new UserModel();
        $countrymodel = new CountryModel();

        $countryData = $countrymodel->find();
        if (!$countryData) {
            $countryData = null;
        }
        $headermenumodel = new HeaderMenuModel();
        $headerData = $headermenumodel->find();
        if (!$headerData) {
            $headerData = null;
        }
        $companymodel = new CompanyModel();
        $companyData = $companymodel->find();
        if (!$companyData) {
            $companyData = null;
        }
        return view('front/register', ['countryData' => $countryData, 'headerData' => $headerData, 'companyData' => $companyData]);
    }
    public function registerSave()
    {
        $usermodel = new UserModel();
        $session = session();
        $input = $this->request->getVar();

        $existingUser = $usermodel->where('email', $input['email'])->first();
        if ($existingUser) {
            $session->setFlashdata('error', 'Email already exists. Please use a different email.');
            return redirect()->to('register');
        }
        // Validate password and confirm password
        $password = $input['password'];
        $confirmPassword = $input['c_password'];
        if ($password !== $confirmPassword) {
            $session->setFlashdata('error', 'Password and confirm password do not match.');
            return redirect()->to('register');
        }
        // Encrypt the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $companymodel = new CompanyModel();
        $companyData = $companymodel->find();
        $companyNamesarray = array_column($companyData, 'company_name');
        $company_name = $input['company_name'];
        
        if(in_array($company_name, $companyNamesarray)){
            $userArr = [
                'full_name' => $input['first_name'] . " " . $input['last_name'],
                'email' => $input['email'],
                'password' => $hashedPassword,  // Store the hashed password
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                // 'gender' => $input['gender'],
                'date_of_birth' => $input['date_of_birth'],
                'mobile' => $input['mobile'],
                'user_role' => $input['user_role'],
                'company_name' => $input['company_name'],
                'address_1' => $input['address_1'],
                'address_2' => $input['address_2'],
                'city' => $input['city'],
                'zipcode' => $input['zipcode'],
                'country' => $input['country'],
                'phone' => $input['phone'],
                'fax' => $input['fax']
    
            ];
    
            if (isset($input['user_id']) && $input['user_id'] != '') {
                $usermodel->update(['user_id' => $input['user_id']], $userArr);
            } else {
                $usermodel->insert($userArr);
                $user_id_last = $usermodel->insertID();
    
                // $token = bin2hex(random_bytes(32));
                $token = base64_encode($user_id_last);
    
                $UserEmail =  $userArr['email'];
    
                $emailService = \Config\Services::email();
    
                $fromEmail = FROM_EMAIL;
                $fromName = 'Truflow Hydraulics';
    
                $emailService->setFrom($fromEmail, $fromName);
                $emailService->setTo($UserEmail);
                $emailService->setSubject('Verification');
                $emailService->setMessage('
                    <html>
                        <body>
                            <h1>Verify Your Account</h1>
                            <table cellpadding="0" cellspacing="0" width="100%" class="main_table" style="padding: 5px 5px; border: 3px solid #eeeeee;">
                                <tr>
                                    <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 0px;">
                                        <img src="https://truflow.hostedwp.com.au/truflow//public/uploads/Truflow_Logo_Dark.svg" width="125" style="display: block; border: 0px;" /><br>
                                        <h3>
                                            Click the following link to Verify Your Account
                                        </h3>
                                        <a href="' . base_url('verification/' . $token) . '" style="display:inline-block;background-color:#007bff;color:#fff;padding:10px 20px;text-decoration:none;border-radius:4px;">Verification Account</a>
    
                                    </td>
                                </tr>
                            </table>
                        </body>
                    </html>
                ');
                $session->setFlashdata('success', 'Registration successful Verify Your Account');
                // return redirect()->to('login');
                if ($emailService->send()) {
                    return redirect()->to('login');
                } else {
                    return redirect()->back()->with('error', 'Unable to send the Verification link. Please try again later.');
                }
    
            }
    
            $session->setFlashdata('success', 'Registration successful.');
             return redirect()->to('login');
        }else{
            $companyArr['company_name'] = isset($input['company_name']) ? $input['company_name'] : '';
            $companymodel->insert($companyArr);

            $userArr = [
                'full_name' => $input['first_name'] . " " . $input['last_name'],
                'email' => $input['email'],
                'password' => $hashedPassword,  // Store the hashed password
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                // 'gender' => $input['gender'],
                'date_of_birth' => $input['date_of_birth'],
                'mobile' => $input['mobile'],
                'user_role' => $input['user_role'],
                'company_name' => $input['company_name'],
                'address_1' => $input['address_1'],
                'address_2' => $input['address_2'],
                'city' => $input['city'],
                'zipcode' => $input['zipcode'],
                'country' => $input['country'],
                'phone' => $input['phone'],
                'fax' => $input['fax']
    
            ];
    
            if (isset($input['user_id']) && $input['user_id'] != '') {
                $usermodel->update(['user_id' => $input['user_id']], $userArr);
            } else {
                $usermodel->insert($userArr);
                $user_id_last = $usermodel->insertID();
    
                // $token = bin2hex(random_bytes(32));
                $token = base64_encode($user_id_last);
    
                $UserEmail =  $userArr['email'];
    
                $emailService = \Config\Services::email();
    
                $fromEmail = FROM_EMAIL;
                $fromName = 'Truflow Hydraulics';
    
                $emailService->setFrom($fromEmail, $fromName);
                $emailService->setTo($UserEmail);
                $emailService->setSubject('Verification');
                $emailService->setMessage('
                    <html>
                        <body>
                            <h1>Verify Your Account</h1>
                            <table cellpadding="0" cellspacing="0" width="100%" class="main_table" style="padding: 5px 5px; border: 3px solid #eeeeee;">
                                <tr>
                                    <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 0px;">
                                        <img src="https://truflow.hostedwp.com.au/truflow//public/uploads/Truflow_Logo_Dark.svg" width="125" style="display: block; border: 0px;" /><br>
                                        <h3>
                                            Click the following link to Verify Your Account
                                        </h3>
                                        <a href="' . base_url('verification/' . $token) . '" style="display:inline-block;background-color:#007bff;color:#fff;padding:10px 20px;text-decoration:none;border-radius:4px;">Verification Account</a>
    
                                    </td>
                                </tr>
                            </table>
                        </body>
                    </html>
                ');
                $session->setFlashdata('success', 'Registration successful Verify Your Account');
                // return redirect()->to('login');
                if ($emailService->send()) {
                    return redirect()->to('login');
                } else {
                    return redirect()->back()->with('error', 'Unable to send the Verification link. Please try again later.');
                }
    
            }

            $session->setFlashdata('success', 'Registration successful.');
            return redirect()->to('login');
        }
        
    }
    public function login()
    {

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
    public function checkLogin()
    {
        $session = session();
        $model = new UserModel();
        $UserLoginReportModel = new UserLoginReportModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $checkExists = $model->where('email', $email)->where('user_role', 'user')->first();
        if ($checkExists) {

            $user_email_verify = $checkExists['user_verify'];

            if($user_email_verify == 1){
                $hashedPassword = $checkExists['password'];
                if (password_verify($password, $hashedPassword)) {
                    $ses_data = [
                        'user_id' => $checkExists['user_id'],
                        'full_name' => $checkExists['full_name'],
                        'email' => $checkExists['email'],
                        'company_name' => $checkExists['company_name'],
                        'logged_in' => true,
                    ];
                    $session->set($ses_data);


                    // $db = \Config\Database::connect();
                    // $db->table('users')->where('user_id', $user_id)->insert($dataToUpdate);
                    $user_id = $checkExists['user_id'];
                    $dataToUpdate = [
                        'user_id' => $user_id, 
                        'last_login_time' => date('Y-m-d H:i:s')
                    ];
                    $UserLoginReportModel->insert($dataToUpdate);


                    $product_details = $session->get('product_details');

                    if ($product_details) {

                        $redirect_url = $product_details;
                        $session->remove('product_details');
                    } else {
                        $redirect_url = '/'; // main page redirect
                    }
                    return redirect()->to($redirect_url);

                    //return redirect()->to('/');
                } else {
                    $session->setFlashdata('error', 'You have entered the wrong email/password!');
                    return redirect()->to('login');
                }
            }else{
                $session->setFlashdata('error', 'You Need to Verify First Your User Account');
                return redirect()->to('login');
            }

        } else {
            $session->setFlashdata('error', 'You have entered the wrong email/password!');
            return redirect()->to('login');
        }
    }

    public function logout()
    {
        $UserLoginReportModel = new UserLoginReportModel();
        $session = session();
        $user_id = $session->get('user_id');
        $checkExists = $UserLoginReportModel->where('user_id', $user_id)->orderBy('created_at', 'DESC')->first();
        $dataToUpdate = [
            'last_logout_time' => date('Y-m-d H:i:s')
        ];
        $db = \Config\Database::connect();
        $db->table('user_login_detail_report')->where('id', $checkExists['id'])->update($dataToUpdate);
        $session->destroy();
        return redirect()->to('/');
    }

    public function user_profile($user_id)
    {
        $session = session();
        if($session->get('user_id') && $session->get('user_id') == $user_id)
        {
            $usermodel = new UserModel();
            $userData = $usermodel->where('user_id', $user_id)->first();
            if (!$userData) {
                $userData = null;
            }
            $countrymodel = new CountryModel();

            $countryData = $countrymodel->find();
            if (!$countryData) {
                $countryData = null;
            }
            $companymodel = new CompanyModel();
            $companyData = $companymodel->find();
            if (!$companyData) {
                $companyData = null;
            }
            $Headermodel = new HeaderMenuModel();
            $HeaderModel = $Headermodel->find();
            if (!$HeaderModel) {
                $HeaderModel = null;
            }

            return view('front/user_profile', ['userData' => $userData, 'countryData' => $countryData, 'companyData' => $companyData , 'headerData' => $HeaderModel]);
        }
        else
        {
            return redirect()->back();
        }
    }

    public function edit_user_profile()
    {

        $usermodel = new UserModel();
        $session = session();
        $input = $this->request->getVar();

        $user_id = $input['user_id'];

        $userArr['full_name'] = $input['first_name'] . " " . $input['last_name'];
        $userArr['email'] = isset($input['email']) ? $input['email'] : '';
        $userArr['first_name'] = isset($input['first_name']) ? $input['first_name'] : '';
        $userArr['last_name'] = isset($input['last_name']) ? $input['last_name'] : '';
        // $userArr['gender'] = isset($input['gender']) ? $input['gender'] : '';
        $userArr['date_of_birth'] = isset($input['date_of_birth']) ? $input['date_of_birth'] : '';
        $userArr['mobile'] = isset($input['mobile']) ? $input['mobile'] : '';
        $userArr['user_role'] = isset($input['user_role']) ? $input['user_role'] : '';
        $userArr['company_name'] = isset($input['company_name']) ? $input['company_name'] : '';
        $userArr['address_1'] = isset($input['address_1']) ? $input['address_1'] : '';
        $userArr['address_2'] = isset($input['address_2']) ? $input['address_2'] : '';
        $userArr['city'] = isset($input['city']) ? $input['city'] : '';
        $userArr['zipcode'] = isset($input['zipcode']) ? $input['zipcode'] : '';
        $userArr['country'] = isset($input['country']) ? $input['country'] : '';
        $userArr['phone'] = isset($input['phone']) ? $input['phone'] : '';
        $userArr['fax'] = isset($input['fax']) ? $input['fax'] : '';

        if (isset($input['user_id']) && $input['user_id'] != '') {
            $usermodel->update(['user_id' => $input['user_id']], $userArr);
        }

        $session->setFlashdata('success', 'Update Data successfully.');

        $countrymodel = new CountryModel();

        $countryData = $countrymodel->find();
        if (!$countryData) {
            $countryData = null;
        }
        $usermodel = new UserModel();
        $userData = $usermodel->where('user_id', $user_id)->first();
        if (!$userData) {
            $userData = null;
        }
        return redirect()->back();
    }
    public function my_order($user_id)
    {
        $session = session();
        $usermodel = new UserModel();
        $userData = $usermodel->where('user_id', $user_id)->first();
        if (!$userData) {
            $userData = null;
        }

        $countrymodel = new CountryModel();
        $countryData = $countrymodel->find();
        if (!$countryData) {
            $countryData = null;
        }

        $HeaderMenuModel = new HeaderMenuModel();
        $headerData = $HeaderMenuModel->find();
        if (!$headerData) {
            $headerData = null;
        }

        $ordermodel = new OrderModel();
        $orderitemmodel = new OrderItemModel();
        $cartData = $orderitemmodel->find();
        $userId = $session->get('user_id');

        $query1 = $orderitemmodel->select('*')
            ->join('tbl_order', 'tbl_order.order_id = order_items.order_id', 'left')
            ->join('product_variants', 'product_variants.variant_id = order_items.variant_id', 'left')
            ->join('product', 'product.product_id = product_variants.product_id', 'left')
            ->join('sub_category', 'sub_category.sub_category_id = product.sub_category_id', 'left')
            ->join('category', 'category.category_id = sub_category.category_id', 'left')
            ->join('users', 'users.user_id = tbl_order.user_id', 'left')
            ->join('shipping_address', 'shipping_address.order_id = tbl_order.order_id','left')
            ->where('users.user_id', $userId)
            ->orderBy('tbl_order.order_id', 'DESC')
            ->get();

            // $query1 = $orderitemmodel->select('*')
            // ->join('tbl_order', 'tbl_order.order_id = order_items.order_id', 'left')
            // ->join('product_variants', 'product_variants.variant_id = order_items.variant_id', 'left')
            // ->join('product', 'product.product_id = product_variants.product_id', 'left')
            // ->join('sub_category', 'sub_category.sub_category_id = product.sub_category_id', 'left')
            // ->join('category', 'category.category_id = sub_category.category_id', 'left')
            // ->join('users', 'users.user_id = tbl_order.user_id', 'left')
            // ->join('shipping_address', 'shipping_address.order_id = tbl_order.order_id','left')
            // ->where('users.user_id', $userId)
            // ->orderBy('tbl_order.order_id', 'ASC')
            // ->get();
            
        
        // Execute the query
        // Print the last query
        // echo $orderitemmodel->getLastQuery(); die;
        $orderData = $query1->getResultArray();
        // echo '<pre>';print_r($orderData);echo '</pre>';die;
        $ordersByOrderId = [];
        foreach ($orderData as $order) {
            $orderId = $order['order_id'];
            if (!isset($ordersByOrderId[$orderId])) {
                $ordersByOrderId[$orderId] = [];
            }
            $ordersByOrderId[$orderId][] = $order;
        }
        $shippingmodel = new ShippingModel();

        $shipping = null;

        if (!empty($orderData) && isset($orderData[0]['order_id'])) {
            $shipping = $shippingmodel->where('order_id', $orderData[0]['order_id'])->first();
        }

        if (!$shipping) {
            $shipping = null;
        }

        if (!$orderData) {
            $orderData = null;
        }

        return view('front/my_order', ['userData' => $userData, 'countryData' => $countryData, 'orderData' => $orderData, 'ordersByOrderId' => $ordersByOrderId ,'headerData' => $headerData]);
        return view('front/order_pdf', ['userData' => $userData, 'countryData' => $countryData, 'orderData' => $orderData, 'ordersByOrderId' => $ordersByOrderId, 'shipping' => $shipping]);
    }
    // -----------------------------------------------
    public function forgotPassword()
    {

        return view('front/forgot_password');
    }
    public function resetPassword()
    {

        $input = $this->request->getVar();
        $email = $this->request->getPost('email');

        $model = new UserModel();
        $user = $model->where('email', $email)->first();


        if (!$user) {
            return redirect()->back()->with('error', 'Email does not exist.');
        }

        $token = bin2hex(random_bytes(32));

        $model->where('user_id', $user['user_id'])->set(
            ['reset_token' => $token, 'reset_token_expires_at' => date('Y-m-d H:i:s', strtotime('+1 hour'))]
        )->update();

        $emailService = \Config\Services::email();

        $fromEmail = FROM_EMAIL;
        $fromName = 'Truflow Hydraulics';

        $emailService->setFrom($fromEmail, $fromName);
        $emailService->setTo($user['email']);
        $emailService->setSubject('Password Reset');
        $emailService->setMessage('
            <html>
                <body>
                    <h1>Forgot Password</h1>
                    <p>Click the following link to reset your password:</p>
                    <p>
                        <a href="' . base_url('reset-password/' . $token) . '" style="display:inline-block;background-color:#007bff;color:#fff;padding:10px 20px;text-decoration:none;border-radius:4px;">Reset Password</a>
                    </p>
                </body>
            </html>
        ');

        if ($emailService->send()) {
            return redirect()->back()->with('success', 'Password reset link has been sent to your email.');
        } else {
            return redirect()->back()->with('error', 'Unable to send the password reset link. Please try again later.');
        }
    }

    public function verification($token)
    {

        $decoded_user_id = base64_decode($token);

        $model = new UserModel();
        $user = $model->where('user_id ', $decoded_user_id)->first();
        $user_verify =  $user['user_verify'];

        $model->update($decoded_user_id, [
            'user_verify' => 1
        ]);

        return view('front/user_verification');
    }
    public function reset($token)
    {

        $model = new UserModel();
        $user = $model->where('reset_token', $token)->first();
        return view('front/reset_password', [
            'token' => $token,

        ]);
    }
    public function reset_password($token)
    {
        $session = session();
        $model = new UserModel();
        $user = $model->where('reset_token', $token)->first();

        if (!$user || strtotime($user['reset_token_expires_at']) < time()) {
            return view('front/reset_password', [
                'token' => $token,
                'error' => 'Token expired'
            ]);
        }

        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');

        if ($password != $confirmPassword) {
            $session->setFlashdata('error', 'Password Not Match.');
            return view('front/reset_password', [
                'token' => $token
            ]);
        }

        // Update the user's password
        $model->update($user['user_id'], [
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'reset_token' => null,
            'reset_token_expires_at' => null
        ]);
        $session->setFlashdata('success', 'Password reset successfully.');
        return redirect()->to('login'); // Update with the appropriate login route or URL
    }


    private function isTokenValid($expiresAt)
    {
        return strtotime($expiresAt) > time();
    }


    public function generate_pdf()
    {
        $orderId = $this->request->getPost('order_id');
        $pdfFilePath = 'Invoice/' . $orderId . '.pdf';

        $ordermodel = new OrderModel();
        $orderitemmodel = new OrderItemModel();

        // Fetch order data
        $query = $orderitemmodel->select('*')
            ->join('tbl_order', 'tbl_order.order_id = order_items.order_id', 'left')
            ->join('product_variants', 'product_variants.variant_id = order_items.variant_id', 'left')
            ->join('product', 'product.product_id = product_variants.product_id', 'left')
            ->join('sub_category', 'sub_category.sub_category_id = product.sub_category_id', 'left')
            ->join('category', 'category.category_id = sub_category.category_id', 'left')
            ->join('users', 'users.user_id = tbl_order.user_id', 'left')
            ->join('shipping_address', 'shipping_address.order_id = tbl_order.order_id')
            ->where('tbl_order.order_id', $orderId)
            ->get();


        $orderData = $query->getResultArray();

        $ordersByOrderId = [$orderId => $orderData];

        $shippingmodel = new ShippingModel();
        $shipping = $shippingmodel->where('order_id', $orderData[0]['order_id'])->first();

        if (!$shipping) {
            $shipping = null;
        }
        $usermodel = new UserModel();
        $userData = $usermodel->where('user_id', $orderData[0]['user_id'])->first();
        if (!$userData) {
            $userData = null;
        }

        $data = [
            'userData' => $userData,
            'countryData' => null,
            'orderData' => $orderData,
            'ordersByOrderId' => $ordersByOrderId,
            'shipping' => $shipping
        ];

        $html = view('front/order_pdf', $data);

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output($pdfFilePath, 'D');
    }
}
