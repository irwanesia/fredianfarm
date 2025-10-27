<?php

namespace App\Models;

use CodeIgniter\Model;

class Post extends Model
{
    protected $table            = 'posts';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'author_id',
        'category_id',
        'title',
        'slug',
        'content',
        'featured_image',
        'tags',
        'meta_keywords',
        'meta_description',
        'visibility',
    ];


    // query builder post join with category
    public function getPostsWithCategory($category_id, $dataPerpage = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('posts.*, s.name as subcategory_name, c.name as category_name');
        $builder->join('sub_categories s', 's.id = posts.category_id', 'left');
        $builder->join('categories c', 'c.id = s.parent_cat', 'left');
        $builder->where('posts.visibility', 1);
        $builder->where('c.id', $category_id); // Filter by category ID
        $builder->orderBy('posts.created_at', 'DESC');
        if ($dataPerpage !== null) {
            $builder->limit($dataPerpage);
        }
        
        return $builder->get()->getResult();
    }
    
    // get total count posts by category
    public function countPostsByCategory($category_id)
    {
        $builder = $this->db->table($this->table);
        $builder->select('COUNT(posts.id) as total');
        $builder->join('sub_categories s', 's.id = posts.category_id', 'left');
        $builder->join('categories c', 'c.id = s.parent_cat', 'left');
        $builder->where('posts.visibility', 1);
        $builder->where('c.id', $category_id); // Filter by category ID
        $query = $builder->get();
        $result = $query->getRow();
        return $result ? $result->total : 0;
    }

    // Total count
        // $data['total'] = $db->table('posts p')
        //                 ->join('subcategories s', 's.id = p.category_id', 'left')
        //                 ->join('categories c', 'c.id = s.category_id', 'left')
        //                 ->where('p.visibility', 1)
        //                 ->where('c.id', $category_id)
        //                 ->countAllResults();

}
