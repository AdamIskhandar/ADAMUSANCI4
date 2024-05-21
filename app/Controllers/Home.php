<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $session = \Config\Services::session();

        $data = [
            'session' => $session->get('token')
        ];

        if ($session->get('token')) {
            return redirect()->to('/dashboard');
        } else {
            return view('Templates/header', $data)  . view('welcome_message') . view('Templates/footer');
        }
    }
}
