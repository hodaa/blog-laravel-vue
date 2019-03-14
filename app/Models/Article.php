<?php
namespace  App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends  Model
{

    protected $fillable=['title','category_id','content','author'];

    public function  category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * get only published articles
     * @param $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('published', 1);
    }


}