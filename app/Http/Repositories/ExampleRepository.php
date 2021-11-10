<?php

namespace App\Http\Repositories;

use App\Models\Example;

class ExampleRepository extends Repository
{
    /**
     * Current model directory
     *
     * @var string $model
     */
    protected string $model = Example::class;

}
