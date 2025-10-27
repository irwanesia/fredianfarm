<?php

namespace App\Models;

use CodeIgniter\Model;
// use \Mberecall\Sluggable\CI_Slugify;

class SubCategory extends Model
{
    protected $table            = 'sub_categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['name', 'slug', 'parent_cat', 'description', 'ordering'];

    // callbacks
    // protected $beforeInsert = ['setSlug'];
    // protected $beforeUpdate = ['setSlug'];

    // public function setSlug($data)
    // {
    //     $slugify = new CI_Slugify($this);
    //     // 
    //     $data = $slugify->getSlug($data, 'name');
    //     return $data;
    // }
}
