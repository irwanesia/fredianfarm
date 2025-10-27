<?php

use App\Libraries\CiAuth;
use App\Models\User;
use App\Models\Settings;
use App\Models\SocialMedia;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Post;
use Carbon\Carbon;

// app/Helpers/navigation_helper.php
if (!function_exists('is_active_menu')) {
    function is_active_menu($url) {
        $current_uri = current_url();
        
        // Untuk home page
        if ($url == '/' && $current_uri == base_url('/')) {
            return 'active';
        }
        
        // Untuk halaman lainnya
        if ($url != '/' && strpos($current_uri, $url) !== false) {
            return 'active';
        }
        
        return '';
    }
}

// function_exists memeriksa apakah fungsi dengan nama tertentu sudah didefinisikan. Ini berguna untuk menghindari redefinisi fungsi yang dapat menyebabkan error
if (!function_exists('get_user')) {
    //     Fungsi get_user() dalam helper ini memeriksa apakah pengguna saat ini telah masuk (CiAuth::check()). Jika ya, maka ia mengambil data pengguna dari model User berdasarkan ID pengguna yang sedang masuk (CiAuth::id()). Jika tidak, ia mengembalikan null.

    // Dengan memuat helper ini melalui properti $helpers di controller, Anda dapat memanggil fungsi get_user() di mana saja dalam controller tersebut tanpa harus memuatnya secara manual setiap kali.
    function get_user()
    {
        if (CiAuth::check()) {
            $user = new User();
            // asObject(), hasil query akan dikembalikan sebagai objek stdClass. Ini bisa berguna jika Anda lebih suka bekerja dengan objek daripada array.
            return $user->asObject()->where('id', CiAuth::id())->first();
        } else {
            return null;
        }
    }
}

if (!function_exists('get_settings')) {
    function get_settings()
    {
        $settings = new Settings();
        // asObject(), hasil query akan dikembalikan sebagai objek stdClass. Ini bisa berguna jika Anda lebih suka bekerja dengan objek daripada array.
        $settings_data = $settings->asObject()->first();

        // jika tidak ada data setting di database
        if (!$settings_data) {
            $data = array(
                'blog_title' => 'CI4Blog',
                'blog_email' => 'info@wisata-dieng.com',
                'blog_phone' => null,
                'blog_meta_keywords' => null,
                'blog_meta_description' => null,
                'blog_logo' => null,
                'blog_favicon' => null,
            );
            $settings->save($data);
            $new_setting_data = $settings->asObject()->first();
            return $new_setting_data;
        } else {
            return $settings_data;
        }
    }
}

if (!function_exists('get_social_media')) {
    function get_social_media()
    {
        $social_media = new SocialMedia();
        // asObject(), hasil query akan dikembalikan sebagai objek stdClass. Ini bisa berguna jika Anda lebih suka bekerja dengan objek daripada array.
        $social_media_data = $social_media->asObject()->first();

        // jika tidak ada data setting di database
        if (!$social_media_data) {
            $data = array(
                'facebook_url' => null,
                'twitter_url' => null,
                'instagram_url' => null,
                'youtube_url' => null,
                'github_url' => null,
                'linkedin_url' => null,
            );
            $social_media->save($data);
            $new_social_media_data = $social_media->asObject()->first();
            $result = $new_social_media_data;
        } else {
            $result = $social_media_data;
        }
        return $result;
    }
}

if (!function_exists('current_route_name')) {
    function current_route_name()
    {
        $router = \Config\Services::router();
        $route_name = $router->getMatchedRouteOptions()['as'];
        return $route_name;
    }
}


/**
 * FRONTEND FUNCTIONS
 */

if (!function_exists('get_parent_categories')) {
    function get_parent_categories()
    {
        $category = new Category();
        return $category->asObject()->orderBy('ordering', 'asc')->findAll();
    }
}

if (!function_exists('get_subcategories_by_parent_category_id')) {
    function get_subcategories_by_parent_category_id($id)
    {
        $subcategory = new subCategory();
        return $subcategory->asObject()
            ->orderBy('ordering', 'asc')
            ->where('parent_cat', $id)
            ->findAll();
    }
}

