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
     * Update
     *
     * @param Request $request
     * @param $routeTo
     * @return RedirectResponse
     */
    public function update(Request $request, $routeTo): RedirectResponse
    {
        $item = $this->voluntariosRepository->findDecoded($request->get('id'), ['*'], [], true);

        if ($item === null) {
            notifyMe('warning', trans('global.toasts.no_data'));
            return redirect()->route($routeTo->index);
        }

        $request->merge(['updated_at' => now()]);

        // Update
        $item->update([
            'email'       =>  $request->input('email'),
            'first_name'  =>  $request->input('first_name'),
            'second_name' =>  $request->input('second_name'),
            'last_name'   =>  $request->input('last_name'),
            'source_name' =>  $request->input('source_name'),
            'address'     =>  $request->input('address'),
        ]);
       
        notifyMe('success', trans('global.toasts.updated'));

        return $this->redirectTo($request, $routeTo);
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
        // dd($request->input(),$voluntario);
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

        $periodo = $this->periodoVoluntarioRepository->create([
            'voluntario_id'         => $voluntario->id,
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
            'tipo_practica_id'      => $request->input('tipoPractica')
        ]);



        notifyMe('success', trans('global.toasts.created'));

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

        
        $horario = $this->horarioVoluntarioRepository->create([
            'voluntario_id'     => $request->input('voluntario_id'),
            'lunes_data'        => $request->input('horas_lunes')!==null ? json_encode($request->input('horas_lunes')) : '[]',
            'martes_data'       => $request->input('horas_martes')!==null ? json_encode($request->input('horas_lunes')) : '[]',
            'miercoles_data'    => $request->input('horas_miercoles')!==null ? json_encode($request->input('horas_lunes')) : '[]',
            'jueves_data'       => $request->input('horas_jueves')!==null ? json_encode($request->input('horas_lunes')) : '[]',
            'viernes_data'      => $request->input('horas_viernes')!==null ? json_encode($request->input('horas_lunes')) : '[]',
            'sabado_data'       => $request->input('horas_sabado')!==null ? json_encode($request->input('horas_lunes')) : '[]',
            'domingo_data'      => $request->input('horas_domingo')!==null ? json_encode($request->input('horas_lunes')) : '[]',
        ]);

        $periodo = $this->periodoVoluntarioRepository->create([
            'voluntario_id'         => $request->input('voluntario_id'),
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
            'tipo_practica_id'      => $request->input('tipoPractica')
        ]);

        notifyMe('success', trans('global.toasts.updated'));

        return $this->redirectTo($request, $routeTo);
    }
}