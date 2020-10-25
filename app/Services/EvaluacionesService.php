<?php

namespace App\Services;

use App\Repositories\EvaluacionesRepository;
use App\Repositories\PeriodoVoluntarioRepository;
use App\Repositories\VoluntariosRepository;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EvaluacionesService extends BaseService
{
    /**
     * @var EvaluacionesRepository
     */
    private $evaluacionesRepository;
    /**
     * @var PeriodoVoluntarioRepository
     */
    private $periodoVoluntarioRepository;
    /**
     * EvaluacionesService constructor
     * @param EvaluacionesRepository $evaluacionesRepository
     */
    public function __construct(EvaluacionesRepository $evaluacionesRepository, PeriodoVoluntarioRepository $periodoVoluntarioRepository) {
        $this->evaluacionesRepository      = $evaluacionesRepository;
        $this->periodoVoluntarioRepository = $periodoVoluntarioRepository;
    }

    /**
     * Create
     *
     * @param Request $request
     * @param $routeTo
     * @return RedirectResponse
     */
    public function store(Request $request, $routeTo): RedirectResponse
    {

        $periodo = $this->periodoVoluntarioRepository->where('voluntario_id' , $request->input('CodigoReferencia'))->where('status', 1)->get()->last();
        
        $periodo_id = null;
        if($periodo !== null){
            $periodo_id = $periodo->id;
            $periodo->status = 0;
            $periodo->save();
        }
        $request->merge([
            'txtsi'        => $request->input('txtrecomendado','no') == 'si' ? 1 : 0,
            'txtno'        => $request->input('txtrecomendado','no') == 'no' ? 1 : 0,
            'FechaIngreso' => Carbon::now()->format('Y-m-d') . 'T' . Carbon::now()->format('H:i:s'),
            'pc_name'      => $request->server('REMOTE_ADDR'),
            'status'       => 1,
            'periodo_id'   => $periodo_id,
            'Pasaporte'    =>  (new VoluntariosRepository)->find($request->input('CodigoReferencia'))->Pasaporte,
            'fecha_modificacion'   => Carbon::now()->format('Y-m-d') . 'T' . Carbon::now()->format('H:i:s'),
            'usuario_modificacion' => auth()->user()->id
        ]);

        // Create Evaluations
        $evaluate = $this->evaluacionesRepository->create($request->all());

        notifyMe('success', trans('global.toasts.created'));

        return $this->redirectTo($request, $routeTo);
    }

}
