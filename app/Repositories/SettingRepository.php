<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SettingRepository.
 */
class SettingRepository 
{
    use BaseRepository;

    /**
     * The model being queried.
     *
     * @var Model
     */
    protected $model;

    
    /**
     * @return string
     *  Return the model
     */
    public function __construct()
    {
        $this->model = app(\App\Models\Setting::class);
    }

    public function getSettingBy($group_id, $types_id)
    {
        return $this
            ->with('types')
            ->where('group_id', '=', $group_id)
            ->where('status', '=', 'active')
            ->orderByRaw(DB::raw('FIELD(setting_type_id, ' . $types_id . ')'))
            ->get();
    }
}
