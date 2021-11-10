<?php

namespace App\Http\Services;

use App\Http\Repositories\ExampleRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ExampleService
{
    protected ExampleRepository $repository;

    /**
     * @param ExampleRepository $repository
     */
    public function __construct( ExampleRepository $repository )
    {
        $this->repository = $repository;
    }

    /**
     * @param int $user_id
     * @return LengthAwarePaginator|Collection
     */
    public function allUserExamples( int $user_id ): LengthAwarePaginator|Collection
    {
        return $this->repository->query()->where('user_id', $user_id)->paginate(10);
    }

    /**
     * @param int $id
     * @return Model|null
     */
    public function find( int $id ): ?Model
    {
        /**
         * the logic to find is here
         */
        return $this->repository->findById($id);
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create( array $attributes ): Model
    {
        /**
         * the logic to create is here
         */
        return $this->repository->store($attributes);
    }

    /**
     * @param $list_attributes
     * @return int
     */
    public function store( $list_attributes ): int
    {
        /**+
         * all the logic to insert or update a resource
         */
        foreach ($list_attributes as $attributes){
            $this->create($attributes);
        }

        return 5;
    }
    /**
     * @param int $id
     */
    public function destroy( int $id ): void
    {
        /**
         * all the logic to deleting is here
         */
        $this->repository->delete($id);
    }

    /**
     * @param int $id
     * @param array $all
     * @return Model
     */
    public function update(int $id, array $all): Model
    {
        return $this->repository->update( $id, $all);
    }

}
