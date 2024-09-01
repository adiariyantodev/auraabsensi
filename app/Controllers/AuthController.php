<?php

namespace App\Controllers;

class AuthController extends BaseController
{
    public function login()
    {
        $data['title'] = 'Login';
        return view('pages/login', $data);
    }
}
