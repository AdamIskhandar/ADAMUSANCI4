<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{

    public function login()
    {
        $session = \Config\Services::session();
        $data = [
            'session' => $session->get('token'),
            'flashSession' => $session->getFlashdata('message')
        ];

        if ($session->get('token')) {
            return redirect()->back();
        } else {
            return view('Templates/header', $data)  . view('auth/login', $data) . view('Templates/footer');
        }
    }

    public function register()
    {
        $session = \Config\Services::session();
        $data = [
            'session' => $session->get('token')
        ];

        if ($session->get('token')) {
            return redirect()->back();
        } else {
            return view('Templates/header', $data)  . view('auth/register') . view('Templates/footer');
        }
    }

    public function register_auth()
    {
        $userModel = new UserModel();
        $session = \Config\Services::session();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $name = $this->request->getVar('name');

        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $generateToken = rand(1000000, 99999999);

        $data = [
            'username' => $name,
            'email' => $email,
            'password' => $hashPassword,
            'token' => $generateToken
        ];

        $sessionData = [
            'token' => $generateToken
        ];

        $addUser = $userModel->insert($data, false);

        if ($addUser) {
            $session->set($sessionData);
            return redirect()->to('/Dashboard');
        } else {
            return redirect()->to('/register');
        }
    }

    public function login_auth()
    {
        $userModel = new UserModel();
        $session = \Config\Services::session();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $userModel->where('email', $email)->first();

        if ($user) {

            $checkPassword = password_verify($password, $user['password']);

            $sessionData = [
                'token' => $user['token']
            ];

            if ($checkPassword) {
                $session->set($sessionData);
                return redirect()->to('/dashboard');
            } else {

                $dataFlashSession = [
                    'message' => 'Your Email or password is not valid'
                ];

                $session->setFlashdata($dataFlashSession);
                return redirect()->to('/login');
            }
        } else {

            $dataFlashSession = [
                'message' => 'Your Account is not Valid!!'
            ];

            $session->setFlashdata($dataFlashSession);

            return redirect()->to('/login');
        }
    }

    public function logout_auth()
    {
        $session = \Config\Services::session();

        $session->destroy();

        return redirect()->to('/');
    }
}
