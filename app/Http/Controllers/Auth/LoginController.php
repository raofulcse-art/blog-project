<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
//use League\Config\Exception\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Validation\ValidationException;
use Nette\Utils\Json;

use function Laravel\Prompts\error;

class LoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $token = $request->authenticate();

        try{
            $user = Auth::guard('api')->user();
            return view('registered',[
                'status' => 'success',
            'user' => new UserResource($user),
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer'
            ]
            ]);
        }catch(ValidationException $e){

            return response()->json([
                'status' => 'error',
                'message' => 'Invalid login credentials',
                'errors' => $e->getMessage(),
            ],422);
        }

        

    
    } 
    public function refresh(): JsonResponse
{
    try {
        $newToken = Auth::refresh();

        return response()->json([
            'status' => 'success',
            'authorisation' => [
                'token' => $newToken,
                'type' => 'bearer'
            ]
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => 'Token cannot be refreshed'
        ], 401);
    }
}

    /**
     * Destroy an authenticated session.
     */
    public function destroy()
    {
        
        Auth::guard('api')->logout();

        //$request->session()->invalidate();

        //$request->session()->regenerateToken();
        /*
        return response()->json([
            'status' => 'successfuly logged out',
        ],200);
        */
        return view('registered');
    }

    public function me()
{
    
    return response()->json([
        'user' => Auth::user()
    ]);
    
    
}
}
