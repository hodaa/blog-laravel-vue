<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends  AbstractRepository
{
    function model()
    {
       return Category::class;
    }
}
