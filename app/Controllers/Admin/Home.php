<?php

namespace App\Controllers\Admin;
use App\Models\UserModel;

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
                
        return view('admin/dashboard/dashboard');
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

    public function user()
    {
    
        $usermodel = new UserModel();
        // $userData = $usermodel->find();
        $userData = $usermodel->where('user_role', 'user')->findAll();
        if (!$userData) {
            $userData = null;
        }        
        return view('admin/user/user_list',['userData'=> $userData]);
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
