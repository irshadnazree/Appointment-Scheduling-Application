<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'category';

    protected $primaryKey = 'categoryID'; 

    protected $allowedFields = ['categoryName'];

    public function getCategoryList()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('category');
        return $builder->get()->getResultArray();
    }
}