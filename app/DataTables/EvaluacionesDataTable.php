<?php

namespace App\DataTables;

use App\Repositories\VoluntariosRepository;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class EvaluacionesDataTable extends DataTable
{
    use DataTableBase;

    private $action = 'evaluaciones';
    private $route  = 'admin.evaluaciones';
    private $repository;
    public $filters;

    /**
     * VoluntariosDataTable constructor.
     *
     * @param VoluntariosRepository $repository
     */
    public function __construct(VoluntariosRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get query source of dataTable.
     *
     * @return Builder
     */
    public function query(): Builder
    {
        return $this->repository->dataTables($this->filters);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns(): array
    {
        $columnas = [

            Column::make('evaluacion_pdf')->title('Evaluacion Final')->className('text-center'),
            Column::make('status')->title(trans('global.status'))->className('text-center'),
            Column::make('Nombres')->title(trans('global.voluntario.names'))->className('text-center'),
            Column::make('Apellidos')->title(trans('global.voluntario.last_names'))->className('text-center'),
            Column::make('Pasaporte')->title(trans('global.voluntario.identification_number'))->className('text-center'),
            Column::make('Universidad')->title(trans('global.voluntario.university'))->className('text-center'),
            Column::make('Carrera')->title(trans('global.voluntario.carrera'))->className('text-center'),
            Column::make('Unidad')->title(trans('global.voluntario.unity'))->className('text-center'),
            Column::make('Departamento')->title(trans('global.voluntario.department'))->className('text-center'),
            Column::make('TutorBspi')->title(trans('global.voluntario.tutor_bspi'))->className('text-center'),
        ];
         if(allows_permission('editar_voluntarios')){

            array_push($columnas, Column::make('actions')->title(trans('global.actions'))->className('text-center'));
        }
        return $columnas;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): \Yajra\DataTables\Html\Builder
    {
        return $this->getHtml(9, 'desc');
        // return null;
    }

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query): DataTableAbstract
    {
        $action     = $this->action;
        $route      = $this->route;
        $context    = $this;
        // dd();
        return datatables()
            ->eloquent($query)
            ->setRowId('id')
            ->setRowClass(static function ($query) {
                return checkForInactiveText($query->status);
            })
           /* ->editColumn('id', static function ($query) {
                return optimus()->encode($query->id);
            })*/
            ->editColumn('id', static function ($query) {
                return $query->id;
            })

            ->editColumn('Nombres', static function ($query) {
                return $query->Nombres;
            })
            ->editColumn('Apellidos', static function ($query) {
                return $query->Apellidos;
            })
            ->editColumn('Carrera', static function ($query) {
                return $query->carrera !== null ? $query->carrera->Nombre : $query->Carrera;
            })
            ->editColumn('Pasaporte', static function ($query) {
                return $query->Pasaporte;
            })
            ->editColumn('Universidad', static function ($query) {
                return $query->universidad !== null ? $query->universidad->Nombre : $query->Universidad;
            })
            ->editColumn('Unidad', static function ($query) {
                return $query->unidad !== null ? $query->unidad->Nombre : $query->Unidad;
            })
            ->editColumn('Departamento', static function ($query) {
                return $query->departamento !== null ? $query->departamento->Nombre : '';
            })
            ->editColumn('TutorBspi', static function ($query) {
                return $query->TutorBspi;
            })
            ->editColumn('FechaInicio', static function ($query) {
                return $query->FechaInicio;
            })
            ->editColumn('FechaFin', static function ($query) {
                return $query->FechaFin;
            })
            ->editColumn('status', static function ($query) {
                if($query->periodos->first() === null){
                    if($query->evaluacion === null){
                        return status('not_evaluated');
                    }
                    return status('evaluated');
                }
                // SI tiene un periodo activo y no tiene evaluación, se presenta el modal
                if($query->periodos->last()->evaluacion()->first() === null){
                    // dd($query->periodos->last()->evaluacion()->first());
                    return status('not_evaluated');
                }
                return status('evaluated');
                // return status($query->evaluacion === null ? 'not_evaluated' : 'evaluated');
            })
            ->addColumn('actions', static function ($query) {
                if($query->periodos->first() === null){
                    if($query->evaluacion === null){
                        return evaluate_show( 'admin.evaluaciones.evaluate', optimus()->encode($query->id), 'Evaluar');
                }
                    return '';
                }
                // SI tiene un periodo activo y no tiene evaluación, se presenta el modal
                if($query->periodos->last()->evaluacion()->first() === null){
                    return evaluate_show( 'admin.evaluaciones.evaluate', optimus()->encode($query->id), 'Evaluar');
                }
                return  '';
            })
            ->addColumn('evaluacion_pdf', static function ($query) {
                // Si no tiene periodo es dato ya existe en el sistema anterior
                return show_modal('admin.evaluaciones.certificado',$query->id, 'Evaluación PDF');
                
            })
            ->escapeColumns([]);
    }
}
