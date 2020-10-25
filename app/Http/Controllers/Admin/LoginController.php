<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Authentication\LoginRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;

class LoginController extends Controller
{

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;


     /**
     * LoginController constructor.
     *
     * @param UserService $userService
     * @param UserRepository $userRepository
     */
    public function __construct(UserService $userService, UserRepository $userRepository)
    {
        // Vars
        $this->guard            = 'web';
        $this->redirectTo       = route('admin.dashboard');
        $this->userService      = $userService;
        $this->userRepository   = $userRepository;
    }

     /**
     * Show the application's login form.
     *
     * @return Application|Factory|View
     */
    public function showLoginForm()
    {
        return view('admin.templates.login');
    }

    /**
     * @param LoginRequest $request
     * @return RedirectResponse|Response
     * @throws ValidationException
     */
    public function login(LoginRequest $request)
    {
        //dd($request->input());
       
        // Authentication is valid
        //$credentials = $request->only('Username', 'Password');
        //dd(Auth::attempt(['Username' => $request->input('Username'), 'Password' => $request->input('Password'), 'status' => 1]));
        //dd(Auth::attempt($credentials));
        if ($this->attemptLogin($request)) {

            Auth::shouldUse($this->guard);

            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }


    /**
     * Attempt to log the user into the application.
     *
     * @param Request $request
     * @return bool
     */
    protected function attemptLogin(Request $request): bool
    {
       // dd($this->credentials($request) );
        // bcrypt('contraseña');
        return $this->guard()->attempt(
            $this->credentials($request) 
        );
    }
     /**
     * Get the failed login response instance.
     *
     * @param Request $request
     * @return Response
     *
     * @throws ValidationException
     */
    protected function sendFailedLoginResponse(Request $request): Response
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return StatefulGuard
     */
    protected function guard(): StatefulGuard
    {
        return Auth::guard($this->guard);
    }

      /**
     * Send the response after the user was authenticated.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    protected function sendLoginResponse(Request $request): RedirectResponse
    {
        $request->session()->regenerate();

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->route('client.dashboard');
    }



    /**
     * The user has been authenticated.
     *
     * @param Request $request
     * @param $user
     * @return RedirectResponse|void
     */
    protected function authenticated(Request $request, $user)
    {
        // Check Password Expiration
        $request->session()->forget('password_expired_id');

        // Logout other devices
        Auth::logoutOtherDevices($request->get('password'));

        notifyMe('info', trans('global.login_correctly'));

        return redirect()
            ->route('admin.dashboard')
            // ->intended($this->redirectPath())
            ->with('info', trans('global.login_successfully', ['user' => $user->name, 'company' => getProjectName()]));
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username(): string
    {
        return 'Username';
    }

    /**
     * Get the login password to be used by the controller.
     *
     * @return string
     */
    public function password(): string
    {
        return 'password';
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param Request $request
     * @return array
     */
    protected function credentials(Request $request): array
    {
        return $request->only($this->username(), $this->password());
    }

        /**
     * Get the failed login response instance.
     *
     * @param Request $request
     * @param $user
     * @throws ValidationException
     */
    protected function sendBlockedAccountResponse(Request $request, $user): void
    {
        // Block User for multiple attempts
        $user->block($user);

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.blocked')],
        ]);
    }

        /**
     * Log the user out of the application.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector|mixed
     */
    public function logout(Request $request)
    {

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login.show');
    }
}
