<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [];
        $data['page'] = 'Home';
        
        echo view('template/header', $data);
        echo view('template/home');
        echo view('template/footer');
    }
}
