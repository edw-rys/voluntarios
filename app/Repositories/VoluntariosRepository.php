<?php

namespace App\Repositories;

/**
 * Class VoluntariosRepository.
 */
class VoluntariosRepository 
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
        $this->model = app(\App\Models\Voluntarios::class);
    }

    /**
     * DataTable Query
     *
     * @param array $filters
     * @return mixed
     */
    public function dataTables(array $filters = [])
    {
        $query = $this->newQuery()
            ->select(['*'])
            ->with('unidad')
            ->with('departamento')
            ->with('universidad')
            ->with('evaluacion')
            ->with('pasatiempo')
            ->with('tipo_practica')
            ->with('periodos')
            ->with('periodos.evaluacion')
            ->with('unidad');

        $query = $this->filterExists($query, $filters);

        return $query;
    }
    
}
