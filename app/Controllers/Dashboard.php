<?php

namespace App\Controllers;

// Add this line to import the class.

class Dashboard extends BaseController
{
    public function index()
    {
        $data['title'] = 'Dashboard';

        return view('pages/dashboard', $data);
    }
}
