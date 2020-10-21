<?php

namespace App\DataTables\FormFilters;

class Status extends FormFilter
{
    /**
     *
     * @param $repository
     * @return string
     */
    public function status($repository): string
    {
        $method = __FUNCTION__;

        $options = $repository->statuses();

        $html = '<div class="form-group mr-3">' .
            '<label for="' . $method . '" class="mr-2 d-block">' . trans('global.status') . '</label>' .
            '<select name="' . $method . '" id="' . $method . '" class="form-control select2" data-placeholder="' . trans('global.pleaseSelect') . '" style="width:100%">' .
            '<option></option>';

        foreach ($options as $key => $status) {
            $selected = (old($method) !== null && (int) old($method) === $key) ? ' selected' : '';
            $statusValue = $status->status ?? $status->active;

            // Status not exist
            if (! array_key_exists($statusValue, allStatuses())) {
                $statusValue = '1';
            }

            $html .= '<option value="' . $statusValue . '" ' . $selected . '>' . allStatuses()[$statusValue] . '</option>';
            // $html .= '<option value="' . $statusValue . '" ' . $selected . '>' . $statusValue . '</option>';
        }

        $html .= '</select>' .
            '</div>';
        return $html;
    }
}