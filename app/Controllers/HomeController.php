<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Post;
use App\Models\SubCategory;

class HomeController extends BaseController
{
    protected $helpers = ['url', 'form', ' CIMail', 'CIFunctions', 'text'];

    public function index()
    {
        $data = [
            'pageTitle' => get_settings()->blog_title,
            'hero' => [
                'title' => 'Masa Depan Pertanian Modern dan Berkelanjutan',
                'description' => 'Temukan tips, teknologi, dan informasi terbaru seputar pertanian modern, organik, dan smart farming untuk meningkatkan hasil panen Anda.'
            ]
        ];
        return view('frontend/pages/home', $data);
        
        // $data = [
        //     'title' => 'FredianFarm - Blog Pertanian Modern',
        //     'articles' => $articleModel->getLatestArticles(3),
        //     'testimonials' => $testimonialModel->getTestimonials(),
        //     'hero' => [
        //         'title' => 'Masa Depan Pertanian Modern dan Berkelanjutan',
        //         'description' => 'Temukan tips, teknologi, dan informasi terbaru seputar pertanian modern, organik, dan smart farming untuk meningkatkan hasil panen Anda.'
        //     ]
        // ];
    }
}