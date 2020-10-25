<?php

namespace App\Repositories;

/**
 * Class PeriodoVoluntarioRepository.
 */
class PeriodoVoluntarioRepository 
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
        $this->model = app(\App\Models\PeriodoVoluntario::class);
    }
}
