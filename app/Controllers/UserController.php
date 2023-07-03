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

        return view('front/register', ['countryData' => $countryData, 'headerData' => $headerData,'companyData'=>$companyData]);
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

        $headermenumodel = new HeaderMenuModel();
        $headerData = $headermenumodel->find();
        if (!$headerData) {
            $headerData = null;
        }

        return view('front/login', ['headerData' => $headerData]);
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

                $product_details = $session->get('product_details');
                
                // echo "<pre>";
                // print_r($product_details);
                // die();
                
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
        $companymodel = new CompanyModel();
        $companyData = $companymodel->find();
        if (!$companyData) {
            $companyData = null;
        }

        // echo "<pre>"; 
        // print_r($companyData);
        // die();

        return view('front/user_profile', ['userData' => $userData, 'countryData' => $countryData,'companyData'=>$companyData]);
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
        $orderitemmodel = new OrderItemModel();
        $cartData = $orderitemmodel->find();
        $userId = $session->get('user_id');
        $query = $orderitemmodel->select('*')
        ->join('tbl_order', 'tbl_order.order_id = order_items.order_id', 'left')
        ->join('product_variants', 'product_variants.variant_id = order_items.variant_id', 'left')
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

        return view('front/my_order', ['userData' => $userData, 'countryData' => $countryData, 'orderData' => $orderData]);
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

        $fromEmail = 'nadim@tec-sense.com';
        $fromName = 'TRUFLOW';

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

        // echo "<pre>";
        // print_r($emailService);
        // die();

        if ($emailService->send()) {
            return redirect()->back()->with('success', 'Password reset link has been sent to your email.');
        } else {
            return redirect()->back()->with('error', 'Unable to send the password reset link. Please try again later.');
        }
    }

    public function reset($token)
    {
        
         return view('front/reset_password', [
                'token' => $token,
               
            ]);
    }
    public function reset_password($token){
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
                'token' => $token]);
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
    
}
