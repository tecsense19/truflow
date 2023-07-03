<?php

namespace App\Controllers\Admin;
use App\Models\UserModel;
use App\Models\OrderModel;
use App\Models\CountryModel;
use App\Models\CompanyModel;

class Home extends BaseController
{
    public function index()
    {
        
        if(! session()->get('logged_in')) {
            return view('admin/login');
        }
        else
        {
            return redirect()->to('/admin/dashboard');
        }
    }
    
    public function dashboard()
    {
        $model = new UserModel();
        $checkUser = $model->where('user_role', 'user')->findAll();

        $userCount = count($checkUser);

        if (!$userCount) {
            $userCount = null;
        }

        $ordermodel = new OrderModel();
        $checkOrder = $ordermodel->findAll();

        $orderCount = count($checkOrder);

        if (!$orderCount) {
            $orderCount = null;
        }
        $checkApprove = $ordermodel->where('order_status', 'Approved')->findAll();

        $orderApproved = count($checkApprove);

        if (!$orderApproved) {
            $orderApproved = null;
        }

        $checkPanding = $ordermodel->where('order_status', 'Pending')->findAll();

        $orderPanding = count($checkPanding);

        if (!$orderPanding) {
            $orderPanding = null;
        }

        return view('admin/dashboard/dashboard',['userCount'=> $userCount,'orderCount'=>$orderCount,'orderApproved'=>$orderApproved,'orderPanding'=>$orderPanding]);
    }

    public function checkLogin()
    {
        $session = session();
        $model = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $checkExists = $model->where('email', $email)->where('user_role', 'Admin')->first();
        if($checkExists){
            $pass = $checkExists['password'];
            if($password == $pass){
                $ses_data = [
                    'user_id' => $checkExists['user_id'],
                    'full_name' => $checkExists['full_name'],
                    'email' => $checkExists['email'],
                    'logged_in' => true,
                ];
                $session->set($ses_data);
                return redirect()->to('/admin/dashboard');
            }else{
                $session->setFlashdata('error', 'You have entered wrong email/password!');
                return redirect()->to('/admin');
            }
        }else{
            $session->setFlashdata('error', 'You have entered wrong email/password!');
            return redirect()->to('/admin');
        }
    }
  
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/admin');
    }

    public function user_list()
    {
    
        $usermodel = new UserModel();
        // $userData = $usermodel->find();
        $userData = $usermodel->where('user_role', 'user')->findAll();
        if (!$userData) {
            $userData = null;
        }        
        return view('admin/user/user_list',['userData'=> $userData]);
    }

    public function user()
    {
        $usermodel = new UserModel();
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
        
        return view('admin/user/user',['countryData'=>$countryData,'companyData'=>$companyData]);
    }

    public function userSave()
{
    $usermodel = new UserModel();
    $session = session();
    $input = $this->request->getVar();

    $existingUser = $usermodel->where('email', $input['email'])->first();
    if ($existingUser && $existingUser['user_id'] != $input['user_id']) {
        $session->setFlashdata('error', 'Email already exists. Please use a different email.');
        return redirect()->back();
    }

    $userArr = [
        'full_name' => $input['first_name'] . " " . $input['last_name'],
        'first_name' => $input['first_name'],
        'last_name' => $input['last_name'],
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
        $session->setFlashdata('success', 'User Data Update successfully.');
    } else {
        $password = $input['password'];
        $confirmPassword = $input['c_password'];
        
        // Validate password and confirm password
        if ($password !== $confirmPassword) {
            $session->setFlashdata('error', 'Password and confirm password do not match.');
            return redirect()->back();
        }
        
        // Encrypt the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $userArr['email'] = $input['email'];
        $userArr['password'] = $hashedPassword;
        
        $usermodel->insert($userArr);
        $session->setFlashdata('success', 'User Added successfully.');
    }

    
    return redirect()->to('admin/user_list');
}

    
    public function userEdit($user_id)
    {

        $usermodel = new UserModel();
        $userData = $usermodel->find($user_id);

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
        return view('admin/user/user', ['userData' => $userData,'countryData'=>$countryData,'companyData'=>$companyData]);
    }

    public function userDelete($user_id){
        // echo "1";
        // die();
        $session = session();
        $usermodel = new UserModel();
        $usermodel->delete($user_id);
        $session->setFlashdata('success', 'User Delete succesfully.');
        return redirect()->back();
    }
}
