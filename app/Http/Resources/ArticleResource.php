<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'category' => $this->category->name,
            'category_id' => $this->category->id,
            'content' => $this->content,
            'author' =>$this->author,
            'comments'=>$this->comments,
            'created_at' =>date_format($this->created_at,'Y-m-d'),
        ];
    }
}
