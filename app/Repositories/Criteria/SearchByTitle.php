<?php

namespace  App\Repositories\Criteria;
/**
 * Class SearchByTitle
 * @package App\Repositories\Criteria
 */
class SearchByTitle extends AbstractCriteria
{
    private $query;

    /**
     * SearchByTitle constructor.
     * @param $query
     */
    public function __construct($query)
    {
        $this->query = $query;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function apply($model)
    {
         return $model->where('title', 'like', '%'.$this->query.'%');
    }
}
