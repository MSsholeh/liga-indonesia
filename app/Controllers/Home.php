<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends BaseController
{
    public function index(): string
    {
        $data['title'] = 'Dashboard';
        return view('dashboard', $data);
    }
}
