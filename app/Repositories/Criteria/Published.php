<?php


namespace  App\Repositories\Criteria;
/**
 * Class Published
 * @package App\Repositories\Criteria
 */
class Published extends AbstractCriteria
{
    /**
     * @param $model
     * @return mixed
     */
    public function apply($model)
    {
        return $model->where('published', 1);
    }
}
