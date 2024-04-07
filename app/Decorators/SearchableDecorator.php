<?php

namespace App\Decorators;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Pagination\LengthAwarePaginator;

use App\Decorators\Decorator;

class SearchableDecorator extends Decorator
{
    public $model;
    public $searchable;
    public $paginate = 10;

    public function __construct($model)
    {
        parent::__construct($model);

        // assert "searchable"
        assert(property_exists($model, 'searchable'), 'Model must have searchable property');
        $this->searchable = $model::$searchable;
    }

    /**
     * @param string $query
     * @return LengthAwarePaginator
     */
    public function search($query)
    {
        return $this->model::where(function ($queryBuilder) use ($query) {
            foreach ($this->searchable as $field) {
                $queryBuilder->orWhere($field, 'like', "%$query%");
            }
        })->paginate($this->paginate);
    }

}