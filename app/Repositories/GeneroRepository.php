<?php

namespace App\Repositories;
/**
 * Class GeneroRepository.
 */
class GeneroRepository
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
        $this->model = app(\App\Models\Genero::class);
    }
}