if (!function_exists('get_dependent_subcategories')) {
    function get_dependent_subcategories()
    {
        $subcategory = new subCategory();
        return $subcategory->asObject()
            ->orderBy('ordering', 'asc')
            ->where('parent_cat', 0)
            ->findAll();
    }
}

/** date format eg: JAN 12, 2024 */
if (!function_exists('date_formatter')) {
    function date_formatter($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->isoFormat('ll');
    }
}

/** calculate reading duration */
if (!function_exists('get_reading_time')) {
    function get_reading_time($content)
    {
        $word_count = str_word_count(strip_tags($content));
        $word_per_minute = 200;
        $m = ceil($word_count / $word_per_minute);
        return $m <= 1 ? $m . ' Min read' : $m . ' Mins read';
    }
}

/** limit words */
if (!function_exists('limit_words')) {
    function limit_words($content = null, $limit = 20)
    {
        return word_limiter($content, $limit);
    }
}


/** get home main latest post */
if (!function_exists('get_home_main_latest_post')) {
    function get_home_main_latest_post()
    {
        $post = new Post();
        return $post->asObject()
            ->where('visibility', 1)
            ->orderBy('created_at', 'desc')
            ->first();
    }
}

/** get 6 home latest post */
if (!function_exists('get_3_home_latest_posts')) {
    function get_3_home_latest_posts()
    {
        $post = new Post();
        return $post->asObject()
            ->where('visibility', 1)
            ->limit(3, 1)
            ->orderBy('created_at', 'desc')
            ->get()
            ->getResult();
    }
}

/** get_sidebar_random_posts */
if (!function_exists('get_sidebar_random_posts')) {
    function get_sidebar_random_posts($max = 4)
    {
        $post = new Post();
        return $post->asObject()
            ->where('visibility', 1)
            ->limit($max)
            ->orderBy('rand()')
            ->get()
            ->getResult();
    }
}



/** sidebar categories */
if (!function_exists('get_categories')) {
    function get_categories()
    {
        $db = \Config\Database::connect();
        
        return $db->table('categories c')
            ->select('c.id, c.name, s.slug')
            ->join('sub_categories s', 's.parent_cat = c.id', 'left')
            ->groupBy('c.id') // Group by category untuk hindari duplikat
            ->orderBy('c.name', 'asc')
            ->get()
            ->getResult();
    }
}

if (!function_exists('get_sidebar_categories')) {
    function get_sidebar_categories()
    {
        $subcat = new SubCategory();
        return $subcat->asObject()
            ->orderBy('name', 'asc')
            ->findAll();
    }
}

/** count post by category id */
if (!function_exists('posts_by_category_id')) {
    function posts_by_category_id($id)
    {
        $post = new Post();
        $posts = $post->where('visibility', 1)
            ->where('category_id', $id)
            ->findAll();

        return count($posts);
    }
}

/** sidebar latest posts */
if (!function_exists('sidebar_latest_posts')) {
    function sidebar_latest_posts($except = null)
    {
        $post = new Post();
        return $post->where('visibility', 1)
            ->where('id !=', $except)
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get()
            ->getResult();
    }
}

/** All tags from posts table */
if (!function_exists('get_tags')) {
    function get_tags()
    {
        $post = new Post();
        $tagsArray = [];
        $posts = $post->asObject()->where('visibility', 1)
            ->where('tags !=', '')
            ->orderBy('created_at', 'desc')
            ->findAll();

        foreach ($posts as $post) {
            array_push($tagsArray, $post->tags);
        }

        $tagsList = implode(',', $tagsArray);
        return array_unique(array_map('trim', array_filter(explode(',', $tagsList), 'trim')));
    }
}

/** get tags by post id */
if (!function_exists('get_tags_by_post_id')) {
    function get_tags_by_post_id($id)
    {
        $post = new Post();
        $tags = $post->asObject()->find($id)->tags;
        return $tags != '' ? explode(',', $tags) : [];
    }
}
