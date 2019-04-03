<?php
namespace App\Repositories;
use App\Repositories\Contracts\CriteriaInterface;
use Illuminate\Container\Container as App;
use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\Criteria\AbstractCriteria;
use Illuminate\Support\Collection;

Abstract class AbstractRepository implements RepositoryInterface,CriteriaInterface
{

    /**
     * @var
     */
    protected $model;

    /**
     * @var App
     */
    private $app;
    /**
     * @var Collection
     */
    protected $criteria;

    /**
     * Repository constructor.
     * @param App $app
     * @throws RepositoryException
     */
    public function __construct(App $app,Collection $collection)
    {
        $this->app = $app;
        $this->criteria = $collection;
        $this->resetScope();
        $this->makeModel();
    }

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    abstract public function model();

    /**
     * @param array $columns
     *
     * @return mixed
     */
    public function all($columns = ['*'])
    {
        $this->applyCriteria();
        return $this->model->get($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     *
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = ['*'])
    {
        $this->applyCriteria();
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**+
     * @param array $data
     * @param $id
     * @param string $attribute
     *
     * @return mixed
     */
    public function update(array $data, $id, $attribute = 'id')
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        return $this->model->find($id)->delete();
    }

    /**
     * @param $id
     * @param array $columns
     *
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     *
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = ['*'])
    {
        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    /**
     * @throws RepositoryException
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());
//
//        if (!$model instanceof Model) {
////            throw new ModelNotFoundException("{$this->model()} not found ");
////            by ID " . $user_id
////            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
//        }

        return $this->model = $model->newQuery();
    }
    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function getByCriteria(AbstractCriteria $criteria) {
        $this->model = $criteria->apply($this->model, $this);
        return $this;
    }

    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function pushCriteria(AbstractCriteria $criteria) {
        $this->criteria->push($criteria);
        return $this;
    }
    /**
     * @return $this
     */
    public function resetScope() {
        $this->skipCriteria(false);
        return $this;
    }

    /**
     * @param bool $status
     * @return $this
     */
    public function skipCriteria($status = true){
        $this->skipCriteria = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCriteria() {
        return $this->criteria;
    }

    public function  applyCriteria() {

        if($this->skipCriteria === true)
            return $this;

        foreach($this->getCriteria() as $criteria) {
            if($criteria instanceof AbstractCriteria)
                $this->model = $criteria->apply($this->model, $this);
        }

        return $this;
    }
}