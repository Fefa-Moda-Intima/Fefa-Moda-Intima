<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\VerifyEmailException;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Attempt to log the user into the application.
     */
    protected function attemptLogin(Request $request): bool
    {
        
        $token = $this->guard()->attempt($this->credentials($request));
        
        if (!$token) {
            return false;
        }
        
        $user = $this->guard()->user();

        if ($user instanceof MustVerifyEmail && ! $user->hasVerifiedEmail()) {
            return false;
        }

        $this->guard()->setToken($token);

        return true;
    }

    /**
     * Send the response after the user was authenticated.
     */
    protected function sendLoginResponse(Request $request)
    {
        $user = $this->guard()->user();

        if($request->header('type') == null)
        {
            return $this->errorResponse("Local de emissão não informado!", 400);
        }

        if($this->isApp($request) && !$this->isAdm()){
            return $this->errorResponse("Usuário não tem permissões para acessar o aplicativo!", 403);
        }

        $this->clearLoginAttempts($request);

        $token = (string) $this->guard()->getToken();
        return $this->responseWithToken($token);
       
    }

    protected function responseWithToken($token){
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Carbon::now()->addSeconds($this->guard()->getPayload()->get('exp') - time()),
        ]);
    }

    /**
     * Get the failed login response instance.
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $user = $this->guard()->user();

        if ($user instanceof MustVerifyEmail && ! $user->hasVerifiedEmail()) {
            throw VerifyEmailException::forUser($user);
        }

        return $this->errorResponse(trans('auth.failed'), 400);
        // throw ValidationException::withMessages([
        //     $this->username() => [trans('auth.failed')],
        // ]);
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        return response()->json(null, 204);
    }
}
