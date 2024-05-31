<?php

namespace App\Decorators;

use \Illuminate\Pagination\LengthAwarePaginator;

use App\Decorators\Decorator;
use App\Interfaces\SearchCompatible;
use \Illuminate\Database\Eloquent\Builder;

class SearchableDecorator extends Decorator
{
    public $model;

    public function __construct($model)
    {
        parent::__construct($model);

        // make sure model implements SearchCompatible interface
        assert(in_array(SearchCompatible::class, class_implements($model)), 'Model must implement SearchCompatible interface');
    }

    /**
     * @param string $query
     * @return LengthAwarePaginator
     */
    public function search($query, $paginate = 5, array $relations = [], array $filter = [], callable $queryBuilderCb = null): LengthAwarePaginator
    {
        if ($paginate == null) $paginate = 5;

        return $this->model::where(function (Builder $queryBuilder) use ($filter) {

            foreach ($filter as $field => $value) {
                if ($value == null || empty ($value))
                    continue;

                if (!in_array($field, $this->model::filterable())) {
                    if (config('app.env') == 'local') throw new \Exception("Field $field is not filterable");
                    continue;
                }

                $queryBuilder->where($field, $value);
            }

        })->where(function (Builder $queryBuilder) use ($relations, $query) {

            foreach ($relations as $relation => $model) {
                foreach ($model::searchable() as $field) {
                    $queryBuilder->orWhereRelation($relation, $field, 'LIKE', "%$query%");
                }
            }

            foreach ($this->model::searchable() as $field) {
                $queryBuilder->orWhere($field, 'LIKE', "%$query%");
            }

            // dd($queryBuilder->toRawSql());

        })->where(function (Builder $queryBuilder) use ($queryBuilderCb) {
            if ($queryBuilderCb != null) {
                $queryBuilderCb($queryBuilder);
            }
        })->orderBy($this->model::CREATED_AT, 'DESC')->paginate($paginate);
    }
}
