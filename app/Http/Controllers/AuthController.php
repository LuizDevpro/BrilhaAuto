<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register()
    {

        $data = [
            'subtitle' => 'Cadastrar-se',
        ];

        return view('auth.register_frm', $data);
    }

    public function registerSubmit(Request $request)
    {

        $request->validate(
            [
                'name_surname' => 'required|min:5|max:150',
                'email' => 'required|email|max:150|unique:users,email',
                'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{6,16}$/|confirmed',

            ],
            [
                'name_surname.required' => 'O nome e sobrenome é obrigatório.',
                'name_surname.min' => 'O nome e sobrenome deve ter no mínimo :min caracteres.',
                'name_surname.max' => 'O nome e sobrenome deve ter no máximo :max caracteres.',
                'email.required' => 'O e-mail é obrigatório.',
                'email.email' => 'O e-mail deve ser um e-mail válido.',
                'email.max' => 'O e-mail deve ter no máximo :max caracteres.',
                'email.unique' => 'Cadastro inválido.',
                'password.required' => 'A senha é obrigatória.',
                'password.regex' => 'A senha deve ter entre 6 e 16 caracteres, incluindo uma letra maiúscula, uma minúscula e um número.',
                'password.confirmed' => 'A senha deve ser confirmada.',
            ]
        );

        $user = new User;
        $user->name_surname = $request->name_surname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->active = 1;
        $user->role = 'client';
        $user->save();

        return redirect()->route('login');
    }

    public function login()
    {

        $data = [
            'subtitle' => 'Entrar',
        ];

        return view('auth.login_frm', $data);
    }

    public function loginSubmit(Request $request)
    {

        $request->validate(
            [
                'email' => 'required|email|max:150',
                'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{6,16}$/',
            ],
            [
                'email.required' => 'O e-mail é obrigatório.',
                'email.email' => 'O e-mail deve ser um e-mail válido.',
                'email.max' => 'O e-mail deve ter no máximo :max caracteres.',
                'password.required' => 'A senha é obrigatória.',
                'password.regex' => 'A senha deve ter entre 6 e 16 caracteres, incluindo uma letra maiúscula, uma minúscula e um número.',
            ]
        );

        $user = User::where('email', trim($request->email))
            ->where('active', true)
            ->whereNull('deleted_at')
            ->where(function ($query) {
                $query->whereNull('blocked_until')->orWhere('blocked_until', '<', now());
            })
            ->first();

        if ($user && Hash::check(trim($request->password), $user->password)) {

            if ($user->role !== 'sys-admin' && ($user->deleted_at)) {
                return redirect()->back()->withInput()->with('server_error', 'Login inválido.');
            }

            $this->loginUser($user);

            if ($user->role === 'sys-admin') {
                return redirect()->route('sysadmin.home');
            } else if($user->role === 'admin'){
                return redirect()->route('admin.home');
            } else {
                return redirect()->route('home');
            }
        } else {

            return redirect()->back()->withInput()->with('server_error', 'Login inválido.');
        }

    }

    private function loginUser($user)
    {
        $user->last_login = now();
        $user->blocked_until = null;
        $user->save();

        auth()->login($user);
    }

    public function logout()
    {

        auth()->logout();

        session()->invalidate();

        session()->regenerateToken();

        return redirect()->route('home');

    }

    
}
