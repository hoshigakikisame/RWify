<?php

namespace App\Decorators;

use \Illuminate\Pagination\LengthAwarePaginator;

use App\Decorators\Decorator;
use \Illuminate\Database\Eloquent\Builder;

class SearchableDecorator extends Decorator
{
    public $searchable;
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
    public function search($query, $paginate = 5, array $relations = [], array $filter = []): LengthAwarePaginator
    {
        if ($paginate == null) $paginate = 5;

        return $this->model::where(function(Builder $queryBuilder) use ($filter) {
            foreach ($filter as $field => $value) {
                if ($value == null || empty($value)) continue;
                $queryBuilder->where($field, $value);
            }
        })->where(function (Builder $queryBuilder) use ($relations, $query) {

            foreach ($relations as $relation => $model) {
                foreach ($model::$searchable as $field) {
                    $queryBuilder->orWhereRelation($relation, $field, 'LIKE', "%$query%");
                }
            }

            foreach ($this->searchable as $field) {
                $queryBuilder->orWhere($field, 'LIKE', "%$query%");
            }
            
        })->orderBy($this->model::CREATED_AT, 'DESC')->paginate($paginate);
    }
}
