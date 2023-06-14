<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CountryModel;
use App\Models\OrderModel;


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

        return view('front/register', ['countryData' => $countryData]);
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
        }

        $session->setFlashdata('success', 'Registration successful.');
        return redirect()->to('login');
    }
    public function login()
    {
        $session = session();
        $usermodel = new UserModel();


        return view('front/login');
    }
    public function checkLogin()
    {
        $session = session();
        $model = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $checkExists = $model->where('email', $email)->where('user_role', 'user')->first();
        if ($checkExists) {
            $hashedPassword = $checkExists['password'];
            if (password_verify($password, $hashedPassword)) {
                $ses_data = [
                    'user_id' => $checkExists['user_id'],
                    'full_name' => $checkExists['full_name'],
                    'email' => $checkExists['email'],
                    'logged_in' => true,
                ];
                $session->set($ses_data);

                $product_details = $session->get('product_details'); // set the sessionin product detail page

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
        } else {
            $session->setFlashdata('error', 'You have entered the wrong email/password!');
            return redirect()->to('login');
        }
    }


    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }

    public function user_profile($user_id)
    {
        $session = session();
        $usermodel = new UserModel();
        //$userData = $usermodel->find();
        $userData = $usermodel->where('user_id', $user_id)->first();
        if (!$userData) {
            $userData = null;
        }
        $countrymodel = new CountryModel();

        $countryData = $countrymodel->find();
        if (!$countryData) {
            $countryData = null;
        }
        // echo "<pre>"; 
        // print_r($userData);
        // die();
      
        return view('front/user_profile',['userData' => $userData,'countryData' => $countryData]);
    }

    public function edit_user_profile()
    {
       
        $usermodel = new UserModel();
        $session = session();
        $input = $this->request->getVar();
        
       
        $user_id = $input['user_id'];

        // $userArr = [];
        $userArr['full_name'] = $input['first_name'] . " " . $input['last_name'];
         $userArr['email'] = isset($input['email']) ? $input['email'] : '';
         $userArr['first_name'] = isset($input['first_name']) ? $input['first_name'] : '';
         $userArr['last_name'] = isset($input['last_name']) ? $input['last_name'] : '';
         $userArr['gender'] = isset($input['gender']) ? $input['gender'] : '';
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

        //  echo "<pre>";
        // print_r($userArr);
        // die();
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
        //return view('front/user_profile',['userData' => $userData,'countryData' => $countryData]);
    }
    public function my_order($user_id)
    {
        $session = session();
        $usermodel = new UserModel();
        //$userData = $usermodel->find();
        $userData = $usermodel->where('user_id', $user_id)->first();
        if (!$userData) {
            $userData = null;
        }
        $countrymodel = new CountryModel();

        $countryData = $countrymodel->find();
        if (!$countryData) {
            $countryData = null;
        }
        
        $ordermodel = new OrderModel();
        $userId = $session->get('user_id');
        $query = $ordermodel->select('*')
            ->join('product_variants', 'product_variants.variant_id = tbl_order.variant_id', 'left')
            ->join('product', 'product.product_id = product_variants.product_id', 'left')
            ->join('sub_category', 'sub_category.sub_category_id = product.sub_category_id', 'left')
            ->join('category', 'category.category_id = sub_category.category_id', 'left')
            ->join('users', 'users.user_id = tbl_order.user_id', 'left')
            ->where('users.user_id', $userId)
            
            ->get();

        $orderData = $query->getResultArray();

        // echo "<pre>";
        // print_r($orderData);
        // die();
        if (!$orderData) {
            $orderData = null;
        }

        return view('front/my_order',['userData' => $userData,'countryData' => $countryData, 'orderData' => $orderData]);
    }

}
