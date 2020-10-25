<?php

namespace App\Repositories;

/**
 * Class VoluntariosCertificadosRepository.
 */
class VoluntariosCertificadosRepository 
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
            // ->join('tbwbEvaluacionAlVoluntario', 'tbwbEvaluacionAlVoluntario.CodigoReferencia', 'tbwbVoluntario.id');
            // ->with('departamento')
            // ->with('unidad')
            ->has('evaluacion');
            // ->with('tipo_practica');
            // ->orderBy('id', 'DESC');
            // ->whereNotNull('evaluacion');

        $query = $this->filterExists($query, $filters);

        return $query;
    }

}
