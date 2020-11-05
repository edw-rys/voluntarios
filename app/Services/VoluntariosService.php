<?php
namespace App\Services;

use App\Repositories\HorarioVoluntarioRepository;
use App\Repositories\PeriodoVoluntarioRepository;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\VoluntariosRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;

class VoluntariosService extends BaseService{
    /**
     * @vars
     */
    private $horarioVoluntarioRepository;
    private $periodoVoluntarioRepository;
    private $voluntariosRepository;
    private $userRepository;

    /**
     * VoluntariosService constructor.
     *
     * @param VoluntariosRepository $voluntariosRepository
     */
    public function __construct(VoluntariosRepository $voluntariosRepository, UserRepository $userRepository, HorarioVoluntarioRepository $horarioVoluntarioRepository, PeriodoVoluntarioRepository $periodoVoluntarioRepository)
    {
        
        $this->periodoVoluntarioRepository  = $periodoVoluntarioRepository;
        $this->voluntariosRepository        = $voluntariosRepository;
        $this->userRepository               = $userRepository;
        $this->horarioVoluntarioRepository  = $horarioVoluntarioRepository;
    }

    /**
     * Store
     *
     * @param Request $request
     * @param $routeTo
     * @return RedirectResponse
     */
    public function store(Request $request, $routeTo)
    {
        
        $request->merge([
            'Edad'          => Carbon::create($request->input('FechaNacimiento'))->diffInYears(Carbon::now()),
            'TutorBspi'     => $this->getTitleTutor($request->input('idtutor')),
            'pc_name'       => $request->server('REMOTE_ADDR'),
            'status'        => 1,
            'horasDiarias'  => 1,
            'chkActa'       => $request->input('chkActa') === 'on' ? 1 : 0
        ]);

        $voluntario = $this->voluntariosRepository->create($request->all());
        $voluntario->Universidad = null;
        $voluntario->FechaFin            = createDate($request->input('FechaFin'),'Y-m-d')->format('d/m/Y');
        $voluntario->FechaFinCertificado = createDate($request->input('FechaFin'),'Y-m-d')->format('d/m/Y');
        $voluntario->save();
        
        $this->createPeriod($request, $voluntario->id);


        notifyMe('success', trans('global.toasts.created'));

        return $this->redirectTo($request, $routeTo);
    }


     /**
     * Update
     *
     * @param Request $request
     * @param $routeTo
     * @return RedirectResponse
     */
    public function update(Request $request, $routeTo): RedirectResponse
    {
        $voluntario = $this->voluntariosRepository->find($request->get('voluntario_id'), ['*'], [], true);
        
        if ($voluntario === null) {
            notifyMe('warning', trans('global.toasts.no_data'));
            return redirect()->route($routeTo->index);
        }

        $request->merge([
            'Edad'          => Carbon::create($request->input('FechaNacimiento'))->diffInYears(Carbon::now()),
            'TutorBspi'     => $this->getTitleTutor($request->input('idtutor')),
            'pc_name'       => $request->server('REMOTE_ADDR'),
            'status'        => 1,
            'horasDiarias'  => 1,
            'chkActa'       => $request->input('chkActa') === 'on' ? 1 : 0,
        ]);

        $voluntario->update($request->all());
        $voluntario->update([
            'FechaFin'              => createDate($request->input('FechaFin'),'Y-m-d')->format('d/m/Y'),
        ]);

        $periodo = $this->periodoVoluntarioRepository->with('horario_semana')->find($request->input('periodo_id'));
        if( $periodo === null ){
            $voluntario->Universidad = null;
            $voluntario->save();
            
            $this->createPeriod($request, $voluntario->id);
            
        }else{
            $periodo->update([
                'universidad_id'        => $request->input('Universidad'),
                'facultad_id'           => $request->input('Facultad'),
                'carrera'               => $request->input('Carrera'),
                'nivel'                 => $request->input('Nivel'),
                'tutor'                 => $request->input('Tutor'),
                'unidad_id'             => $request->input('Unidad'),
                'departamento_id'       => $request->input('Departamento'),
                'proyecto'              => $request->input('Proyecto'),
                'tutor_bspi_id'         => $request->input('idtutor'),
                'tutor_bspi_nombre'     => $request->input('TutorBspi'),
                'fecha_inicio'          => Carbon::create($request->input('FechaInicio')),
                'fecha_fin'             => Carbon::create($request->input('FechaFin')),
                'horas_programada'      => $request->input('HorasProgramada'),
                'alimentacion_id'       => $request->input('Alimentacion'),
                'horario'               => $request->input('Horario'),
                'tipo_practica_id'      => $request->input('tipoPractica'),
                'chkActa'               => $request->input('chkActa'),
                'observacion'           => $request->input('observacion'),
            ]);
            if($periodo->horario_semana !== null){
                $periodo->horario_semana->update([
                    'lunes_data'        => $request->input('horas_lunes')!==null ? json_encode($request->input('horas_lunes')) : '[]',
                    'martes_data'       => $request->input('horas_martes')!==null ? json_encode($request->input('horas_lunes')) : '[]',
                    'miercoles_data'    => $request->input('horas_miercoles')!==null ? json_encode($request->input('horas_lunes')) : '[]',
                    'jueves_data'       => $request->input('horas_jueves')!==null ? json_encode($request->input('horas_lunes')) : '[]',
                    'viernes_data'      => $request->input('horas_viernes')!==null ? json_encode($request->input('horas_lunes')) : '[]',
                    'sabado_data'       => $request->input('horas_sabado')!==null ? json_encode($request->input('horas_lunes')) : '[]',
                    'domingo_data'      => $request->input('horas_domingo')!==null ? json_encode($request->input('horas_lunes')) : '[]',
                ]);
            }else{
                $horario = $this->horarioVoluntarioRepository->create([
                    'voluntario_id'     => $voluntario->id,
                    'lunes_data'        => $request->input('horas_lunes')!==null ? json_encode($request->input('horas_lunes')) : '[]',
                    'martes_data'       => $request->input('horas_martes')!==null ? json_encode($request->input('horas_lunes')) : '[]',
                    'miercoles_data'    => $request->input('horas_miercoles')!==null ? json_encode($request->input('horas_lunes')) : '[]',
                    'jueves_data'       => $request->input('horas_jueves')!==null ? json_encode($request->input('horas_lunes')) : '[]',
                    'viernes_data'      => $request->input('horas_viernes')!==null ? json_encode($request->input('horas_lunes')) : '[]',
                    'sabado_data'       => $request->input('horas_sabado')!==null ? json_encode($request->input('horas_lunes')) : '[]',
                    'domingo_data'      => $request->input('horas_domingo')!==null ? json_encode($request->input('horas_lunes')) : '[]',
                ]);
                $periodo->horario_voluntario_id = $horario->id;
                $periodo->save();
            }

        }

        // dd();
        notifyMe('success', trans('global.toasts.edited'));

        return $this->redirectTo($request, $routeTo);
    }


