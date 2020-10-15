<?php

namespace App\DataTables\FormFilters;

use Illuminate\Support\Collection;

class FormFilter
{
    /**
     * Filters Search Form
     *
     * @param array $filters
     * @param $repository
     * @return Collection
     */
    public function filters(array $filters, $repository): Collection
    {
        $html_filters = [];

        if (count($filters) > 0) {
            foreach ($filters as $filter) {
                $filterClassName = convertToCamelCase($filter);

                $name = __NAMESPACE__ . '\\' . $filterClassName;

                if (! class_exists($name)) {
                    continue;
                }

                $filterClass = new $name();

                if (! is_callable([$filterClass, $filter])) {
                    continue;
                }

                $html_filters[$filter] = $filterClass->$filter($repository);
            }
        }

        return collect($html_filters);
    }
}
