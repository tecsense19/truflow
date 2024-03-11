<?php

namespace App\Controllers\Admin;

use App\Models\CompanyModel;
use App\Models\UserModel;
use App\Models\CouponModel;
use App\Models\CountryModel;

class CompanyController extends BaseController
{
    public function index()
    {
        $session = session();
        $user_id = $session->get('user_id');
        if($user_id){
            $companymodel = new CompanyModel();
            $companyData = $companymodel->find();
            if (!$companyData) {
                $companyData = null;
            }
            return view('admin/company/company_list', ['companyData' => $companyData]);
        }else{
            return redirect()->to('/admin');
        }
    }
    public function company()
    {
        $companymodel = new CompanyModel();
        return view('admin/company/company');
    }
    public function companySave()
    {

        $companymodel = new CompanyModel();
        $session = session();
        $input = $this->request->getVar();
        $company_id = $input['company_id'];

        $companyArr = [];

        $companyArr['company_name'] = isset($input['company_name']) ? $input['company_name'] : '';
        $companyArr['on_a_account'] = isset($input['on_a_account']) ? $input['on_a_account'] : '';
      

        if (isset($input['company_id']) && $input['company_id'] != '') {
            $companymodel->update(['company_id', $input['company_id']], $companyArr);
        } else {
            $companymodel->insert($companyArr);
        }

        $session->setFlashdata('success', 'company change succesfully.');
        return redirect()->to('admin/company_list');
       
    }
    public function companyEdit($company_id)
    {
        $usermodel = new UserModel();
        $CouponModel = new CouponModel();
        $countrymodel = new CountryModel();
        $session = session();
        $user_id = $session->get('user_id');
        if($user_id){
            $companymodel = new CompanyModel();
            $companyData = $companymodel->find($company_id);
    
            if (!$companyData) {
                $companyData = null;
            }

            $countryData = $countrymodel->find();
            if (!$countryData) {
                $countryData = null;
            }
            return view('admin/company/company', ['companyData' => $companyData, 'countryData' => $countryData]);
        }else{
            return redirect()->to('/admin');
        }
    }

    public function companyDelete($company_id)
    {
        $session = session();
        $companymodel = new CompanyModel();
        $companymodel->delete($company_id);
        $session->setFlashdata('success', 'company Delete succesfully.');
        return redirect()->to('admin/company_list');
    }

