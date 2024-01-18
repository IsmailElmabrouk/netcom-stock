<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;
    
    public function __construct()

    {

        $this->middleware('guest')->except('logout');

    }
    public function login(Request $request): RedirectResponse
    {
        $input = $request->all();
    
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (auth()->attempt(['email' => $input['email'], 'password' => $input['password']])) {
            if (auth()->user()->type == 'admin') {
                return redirect()->route('Admin.admin-page');
            } elseif (auth()->user()->type == 'Magasiner') {
                return redirect()->route('Magasiner.magasiner-page');
            } elseif (auth()->user()->type == 'Commercial') { // Ajoutez cette condition
                return redirect()->route('commercial.home-page');
            } else {
                // Gérer d'autres types d'utilisateurs si nécessaire
            }
        } else {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }
    }
}