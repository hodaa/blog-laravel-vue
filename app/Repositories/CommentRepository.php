<?php

namespace App\Repositories;

use App\Models\Comment;

class CommentRepository extends  AbstractRepository
{
    function model()
    {
        return Comment::class;
    }
}
