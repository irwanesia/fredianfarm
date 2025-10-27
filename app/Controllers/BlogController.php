<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\Category;

class BlogController extends BaseController
{
    protected $helpers = ['url', 'form', ' CIMail', 'CIFunctions', 'text'];

    public function index()
    {
        $post = new Post();
        
        $data = [];
        $data['pageTitle'] = get_settings()->blog_title;
        $data['page'] = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $data['perPage'] = 6;
        
        // HITUNG TOTAL SEMUA POST (tanpa filter kategori)
        $data['total'] = $post->where('visibility', 1)->countAllResults();
        
        // AMBIL DATA POST DENGAN PAGINATION (tanpa filter kategori)
        $data['posts'] = $post->asObject()
                            ->where('visibility', 1)
                            ->orderBy('created_at', 'DESC') // Optional: urutkan dari terbaru
                            ->paginate($data['perPage']);
        
        // PAGER (tanpa filter kategori)
        $data['pager'] = $post->pager;
        
        return view('frontend/pages/blog', $data);
    }

    public function detail()
    {
        $data = [
            'pageTitle' => get_settings()->blog_title
        ];
        return view('frontend/pages/blog-detail', $data);
    }

    public function artikel()
    {
        $data = [
            'pageTitle' => get_settings()->blog_title
        ];
        return view('frontend/pages/artikel', $data);
    }

    // public function categoryPosts($category_slug)
    // {
    //     $subcat = new SubCategory();
    //     $subcategory = $subcat->asObject()->where('slug', $category_slug)->first();
    //     $post = new Post();

    //     $data = [];
    //     $data['pageTitle'] = 'Category : ' . $subcategory->name;
    //     $data['category'] = $subcategory;
    //     $data['page'] = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    //     $data['perPage'] = 6;
    //     $data['total'] = count($post->where('visibility', 1)->where('category_id', $subcategory->id)->findAll());
    //     $data['posts'] = $post->asObject()->where('visibility', 1)->where('category_id', $subcategory->id)->paginate($data['perPage']);
    //     $data['pager'] = $post->where('visibility', 1)->where('category_id', $subcategory->id)->pager;

    //     return view('frontend/pages/category-posts', $data);
    // }

    public function categoryPosts($category_id)
    {
        $cat = new Category();
        $category = $cat->asObject()->where('id', $category_id)->first();
        
        if (!$category) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        
        $post = new Post();
        // $db = \Config\Database::connect();

        $data = [];
        $data['pageTitle'] = 'Category : ' . $category->name;
        $data['category'] = $category;
        $data['category_name'] = $category->name;
        $data['category_id'] = $category_id;
        $data['page'] = $this->request->getGet('page') ?? 1;
        $data['perPage'] = 6;
        
        // Query dengan JOIN ke subcategories dan categories
        $data['posts'] = $post->getPostsWithCategory($category_id, $data['perPage']);
        
        
        // Total count
        $data['total'] = $post->countPostsByCategory($category_id);
        
        $data['pager'] = $post->pager;

        return view('frontend/pages/category-posts', $data);
    }

    public function tagPosts($tag)
    {
        $post = new Post();
        $data = [];
        $data['pageTitle'] = 'Tag: ' . $tag;
        $data['tag'] = $tag;
        $data['page'] = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $data['perPage'] = 6;
        $data['total'] = count($post->where('visibility', 1)->like('tags', '%' . $tag . '%')->findAll());
        $data['posts'] = $post->asObject()
            ->where('visibility', 1)
            ->like('tags', '%' . $tag . '%')
            ->orderBy('created_at', 'desc')
            ->paginate($data['perPage']);
        $data['pager'] = $post->where('visibility', 1)->like('tags', '%' . $tag . '%')->pager;

        return view('frontend/pages/tag-posts', $data);
    }

    public function searchPosts()
    {
        $request = \Config\Services::request();
        $search = $request->getGet('q') ?? '';
        $page = $request->getGet('page') ?? 1;
        $perPage = 6;

        // Jika search kosong, redirect kembali ke blog
        if (empty($search)) {
            return redirect()->route('blog');
        }

        $post = new Post();
        
        // Search logic
        $keywords = explode(" ", trim($search));
        $post = $this->getSearchData($post, $keywords);
        
        $paginated_data = $post->asObject()
                            ->where('visibility', 1)
                            ->orderBy('created_at', 'DESC')
                            ->paginate($perPage);
                            
        $total = $post->where('visibility', 1)->countAllResults();
        $pager = $post->pager;

        $data = [
            'pageTitle' => 'Search for: ' . $search,
            'posts' => $paginated_data,
            'pager' => $pager,
            'page' => $page,
            'perPage' => $perPage,
            'search' => $search,
            'total' => $total
        ];

        return view('frontend/pages/search-posts', $data);
    }

    public function getSearchData($object, $keywords)
    {
        $object->select('*');
        $object->groupStart();
        foreach ($keywords as $keyword) {
            $object->orLike('title', $keyword)
                ->orLike('tags', $keyword);
        }
        return $object->groupEnd();
    }

    // Jika method getSearchData belum ada di controller
    // private function getSearchData($post, $keywords)
    // {
    //     foreach ($keywords as $keyword) {
    //         $post->groupStart()
    //             ->like('title', $keyword)
    //             ->orLike('content', $keyword)
    //             ->orLike('excerpt', $keyword)
    //             ->groupEnd();
    //     }
    //     return $post;
    // }

    public function readPost($slug)
    {
        $post = new Post();
        try {
            $post = $post->asObject()->where('slug', $slug)->first();
            $data = [
                'pageTitle' => $post->title,
                'post' => $post
            ];
            return view('frontend/pages/blog-detail', $data);
        } catch (\Exception $e) {
            throw $e->getMessage();
        }
    }
}
