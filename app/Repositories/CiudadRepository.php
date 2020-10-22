<?php

namespace App\Repositories;

/**
 * Class CiudadRepository.
 */
class CiudadRepository 
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
        $this->model = app(\App\Models\Ciudad::class);
    }
}
