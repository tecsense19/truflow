<?php

namespace App\Controllers;

use App\Models\UserModel;



class UserController extends BaseController
{

    public function register()
    {
        $session = session();
        $usermodel = new UserModel();
        return view('front/register');
    }
    public function registerSave()
    {
        $usermodel = new UserModel();
        $session = session();
        $input = $this->request->getVar();

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
            'gender' => $input['gender'],
            'date_of_birth' => $input['date_of_birth'],
            'mobile' => $input['mobile'],
            'user_role' => $input['user_role']
        ];

        if (isset($input['user_id']) && $input['user_id'] != '') {
            $usermodel->update(['user_id' => $input['user_id']], $userArr);
        } else {
            $usermodel->insert($userArr);
        }

        $session->setFlashdata('success', 'Registration successful.');
        return redirect()->to('register');
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

            return redirect()->to('/');
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
}
