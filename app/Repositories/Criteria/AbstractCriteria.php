<?php
namespace App\Repositories\Criteria;

abstract class AbstractCriteria{

    public abstract function apply($model);
}