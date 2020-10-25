<?php

namespace App\Repositories;

/**
 * Class HorarioVoluntarioRepository.
 */
class HorarioVoluntarioRepository
{
    /**
     * The model being queried.
     *
     * @var Model
     */
    protected $model;

    use BaseRepository;
    /**
     * @return string
     *  Return the model
     */
    public function __construct()
    {
        $this->model = app(\App\Models\HorarioVoluntario::class);
    }
}
