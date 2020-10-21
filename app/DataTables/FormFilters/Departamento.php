<?php

namespace App\DataTables\FormFilters;

use App\Repositories\DepartamentoRepository;

class Departamento extends FormFilter
{
    /**
     *
     * @param $repository
     * @param bool $ajax
     * @return string
     */
    public function departamento($repository, $ajax = false): string
    {
        $method = __FUNCTION__;

        $html   = '<div class="form-group mr-3">' .
            '<label for="' . $method . '" class="mr-2 d-block">' . trans('global.voluntario.department') . '</label>';

        if ($ajax) {
            // $html .= '<select name="' . $method . '" id="' . $method . '" class="form-control select2" data-placeholder="' . trans('global.pleaseSelect') . '" data-ajax--url="' . route('api.users.ajax') . '" data-ajax--cache="true">' .
            //     '<option></option>';
        } else {
            $options    = (new DepartamentoRepository())->actives();
            $html       .= '<select name="' . $method . '" id="' . $method . '" class="form-control select2" data-placeholder="' . trans('global.pleaseSelect') . '">' .
                '<option></option>';

            if ($options->isNotEmpty()) {
                foreach ($options as $key => $item) {
                    $selected   = (old($method) !== null && (int) old($method) === $item->id) ? ' selected' : '';
                    $html       .= '<option value="' . $item->id . '" ' . $selected . '>' . $item->Nombre . '</option>';
                }
            }
        }

        $html .= '</select>' .
            '</div>';

        return $html;
    }
}