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
        if(!allows_permission('all_voluntarios')){
            $query = $query->where('idtutor', auth()->user()->id);
        }
        
            // ->orderBy('id');

        $query = $this->filterExists($query, $filters);

        return $query;
    }
    

    /**
     * 
     */
    public function obtenerVoluntarioPediodoActivo($id, $decoded = true, $periodo_id = null)
    {
        $voluntario = null;
        $voluntario = $this->with('departamento')
            ->with('unidad')
            ->with('pais_detalle')
            ->with('ciudad_detalle')
            ->with('genero_detalle')
            ->with('universidad')
            ->with('evaluacion')
            ->with('alimentacion')
            ->with('tipo_practica')
            ->with('tutor_bspi')
            ->with('pasatiempo');
        if($decoded){
            $voluntario = $this->findDecoded($id, ['*']);
        }else{
            $voluntario = $this->find($id, ['*']);
        }
        if($voluntario === null){
            return null;
        }

        $periodo = (new PeriodoVoluntarioRepository)
            ->where('voluntario_id', $voluntario->id)
            ->with('departamento')
            ->with('unidad')
            ->with('universidad')
            ->with('tipo_practica')
            ->with('alimentacion')
            ->with('horario_semana')
            ->with('tutor_bspi');

        if( $periodo_id != null ){
            $periodo = $periodo->where('id',$periodo_id );
        }
        $periodo = $periodo->get()
            ->last();
        if($periodo === null){
            $periodo = (object) [
                'id'                    => 0,
                'universidad_id'        => $voluntario->Universidad,
                'facultad_id'           => $voluntario->Facultad,
                'carrera'               => $voluntario->Carrera,
                'nivel'                 => $voluntario->Nivel,
                'tutor'                 => $voluntario->Tutor,
                'unidad_id'             => $voluntario->Unidad,
                'departamento_id'       => $voluntario->Departamento,
                'proyecto'              => $voluntario->Proyecto,
                'tutor_bspi_id'         => $voluntario->idtutor,
                // 'tutor_bspi_id'         => $voluntario->TutorBspi,
                'fecha_inicio'          => $voluntario->FechaInicio,
                'fecha_fin'             => $voluntario->FechaFin,
                'FechaFinCertificado'   => $voluntario->FechaFin,
                'horas_programada'      => $voluntario->HorasProgramada,
                'alimentacion_id'       => $voluntario->Alimentacion,
                'tutor_bspi_nombre'     => $voluntario->Tutor,
                'horario_voluntario_id' => $voluntario->Horario,
                'horario'               => $voluntario->Horario,
                'chkActa'               => $voluntario->chkActa, 
                'tipo_practica_id'      => $voluntario->tipoPractica,
                'observacion'           => $voluntario->observacion ,
                'departamento'          => $voluntario->departamento ,
                'universidad'           => $voluntario->universidad ,
                'tipo_practica'         => $voluntario->tipo_practica ,
                'alimentacion'          => $voluntario->alimentacion ,
                'facultad'              => $voluntario->facultad ,
                'unidad'                => $voluntario->unidad ,
                'tutor_bspi'            => $voluntario->tutor_bspi ,
                'horario_semana'        => (object) [
                    'id'              => 0,
                    'lunes_data'      => '[]',
                    'martes_data'     => '[]',
                    'miercoles_data'  => '[]',
                    'viernes_data'    => '[]',
                    'jueves_data'     => '[]',
                    'sabado_data'     => '[]',
                    'domingo_data'    => '[]',
                ]       
            ];
        }
        $voluntario->periodo = $periodo;
        return $voluntario;
    }
}
