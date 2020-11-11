<?php

namespace App\Http\Controllers\Admin\Voluntarios;

use App\DataTables\CertificadosDataTable;
use App\DataTables\FormFilters\FormFilter;
use App\Http\Controllers\Controller;
use App\Repositories\EvaluacionesRepository;
use App\Repositories\PeriodoVoluntarioRepository;
use App\Repositories\VoluntariosCertificadosRepository;
use App\Repositories\VoluntariosRepository;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class CertificadosController extends Controller
{
    /**
     * @vars
     */
    private $views;
    private $contextPdf;
    private $voluntariosRepository;
    private $evaluacionesRepository;
    private $periodoVoluntarioRepository;
    private $permisos;
    /**
     * CertificadosController constructor.
     * @param VoluntariosCertificadosRepository $voluntariosRepository
     * @param EvaluacionesRepository $evaluacionesRepository
     * @param PeriodoVoluntarioRepository $periodoVoluntarioRepository
     */
    public function __construct( VoluntariosCertificadosRepository $voluntariosRepository, EvaluacionesRepository $evaluacionesRepository, PeriodoVoluntarioRepository $periodoVoluntarioRepository)
    {
        $this->periodoVoluntarioRepository  = $periodoVoluntarioRepository;
        $this->voluntariosRepository        = $voluntariosRepository;
        $this->evaluacionesRepository       = $evaluacionesRepository;

        $this->views        = (object) [
            'index'     => 'admin.pages.evaluaciones.index',
            'evaluate'  => 'admin.pages.evaluaciones.evaluate',
            'pdf'       => (object) [
                'evaluacion'        => 'admin.report.voluntarios.evaluacion',
                'certificado'       => 'admin.report.voluntarios.certificado',
                'confidencialidad'  => 'admin.report.voluntarios.confidencialidad',
                'ficha'             => 'admin.report.voluntarios.ficha',
            ]
        ];
        $this->routes       = (object) [
            'index'         => 'admin.evaluaciones.index',
            'evaluate'      => 'admin.evaluaciones.evaluate'
        ];
        $this->contextPdf = stream_context_create([
            'ssl' => [
                'allow_self_signed' => true,
                'verify_peer'       => false,
                'verify_peer_name'  => false,
            ]
        ]);
        $this->filters      = [
            'status',
            'departemento',
            'user_id',
        ];
        $this->options_dompdf = [
            'dpi'                       => 110,
            'defaultFont'               => 'helvetica',
            'defaultPaperSize'          => 'A4',
            'defaultMediaType'          => 'print',
            'defaultPaperOrientation'   => 'portrait',
            'isHtml5ParserEnabled'      => true,
            'isPhpEnabled'              => true,
            'isRemoteEnabled'           => true,
            'enable_remote'             => true
        ];
        // Permisos
        $this->permisos = (object)[
            'acceso_certificados'   => 'acceso_certificados',
            'generar_certificados'  => 'generar_certificados',
            'generar_evaluaciones'  => 'Generar_evaluaciones',
            'generar_ficha'         => 'generar_ficha',
        ];
    }
    
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(CertificadosDataTable $dataTable)
    {
        _canAccess_($this->permisos->acceso_certificados);
        // notifyMe('warning', trans('global.toasts.no_data'));
        viewExist($this->views->index);

        $dataTable->filters = $this->filters;

        return $dataTable->render($this->views->index, [
            'filters'   => (new FormFilter())->filters($this->filters, $this->voluntariosRepository),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function generarEvaluacion(Request $request, $id)
    {
        // Denegar acceso en caso de no tener permisos
        _canAccess_($this->permisos->generar_evaluaciones);

        if($request->input('tipo') == 'evaluacion'  ||  $request->input('tipo') == 'periodo'){
            return $this->certificadoEvaluacionGenerar($id);
        }
        abort(404);
    }
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function generaCertificadoAprobacion (Request $request, $id)
    {
        // Denegar acceso en caso de no tener permisos
        _canAccess_($this->permisos->generar_certificados);

        $evaluacion = $this->evaluacionesRepository->find($id, ['*'], [
            'voluntario', 'periodo', 'voluntario.departamento', 'voluntario.unidad', 'voluntario.universidad', 'voluntario.tipo_practica'
        ]);
        if($evaluacion === null){
            abort(404);
        }
        if($evaluacion->voluntario === null){
            abort(404);
        }
        $periodo = $this->periodoVoluntarioRepository->find($evaluacion->periodo_id, ['*'], [
            'departamento', 'unidad', 'universidad', 'tipo_practica', 'alimentacion'
        ]);
        // Nombre de práctica por periodo o por voluntario
        $practica    = $periodo !== null ? $periodo->tipo_practica->descripcion: $evaluacion->voluntario->tipo_practica->descripcion;
        // dd($evaluacion->voluntario);
        $html = view($this->views->pdf->certificado)
                ->with('periodo', $periodo)
                ->with('practica', $practica)
                ->with('voluntario', $evaluacion->voluntario)
                // ->with('firma_fecha', $firma_fecha)
                ->render();
        // echo $html;
                // dd();
        return $this->generarPdf($html , time().$evaluacion->voluntario->Pasaporte );
    }
    
    /**
     * Generar certificado
     * @param $id
     */
    public function certificadoEvaluacionGenerar($id)
    {
        $evaluacion = $this->evaluacionesRepository->find($id, ['*'], [
            'voluntario', 'periodo', 'voluntario.departamento', 'voluntario.unidad', 'voluntario.universidad', 'voluntario.tipo_practica'
        ]);
        if($evaluacion === null){
            abort(404);
        }
        if($evaluacion->voluntario === null){
            abort(404);
        }
        $periodo = $this->periodoVoluntarioRepository->find($evaluacion->periodo_id, ['*'], [
            'departamento', 'unidad', 'universidad', 'tipo_practica', 'alimentacion'
        ]);
        if($periodo !== null ){
            $horas_voluntario   = $periodo->horas_programada;
            $departamento       = $periodo->departamento ? $periodo->departamento->Nombre : 'Desconocido';
            $carrera            = $periodo->carrera;
            $periodo_voluntario = Carbon::create($periodo->fecha_inicio)->format('d/m/Y') . ' - ' . Carbon::create($periodo->fecha_fin)->format('d/m/Y');
            $unidad             = $periodo->unidad ? $periodo->unidad->Nombre : 'Desconocido';
            $tutor_info         = $periodo->TutorBspi ;
            $calificacion_global = ($evaluacion->txt1 + $evaluacion->txt2 + $evaluacion->txt3 + $evaluacion->txt4 + $evaluacion->txt5 +
                                    $periodo->evaluacion->txt6 +  $periodo->evaluacion->txt7 +  $periodo->evaluacion->txt8  + $periodo->evaluacion->txt9 + $periodo->evaluacion->txt10 +
                                    $periodo->evaluacion->txt11 + $periodo->evaluacion->txt12 + $periodo->evaluacion->txt13 + $periodo->evaluacion->txt14 + $periodo->evaluacion->txt15 +
                                    $periodo->evaluacion->txt16 + $periodo->evaluacion->txt17 + $periodo->evaluacion->txt18 + $periodo->evaluacion->txt19 + $periodo->evaluacion->txt20 +
                                    $periodo->evaluacion->txt21 + $periodo->evaluacion->txt22) /22;
            $desempenio = $calificacion_global >= 80 ? 'Excelente' : ($calificacion_global >= 70 ? 'Bueno' : ($calificacion_global >= 50 ? 'Regular' : 'Malo' )); 
        }else{
            $horas_voluntario   = $evaluacion->voluntario->HorasProgramada;
            $departamento       = $evaluacion->voluntario->departamento ? $evaluacion->voluntario->departamento->Nombre : 'Desconocido';
            $carrera            = $evaluacion->voluntario->Carrera;
            $unidad             = $evaluacion->voluntario->unidad ? $evaluacion->voluntario->unidad->Nombre : 'Desconocido';
            $periodo_voluntario = $evaluacion->voluntario->FechaInicio . ' - ' . $evaluacion->voluntario->FechaFinCertificado;
            $tutor_info         = $evaluacion->voluntario->TutorBspi;
            $calificacion_global = ($evaluacion->txt1 + $evaluacion->txt2 + $evaluacion->txt3 + $evaluacion->txt4 + $evaluacion->txt5 +
                                    $evaluacion->txt6 + $evaluacion->txt7 + $evaluacion->txt8 + $evaluacion->txt9 + $evaluacion->txt10 +
                                    $evaluacion->txt11 + $evaluacion->txt12 + $evaluacion->txt13 + $evaluacion->txt14 + $evaluacion->txt15 +
                                    $evaluacion->txt16 + $evaluacion->txt17 + $evaluacion->txt18 + $evaluacion->txt19 + $evaluacion->txt20 +
                                    $evaluacion->txt21 + $evaluacion->txt22) /22;
            $desempenio = $calificacion_global >= 80 ? 'Excelente' : ($calificacion_global >= 70 ? 'Bueno' : ($calificacion_global >= 50 ? 'Regular' : 'Malo' )); 
        }
        $html = view($this->views->pdf->evaluacion)
                ->with('periodo_voluntario', $periodo_voluntario)
                ->with('voluntario', $evaluacion->voluntario)
                ->with('horas_voluntario', $horas_voluntario)
                ->with('calificacion_global', $calificacion_global)
                ->with('departamento', $departamento)
                ->with('tutor_info', $tutor_info)
                ->with('evaluacion', $evaluacion)
                ->with('desempenio', $desempenio)
                ->with('periodo', $periodo)
                ->with('carrera', $carrera)
                ->with('unidad', $unidad)
                // ->with('item', $item)
                ->render();
        return $this->generarPdf($html , time().$evaluacion->voluntario->Pasaporte );
        // echo $html;
    }

    /**
     * Genera pdf  (cualquier pdf)
     * @param $html
     * @param $nombre
     */
    public function generarPdf($html, $nombre, $attachment = 0)
    {
        $options = new Options();
        $options->set($this->options_dompdf);
        $options->setIsRemoteEnabled(true);
        $domPDF = new Dompdf($options);

        // $domPDF->setHttpContext($this->contextPdf);

        $domPDF->loadHtml($html);

        // Render the HTML as PDF
        $domPDF->render();

        $domPDF->stream( $nombre. time() . '.pdf', ['Attachment' => $attachment, 'compress' => true]);
    }
    /**
     * Generar carta de confidencialidad
     * @param $voluntario
     * @param $periodo
     */
    public function generaConfidencialidad($voluntario, $periodo)
    {
        $html = view($this->views->pdf->confidencialidad)
            ->with('voluntario', $voluntario)
            ->with('periodo', $periodo);
        // $this->options_dompdf['dpi'] = 170;
        $this->options_dompdf['defaultPaperSize'] = "ra4";
        // echo $html ;
        // dd();
        $this->generarPdf($html , time().$voluntario->Pasaporte, 0);
        // redirect()->route('admin.dashboard');
    }

    /**
     * @param Request $request
     * @param $id -> id del voluntario
     * @param $periodo_id -> id del periodo o 0 en caso de no tener periodo
     */
    public function generarFicha(Request $request, $id, $periodo_id)
    {
        _canAccess_($this->permisos->generar_ficha);
        
        $voluntario = (new VoluntariosRepository)->obtenerVoluntarioPediodoActivo($id, true, $periodo_id);
        
        if($voluntario === null){
            abort(404);
        }
        
        viewExist($this->views->pdf->ficha);
        $this->options_dompdf['dpi'] = 100;

        $html = view($this->views->pdf->ficha)
            ->with('voluntario' , $voluntario)
            ->with('periodo'    , $voluntario->periodo);
        // echo $html;
        $this->generarPdf($html , time().$voluntario->Pasaporte, 0);
    }
}
