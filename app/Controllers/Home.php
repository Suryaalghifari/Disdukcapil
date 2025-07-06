<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Disdukcapil Donggala - Layanan Digital'
        ];
        return view('home/index', $data);
    }
}
