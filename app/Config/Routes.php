<?php

use App\Controllers\AdminController;
use App\Controllers\AuthController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');
$routes->get('/articles', 'Articles::index');
$routes->get('/articles/(:segment)', 'Articles::detail/$1');
$routes->get('/categories', 'Categories::index');
$routes->get('/guides', 'Guides::index');
$routes->get('/about', 'AboutController::index');
$routes->get('/service', 'ServiceController::index');
$routes->get('/product', 'ProductController::index');
$routes->get('/feature', 'FeaturesController::index');
$routes->get('/contact', 'ContactController::index');
$routes->post('/contact/subscribe', 'Contact::subscribe');

// blog routes
$routes->get('/blog', 'BlogController::index');
$routes->get('blog/search', 'BlogController::searchPosts', ['as' => 'search-posts']);
$routes->get('/blog-detail', 'BlogController::detail');
$routes->get('post/(:any)', 'BlogController::readPost/$1', ['as' => 'read-post']);
$routes->get('blog/category/(:any)', 'BlogController::categoryPosts/$1', ['as' => 'category-posts']);
$routes->get('blog/tag/(:any)', 'BlogController::tagPosts/$1', ['as' => 'tag-posts']);

$routes->get('/team', 'TeamController::index');
$routes->get('/testimonial', 'TestimonialController::index');

// ROUTE AUTH - DI LUAR GROUP ADMIN (bisa diakses tanpa prefix admin)
$routes->group('', ['filter' => 'cifilter:guest'], static function ($routes) {
    $routes->get('login', 'AuthController::loginForm', ['as' => 'admin.login.form']);
    $routes->post('login', 'AuthController::loginHandler', ['as' => 'admin.login.handler']);
    $routes->get('forgot-password', 'AuthController::forgotForm', ['as' => 'admin.forgot.form']);
    $routes->post('send-password-reset-link', 'AuthController::sendPasswordResetLink', ['as' => 'send_password_reset_link']);
    $routes->get('password/reset/(:any)', 'AuthController::resetPassword/$1', ['as' => 'admin.reset-password']);
    $routes->post('reset-password-handler/(:any)', 'AuthController::resetPasswordHandler/$1', ['as' => 'reset-password-handler']);
});

// ROUTE ADMIN - HANYA YANG SUDAH LOGIN
$routes->group('admin', ['filter' => 'cifilter:auth'], static function ($routes) {
    $routes->get('home', 'AdminController::index', ['as' => 'admin.home']);
    $routes->get('logout', 'AdminController::logoutHandler', ['as' => 'admin.logout']);
    $routes->get('profile', 'AdminController::profile', ['as' => 'admin.profile']);
    $routes->post('update-personal-details', 'AdminController::updatePersonalDetails', ['as' => 'update-personal-details']);
    $routes->post('change-password', 'AdminController::changePassword', ['as' => 'change-password']);
    $routes->get('settings', 'AdminController::settings', ['as' => 'settings']);
    $routes->post('update-general-settings', 'AdminController::updateGeneralSettings', ['as' => 'update-general-settings']);
    $routes->post('update-blog-logo', 'AdminController::updateBlogLogo', ['as' => 'update-blog-logo']);
    $routes->post('update-blog-favicon', 'AdminController::updateBlogFavicon', ['as' => 'update-blog-favicon']);
    $routes->post('update-social-media', 'AdminController::updateSocialMedia', ['as' => 'update-social-media']);
    $routes->get('categories', 'AdminController::categories', ['as' => 'admin.categories']);
    $routes->post('add-category', 'AdminController::addCategory', ['as' => 'add-category']);
    $routes->get('get-categories', 'AdminController::getCategories', ['as' => 'get-categories']);
    $routes->get('get-category', 'AdminController::getCategory', ['as' => 'get-category']);
    $routes->post('update-category', 'AdminController::updateCategory', ['as' => 'update-category']);
    $routes->get('delete-category', 'AdminController::deleteCategory', ['as' => 'delete-category']);
    $routes->get('get-parent-categories', 'AdminController::getParentCategories', ['as' => 'get-parent-categories']);
    $routes->post('add-subcategory', 'AdminController::addSubCategory', ['as' => 'add-subcategory']);
    $routes->get('get-subcategories', 'AdminController::getSubCategories', ['as' => 'get-subcategories']);
    $routes->get('get-subcategory', 'AdminController::getSubCategory', ['as' => 'get-subcategory']);
    $routes->post('update-subcategory', 'AdminController::updateSubCategory', ['as' => 'update-subcategory']);
    $routes->get('delete-subcategory', 'AdminController::deleteSubCategory', ['as' => 'delete-subcategory']);

    // group post
    $routes->group('posts', static function ($routes) {
        $routes->get('new-post', 'AdminController::addPost', ['as' => 'new-post']);
        $routes->post('create-post', 'AdminController::createPost', ['as' => 'create-post']);
        $routes->get('/', 'AdminController::allPosts', ['as' => 'all-posts']);
        $routes->get('get-posts', 'AdminController::getPosts', ['as' => 'get-posts']);
        $routes->get('edit-post/(:any)', 'AdminController::editPost/$1', ['as' => 'edit-post']);
        $routes->post('update-post', 'AdminController::updatePost', ['as' => 'update-post']);
        $routes->get('delete-post', 'AdminController::deletePost', ['as' => 'delete-post']);
        $routes->get('view-post/(:any)', 'AdminController::viewPost/$1', ['as' => 'view-post']);
        $routes->get('generate-pdf-token', 'PdfTokenController::getToken');
    });
});