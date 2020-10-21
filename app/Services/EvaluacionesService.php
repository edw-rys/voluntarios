<?php

namespace App\Services;

use App\Repositories\EvaluacionesRepository;
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
     * EvaluacionesService constructor
     * @param EvaluacionesRepository $evaluacionesRepository
     */
    public function __construct(EvaluacionesRepository $evaluacionesRepository) {
        $this->evaluacionesRepository = $evaluacionesRepository;
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
        $request->merge([
            'txtsi'        => $request->input('txtrecomendado','no') == 'si' ? 1 : 0,
            'txtno'        => $request->input('txtrecomendado','no') == 'no' ? 1 : 0,
            'FechaIngreso' => Carbon::now(),
            'pc_name'      => $request->server('REMOTE_ADDR'),
            'status'       => 1,
            'Pasaporte'    =>  (new VoluntariosRepository)->find($request->input('CodigoReferencia'))->Pasaporte,
            'fecha_modificacion'   => Carbon::now(),
            'usuario_modificacion' => auth()->user()->id
        ]);

        // Create Evaluations
        $evaluate = $this->evaluacionesRepository->create($request->all());

        notifyMe('success', trans('global.toasts.created'));

        return $this->redirectTo($request, $routeTo);
    }

}
