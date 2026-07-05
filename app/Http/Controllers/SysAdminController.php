<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SysAdminController extends Controller
{
    public function index()
    {

        $users = User::withTrashed()->where('role', '!=', 'sys-admin')->get();

        $data = [
            'subtitle' => 'Administração do Sistema',
            'users' => $users,
        ];

        return view('sysadmin.home', $data);
    }

    public function createUser()
    {

        $data = [
            'subtitle' => 'Criar Usuário',
        ];

        return view('sysadmin.create_user_frm', $data);
    }

    public function createUserSubmit(Request $request)
    {

        $request->validate(
            [

                'name_surname' => 'required|min:5|max:150',
                'email' => 'required|email|max:150|unique:users,email',
                'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{6,16}$/|confirmed',
                'role' => 'required|in:admin,client',

            ],
            [
                'name_surname.required' => 'O nome e sobrenome é obrigatório.',
                'name_surname.min' => 'O nome e sobrenome deve ter no mínimo :min caracteres.',
                'email.required' => 'O e-mail é obrigatório.',
                'email.email' => 'O e-mail deve ser um e-mail válido.',
                'email.max' => 'O e-mail deve ter no máximo :max caracteres.',
                'email.unique' => 'E-mail já existente.',
                'role.required' => 'O perfil é obrigatório.',
                'role.in' => 'O valor selecionado para o perfil é inválido.',
                'password.required' => 'A senha é obrigatória.',
                'password.regex' => 'A senha deve ter entre 6 e 16 caracteres, incluindo uma letra maiúscula, uma minúscula e um número.',
                'password.confirmed' => 'A senha deve ser confirmada.',
            ]
        );

        $user = new User;
        $user->name_surname = $request->name_surname;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('sysadmin.home');
    }

    public function forcePasswordReset($id)
    {

        if (! $user = $this->checkUserIsValid($this->decryptUserId($id))) {
            return $this->redirectOnInvalidUser();
        }

        $data = [
            'subtitle' => 'Forçar a Alteração de Senha',
            'user' => $user,
        ];

        return view('sysadmin.force_password_change_confirm', $data);
    }

    public function forcePasswordResetConfirm($id, Request $request)
    {

        if (! $user = $this->checkUserIsValid($this->decryptUserId($id))) {
            return $this->redirectOnInvalidUser();
        }

        $request->validate(
            [
                'new_password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{6,16}$/',

            ],
            [
                'new_password.required' => 'A senha é obrigatória.',
                'new_password.regex' => 'A senha deve ter entre 6 e 16 caracteres, incluindo uma letra maiúscula, uma minúscula e um número.',
            ]
        );

        $user->password = bcrypt($request->new_password);
        $user->blocked_until = null;
        $user->deleted_at = null;
        $user->active = 1;
        $user->save();

        return redirect()->route('sysadmin.home');
    }

    public function deactivateUser($id)
    {

        if (! $user = $this->checkUserIsValid($this->decryptUserId($id))) {
            return $this->redirectOnInvalidUser();
        }

        $user->active = 0;
        $user->save();

        return redirect()->route('sysadmin.home');
    }

    public function activateUser($id)
    {

        if (! $user = $this->checkUserIsValid($this->decryptUserId($id))) {
            return $this->redirectOnInvalidUser();
        }

        $user->active = 1;
        $user->save();

        return redirect()->route('sysadmin.home');

    }

    public function blockUser($id)
    {

        if (! $user = $this->checkUserIsValid($this->decryptUserId($id))) {
            return $this->redirectOnInvalidUser();
        }

        $data = [
            'subtitle' => 'Bloquear Usuário',
            'user' => $user,
        ];

        return view('sysadmin.block_user_frm', $data);
    }

    public function blockUserSubmit(Request $request)
    {

        $request->validate(
            [
                'blocked_until' => 'required|date|after:now',
            ],
            [
                'blocked_until.required' => 'A data/hora é obrigatória.',
                'blocked_until.date' => 'A data/hora indicada é inválida.',
                'blocked_until.after' => 'A data/hora indicada deve ser no futuro.',
            ]
        );

        if (empty($request->user_id)) {
            return redirect()->route('sysadmin.home');
        }

        if (! $user = $this->checkUserIsValid($this->decryptUserId($request->user_id))) {
            return $this->redirectOnInvalidUser();
        }

        $user->blocked_until = $request->blocked_until;
        $user->save();

        return redirect()->route('sysadmin.home');
    }

    public function unblockUser($id)
    {

        if (! $user = $this->checkUserIsValid($this->decryptUserId($id))) {
            return $this->redirectOnInvalidUser();
        }

        $user->blocked_until = null;
        $user->save();

        return redirect()->route('sysadmin.home');
    }

    public function deleteUser($id)
    {

        if (! $user = $this->checkUserIsValid($this->decryptUserId($id))) {
            return $this->redirectOnInvalidUser();
        }

        $user->delete();

        return redirect()->route('sysadmin.home');

    }

    public function restoreUser($id)
    {

        if (! $user = $this->checkUserIsValid($this->decryptUserId($id))) {
            return $this->redirectOnInvalidUser();
        }

        $user->restore();

        return redirect()->route('sysadmin.home');

    }

    private function decryptUserId($id)
    {

        try {
            return Crypt::decrypt($id);
        } catch (\Exception $e) {
            return null;
        }

    }

    private function checkUserIsValid($id)
    {

        $user = User::withTrashed()
            ->where('id', $id)
            ->where('id', '!=', auth()->user()->id)
            ->first();

        if (! $user) {
            return null;
        }

        return $user;
    }

    private function redirectOnInvalidUser()
    {

        return redirect()->route('sysadmin.home');
    }
}
