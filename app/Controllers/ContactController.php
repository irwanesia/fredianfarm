<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ContactController extends BaseController
{
    protected $helpers = ['url', 'form', ' CIMail', 'CIFunctions', 'text'];

    public function index()
    {
        $data = [
            'pageTitle' => get_settings()->blog_title
        ];
        return view('frontend/pages/contact', $data);
    }

    
}
