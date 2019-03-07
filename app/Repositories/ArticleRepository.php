<?php

namespace App\Repositories;

use App\Models\Article;

class ArticleRepository extends  AbstractRepository
{
    function  model(){

        return Article::class;
    }
}
