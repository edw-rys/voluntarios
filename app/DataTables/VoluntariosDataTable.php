<?php

namespace App\DataTables;

use App\Repositories\InvoiceRepository;
use App\Repositories\VoluntariosRepository;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class VoluntariosDataTable extends DataTable
{
    use DataTableBase;

    private $action = 'voluntarios';
    private $route  = 'admin.voluntarios';
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
        // dd();
        return [
            Column::make('id')->title(trans('global.voluntario.number'))->className('text-center'),
            Column::make('status')->title(trans('global.status'))->className('text-center'),
            Column::make('Nombres')->title(trans('global.voluntario.names'))->className('text-center'),
            Column::make('Apellidos')->title(trans('global.voluntario.last_names'))->className('text-center'),
            Column::make('Pasaporte')->title(trans('global.voluntario.identification_number'))->className('text-center'),
            Column::make('Universidad')->title(trans('global.voluntario.university'))->className('text-center'),
            Column::make('Carrera')->title(trans('global.voluntario.carrera'))->className('text-center'),
            Column::make('Unidad')->title(trans('global.voluntario.unity'))->className('text-center'),
            Column::make('Departamento')->title(trans('global.voluntario.department'))->className('text-center'),
            Column::make('tipoPractica')->title(trans('global.voluntario.tipo_practica'))->className('text-center'),
            Column::make('TutorBspi')->title(trans('global.voluntario.tutor_bspi'))->className('text-center'),
            Column::make('FechaInicio')->title(trans('global.voluntario.start_date'))->className('text-center'),
            Column::make('FechaFin')->title(trans('global.voluntario.end_date'))->className('text-center'),
            Column::make('edit')->title(trans('global.voluntario.edit'))->className('text-center'),
        ];
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): \Yajra\DataTables\Html\Builder
    {
        return $this->getHtml(12, 'desc');
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
            ->editColumn('Pasaporte', static function ($query) {
                return $query->Pasaporte;
            })
            ->editColumn('Carrera', static function ($query) {
                return $query->Carrera;
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
            ->editColumn('tipoPractica', static function ($query) {
                return $query->tipo_practica ? $query->tipo_practica->Nombre : $query->tipoPractica ;
            })
            ->editColumn('status', static function ($query) {
                return status($query->status);
            })
            ->addColumn('edit', static function ($query) {
                return status($query->status);
            })
            ->escapeColumns([]);
    }
}
