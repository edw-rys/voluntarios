<?php

namespace App\Repositories;

/**
 * Class EstadoCivilRepository.
 */
class EstadoCivilRepository 
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
        $this->model = app(\App\Models\EstadoCivil::class);
    }
}
