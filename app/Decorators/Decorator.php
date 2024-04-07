<?php

namespace App\Decorators;


use Illuminate\Database\Eloquent\Model;

/**
 * @template T of Model
 */

class Decorator
{
    public $model;

    public function __construct($model)
    {
        $this->model = $model;
        assert(is_subclass_of($model, Model::class), 'Model must be instance of Illuminate\Database\Eloquent\Model');

    }
}