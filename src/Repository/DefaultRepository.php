<?php
declare(strict_types=1);
namespace SONFin\Repository;


class DefaultRepository implements RepositoryInterface
{
    /**
     * @var string
     */
    private $_modelClass;

    private $_model;

    public function __construct(string $modelClass)
    {
        $this->_modelClass = $modelClass;
        $this->_model = new $modelClass;
    }

    public function all(): array
    {
        return $this->_model->all()->toArray();
    }

    public function find(int $id, bool $failIfNotExist = true)
    {
        return $failIfNotExist ? $this->_model->findOrfail($id) : $this->_model->find($id);
    }

    public function create(array $data)
    {
        $this->_model->fill($data);
        $this->_model->save();
        return $this->_model;
    }

    public function update($id, array $data)
    {
        $model = $this->findInternal($id);
        $model->fill($data);
        $model->save();
        return $model;
    }

    public function delete($id)
    {
        $model = $this->findInternal($id);
        $model->delete();
    }

    protected function findInternal($id)
    {
        return is_array($id) ? $this->findOneBy($id) : $this->find((int) $id);
    }

    public function findByField(string $field, $value)
    {
        return $this->_model->where($field, '=', $value)->get();
    }

    public function findOneBy(array $search)
    {
        $queryBuilder = $this->_model;
        foreach ($search as $field => $value){
            $queryBuilder = $queryBuilder->where($field, '=', $value);
        }

        return $queryBuilder->firstOrFail();
    }
}