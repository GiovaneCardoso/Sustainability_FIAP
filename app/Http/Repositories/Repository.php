<?php

namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    /**
     * Current model directory
     * This var is defined by inheritance.
     *
     * @var string $model
     */
    protected string $model;

    /**
     * Current model instance
     *
     * @var Model $instance
     */
    private Model $instance;


    /**
     * A contructor method
     *
     * @return void
     */
    public function __construct()
    {
        $this->instance = $this->resolve();
    }

    /**
     * Resolve a instance
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    private function resolve()
    {
        return app($this->model);
    }

    /**
     * Create a new queryBuilder instace
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return $this->instance->newQuery();
    }

    /**
     * Structure a new query with pagination
     * but pagination is not required
     *
     * @param int $take
     * @param bool $paginate
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection
     */
    public function makeQuery(
        $query = null,
        int $take = 12,
        bool $paginate = true
    )
    {
        if (null === $query) {
            $query = $this->query();
        }

        if (true === $paginate) {
            return $query->paginate($take);
        }

        if ($take && $take > 0) {
            $query->take($take);
        }

        return $query->get();
    }

    /**
     * Return all records from current model
     *
     * @param int $take
     * @param bool $paginate
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator|\Illuminate\Support\Collection
     */
    public function getAll(int $take = 12, bool $paginate = true)
    {
        return $this->makeQuery(null, $take, $paginate);
    }

    /**
     * Retrieves a record by his id
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findById(string $id): ?\Illuminate\Database\Eloquent\Model
    {
        return $this->query()
            ->find($id);
    }

    /**
     * Retrieves a record by field
     *
     * @param array $fields
     * @param bool $first
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Support\Collection
     */
    public function findByField(array $fields, bool $first = false)
    {
        $query = $this->query()->where(function($q) use ($fields) {
                foreach ($fields as $column => $value) {
                    $q->where($column, $value);
                }
            });

        return $first ? $query->first() : $query->get();
    }

    /**
     * Save new data in database
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        $data = $this->query()
            ->create($data);

        return $data;
    }

    /**
     * Update entity from database
     *
     * @param int $id
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $data)
    {
        $entity = $this->findById($id);
        if ( $entity ) {
            $entity->update($data);

            return $entity;
        }
    }

    /**
     * Delete a entity from database
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $entity = $this->findById($id);
        $entity->delete();
    }
}
