<?php

namespace App\Controllers;

class Auth extends BaseController
{

    public function login()
    {
        $data = ['title' => 'Login'];
        return view('pages/auth/login', $data);
    }

    public function register()
    {
        $data = ['title' => 'Register'];
        return view('pages/auth/register', $data);
    }
}
