<?php
namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;

class UserService extends BaseService{
    /**
     * @vars
     */
    private $userRepository;

    /**
     * SettingService constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository               = $userRepository;
    }

    /**
     * Update
     *
     * @param Request $request
     * @param $routeTo
     * @return RedirectResponse
     */
    /*public function update(Request $request, $routeTo): RedirectResponse
    {
        $item = $this->userRepository->findDecoded($request->get('id'), ['*'], [], true);

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
    }*/
}