    function random_password()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $password = array();
        $alpha_length = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++)
        {
            $n = rand(0, $alpha_length);
            $password[] = $alphabet[$n];
        }
        return implode($password);
    }

    // Company user add or edit
    public function company_user_add(){

        $usermodel = new UserModel();
        $session = session();

        $input = $this->request->getVar();
        $userArr = [];
        $userArr = [
            'full_name' => $input['first_name'] . " " . $input['last_name'],
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'company_name' => $input['company_name'],
            'country' => $input['country'],
            'date_of_birth' => $input['date_of_birth'],
            'address_1' => $input['address_1'],
            'address_2' => $input['address_2'],
            'city' => $input['city'],
            'zipcode' => $input['zipcode'],
            'phone' => $input['phone'],
            'mobile' => $input['mobile'],
            'fax' => $input['fax'],
            'user_role' => 'user',

        ];
        // echo '<pre>';print_r($input['user_id']);echo '</pre>';die;
        if (isset($input['user_id']) && $input['user_id'] != '') {
            $user_id = $usermodel->update(['user_id', $input['user_id']], $userArr);

            if ($user_id) {
                $response = ['status' => 'success', 'message' => 'User detail updated successfully!'];
            } else {
                $response = ['status' => 'error'];
            }
        }else{
            $user_id = $usermodel->insert($userArr);    
    
            $UserEmail = $input['email'];
    
    
            $passwordnew = $this->random_password();
            
            $hashedPassword = password_hash($passwordnew, PASSWORD_DEFAULT);
            $datapasswordk = [
                'password' => $hashedPassword,
                'user_verify' => '1',
            ];
            // echo '<pre>';print_r($datapasswordk);echo '</pre>';
            
            $usermodel->set($datapasswordk)->where('user_id', $user_id)->update();
            
            $emailService = \Config\Services::email();
            
            $fromEmail = FROM_EMAIL;
            $fromName = 'Truflow Hydraulics';
    
            $emailService->setFrom($fromEmail, $fromName);
            $emailService->setTo($UserEmail);
            $emailService->setSubject('Your Login Password');
            $emailService->setMessage('
                <html>
                    <body>
                        <h1>Your Login Password</h1>
                        <table cellpadding="0" cellspacing="0" width="100%" class="main_table" style="padding: 5px 5px; border: 3px solid #eeeeee;">
                            <tr>
                                <td align="center" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding-top: 0px;">
                                    <img src="https://truflow.hostedwp.com.au/truflow//public/uploads/Truflow_Logo_Dark.svg" width="125"  style="display: block; border: 0px;" /><br>
                                    <h3>
                                        User Name: '. $UserEmail .'
                                    </h3>
                                    <h3>
                                        Password: '. $passwordnew .'
                                    </h3>
                                </td>
                            </tr>
                        </table>
                    </body>
                </html>
            ');
    
            
            $emailService->send();
            if ($user_id) {
                $response = ['status' => 'success', 'message' => 'User Detail inserted successfully!'];
            } else {
                $response = ['status' => 'error'];
            }
        }
            
        // Return JSON response
        return $this->response->setJSON($response);
    }

    // Company user edit data get
    public function companyuserEdit($user_id)
    {
        $usermodel = new UserModel();
        $userData = $usermodel->find($user_id);
        return json_encode($userData);
    }

    // Company user list get
    public function company_user_list(){
        $usermodel = new UserModel();
        $companymodel = new CompanyModel();

        $input = $this->request->getVar();
        $company_id = $input['company_id'];

        $companyData = $companymodel->find($company_id);
        
        $userlist = $usermodel->where('company_name',$companyData['company_name'])->find();
        
        return view('admin/company/company_user_table', ['userlist' => $userlist]);
    }

    // Company user delete
    public function company_user_delete(){
        $usermodel = new UserModel();
        // $input = $request->all();
        $input = $this->request->getVar();
        
        $delete_user = $usermodel->where('user_id', $input['user_id'])->delete();
        if($delete_user){
            $response = ['status' => 'success', 'message' => 'User Deleted successfully!'];
        }else{
            $response = ['status' => 'error'];
        }
        return $this->response->setJSON($response);
    }

    // Company coupan add or edit
    public function company_coupan_add(){
        $coupanmodel = new CouponModel();
        $input = $this->request->getVar();
        $coupanArr = [];
        $coupanArr = [
            'coupon_code' => $input['coupon_code'],
            'company_id' => $input['company_id'],
            'coupon_price' => $input['coupon_price'],
            'coupon_price_type' => $input['coupon_price_type'],
            'from_date' => $input['from_date'],
            'to_date' => $input['to_date'],

        ];
        if (isset($input['coupon_id']) && $input['coupon_id'] != '') {
            $coupanmodel = $coupanmodel->update(['coupon_id', $input['coupon_id']], $coupanArr);
            if ($coupanmodel) {
                $response = ['status' => 'success', 'message' => 'Coupan updated successfully!'];
            } else {
                $response = ['status' => 'error'];
            }
        }
        else{
            $coupanmodel = $coupanmodel->insert($coupanArr);  
            if ($coupanmodel) {
                $response = ['status' => 'success', 'message' => 'Coupan created successfully!'];
            } else {
                $response = ['status' => 'error'];
            }
        }
        return $this->response->setJSON($response);
    }

    // Company coupan list 
    public function company_coupan_list(){
        $companymodel = new CompanyModel();
        $CouponModel = new CouponModel();

        $input = $this->request->getVar();
        $company_id = $input['company_id'];

        $companyData = $companymodel->find($company_id);
        $coupanlist = $CouponModel->where('company_id',$companyData['company_name'])->find();
        
        return view('admin/company/company_coupan_table', ['coupanlist' => $coupanlist]);
    }

    // Company coupan edit data get
    public function companycoupanEdit($coupon_id)
    {
        $CouponModel = new CouponModel();
        $coupanData = $CouponModel->find($coupon_id);
        return json_encode($coupanData);
    }

    // Company coupan deleted
    public function company_coupan_delete(){
        $CouponModel = new CouponModel();
        $input = $this->request->getVar();
        
        $delete_user = $CouponModel->where('coupon_id', $input['coupon_id'])->delete();
        if($delete_user){
            $response = ['status' => 'success', 'message' => 'Coupan Deleted successfully!'];
        }else{
            $response = ['status' => 'error'];
        }
        return $this->response->setJSON($response);
    }

}
