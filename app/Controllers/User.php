<?php

namespace App\Controllers;

class User extends BaseController
{
    public function dashboard()
    {
        $session = \Config\Services::session();

        $data = [
            'session' => $session->get('token')
        ];

        if ($session->get('token')) {
            return view('Templates/header', $data)  . view('User/dashboard') . view('Templates/footer');
        } else {
            return redirect()->to('/login');
        }
    }

    public function about()
    {
        $session = \Config\Services::session();

        $data = [
            'session' => $session->get('token')
        ];

        if ($session->get('token')) {
            return view('Templates/header', $data)  . view('User/about') . view('Templates/footer');
        } else {
            $dataFlashSession = [
                'message' => 'Please Sign In First!!'
            ];
            $session->setFlashdata($dataFlashSession);
            return redirect()->to('/login');
        }
    }
}