    public function getTitleTutor($user_id)
    {
        $user = $this->userRepository->find($user_id);
        if($user === null){
            return '';
        }
        return $user->titulo . ' ' . $user->Nombres . ' ' . $user->Apellidos;
    }

    public function cambioPeriodo(Request $request, $routeTo)
    {
        $request->merge([
            'TutorBspi'     => $this->getTitleTutor($request->input('idtutor')),
            'pc_name'       => $request->server('REMOTE_ADDR'),
            'status'        => 1,
            'horasDiarias'  => 1,
            'chkActa'       => $request->input('chkActa') === 'on' ? 1 : 0
        ]);

        // Buscar voluntario
        $voluntario = $this->voluntariosRepository->find( $request->input('voluntario_id'));

        // No hay datos
        if($voluntario === null){
            notifyMe('warning', trans('global.toasts.no_data'));
            return redirect()->route($routeTo->index);
        }
        $voluntario->update([
            'status'                => 1,
            'FechaFin'              => createDate($request->input('FechaFin'),'Y-m-d')->format('d/m/Y'),
        ]);
        // dd($voluntario);
        $this->createPeriod($request,  $request->input('voluntario_id'));

        notifyMe('success', trans('global.toasts.updated'));

        return $this->redirectTo($request, $routeTo);
    }

    public function createPeriod(Request $request, $voluntario_id)
    {
        $horario = $this->horarioVoluntarioRepository->create([
            'voluntario_id'     => $voluntario_id,
            'lunes_data'        => $request->input('horas_lunes')!==null ? json_encode($request->input('horas_lunes')) : '[]',
            'martes_data'       => $request->input('horas_martes')!==null ? json_encode($request->input('horas_lunes')) : '[]',
            'miercoles_data'    => $request->input('horas_miercoles')!==null ? json_encode($request->input('horas_lunes')) : '[]',
            'jueves_data'       => $request->input('horas_jueves')!==null ? json_encode($request->input('horas_lunes')) : '[]',
            'viernes_data'      => $request->input('horas_viernes')!==null ? json_encode($request->input('horas_lunes')) : '[]',
            'sabado_data'       => $request->input('horas_sabado')!==null ? json_encode($request->input('horas_lunes')) : '[]',
            'domingo_data'      => $request->input('horas_domingo')!==null ? json_encode($request->input('horas_lunes')) : '[]',
        ]);
        $periodo = $this->periodoVoluntarioRepository->create([
            'voluntario_id'         => $voluntario_id,
            'universidad_id'        => $request->input('Universidad'),
            'facultad_id'           => $request->input('Facultad'),
            'carrera'               => $request->input('Carrera'),
            'nivel'                 => $request->input('Nivel'),
            'tutor'                 => $request->input('Tutor'),
            'unidad_id'             => $request->input('Unidad'),
            'departamento_id'       => $request->input('Departamento'),
            'proyecto'              => $request->input('Proyecto'),
            'tutor_bspi_id'         => $request->input('idtutor'),
            'tutor_bspi_nombre'     => $request->input('TutorBspi'),
            'fecha_inicio'          => Carbon::create($request->input('FechaInicio')),
            'fecha_fin'             => Carbon::create($request->input('FechaFin')),
            'horas_programada'      => $request->input('HorasProgramada'),
            'alimentacion_id'       => $request->input('Alimentacion'),
            'horario_voluntario_id' => $horario->id,
            'horario'               => $request->input('Horario'),
            'tipo_practica_id'      => $request->input('tipoPractica'),
            'chkActa'               => $request->input('chkActa'),
            'observacion'           => $request->input('observacion'),
        ]);

    }
}