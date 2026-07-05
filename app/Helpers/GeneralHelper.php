<?php

if (! function_exists('showValidationError')) {
    function showValidationError($fieldName, $validationErrors)
    {
        if ($validationErrors->has($fieldName)) {
            return '<div class="text-sm italic text-red-500">'.$validationErrors->first($fieldName).'</div>';
        } else {
            return '';
        }
    }
}

if (! function_exists('showServerError')) {
    function showServerError()
    {
        if (session()->has('server_error')) {
            return '<div class="text-sm italic text-red-500">'.session()->get('server_error').'</div>';
        } else {
            return '';
        }
    }
}

if (! function_exists('showServerErrorForm')) {
    function showServerErrorForm()
    {
        if (session()->has('server_error')) {
            return '<div class="text-sm italic text-white">'.session()->get('server_error').'</div>';
        } else {
            return '';
        }
    }
}

if (! function_exists('formatPrice')) {
    function formatPrice($price)
    {
       return 'R$ ' . number_format($price / 100, 2, ',', '.');
    }
}


if (! function_exists('getAppointmentStatusText')) {
    function getAppointmentStatusText($appointment_status) 
    {
        if($appointment_status === 'agendado'){
            return '<p class="text-yellow-300 text-2xl font-semibold">Agendado</p>';
        } else if($appointment_status === 'em_lavagem'){
            return '<p class="text-blue-800 text-2xl font-semibold">Em lavagem</p>';
        } else if($appointment_status === 'finalizado'){
            return '<p class="text-green-700 text-2xl font-semibold">Finalizado</p>';
        } else if($appointment_status === 'entregue'){
            return '<p class="text-green-700 text-2xl font-semibold">Entregue</p>';
        } else if($appointment_status === 'cancelado'){
            return '<p class="text-red-700 text-2xl font-semibold">Cancelado</p>';
        }
    }
}
if (! function_exists('getAppointmentStatusTextColor')) {
    function getAppointmentStatusTextColor($appointment_status) 
    {
        if($appointment_status === 'agendado'){
            return '<span class="text-yellow-300 block sm:inline">Agendado</span>';
        } else if($appointment_status === 'em_lavagem'){
            return '<span class="text-blue-800 block sm:inline">Em lavagem</span>';
        } else if($appointment_status === 'finalizado'){
            return '<span class="text-green-700 block sm:inline">Finalizado</span>';
        } else if($appointment_status === 'entregue'){
            return '<span class="text-green-700 block sm:inline">Entregue</span>';
        } else if($appointment_status === 'cancelado'){
            return '<span class="text-red-700 block sm:inline">Cancelado</span>';
        }
    }
}
if (! function_exists('getAppointmentStatusBorderColor')) {
    function getAppointmentStatusBorderColor($appointment_status) 
    {
        if($appointment_status === 'agendado'){
            return 'border-yellow-300!';
        } else if($appointment_status === 'em_lavagem'){
            return 'border-blue-800!';
        } else if($appointment_status === 'finalizado'){
            return 'border-green-700!';
        } else if($appointment_status === 'entregue'){
            return 'border-green-700!';
        } else if($appointment_status === 'cancelado'){
            return 'border-red-700!';
        }
    }
}
if (! function_exists('getAppointmentStatusHrColor')) {
    function getAppointmentStatusHrColor($appointment_status) 
    {
        if($appointment_status === 'agendado'){
            return 'bg-yellow-300!';
        } else if($appointment_status === 'em_lavagem'){
            return 'bg-blue-800!';
        } else if($appointment_status === 'finalizado'){
            return 'bg-green-700!';
        } else if($appointment_status === 'entregue'){
            return 'bg-green-700!';
        } else if($appointment_status === 'cancelado'){
            return 'bg-red-700!';
        }
    }
}

if (! function_exists('getUserStatus')) {
    function getUserStatus($user)
    {

        if ($user->password === null || $user->active === 0 || $user->blocked_until > now()) {
            return '<i class="fa-regular fa-circle-xmark text-red-700 me-2" title="Inativo"></i>Inativo';
        } else {
            return '<i class="fa-regular fa-circle-check text-green-700 me-2" title="Ativo"></i>Ativo';
        }

    }

}

if (! function_exists('getUserRole')) {
    function getUserRole($role)
    {

        $roles = [
            'sys-admin' => '<i class="fa-solid fa-user-shield me-2" title="Administrador do Sistema"></i>Administrador do Sistema',
            'admin' => '<i class="fa-solid fa-user-gear me-2" title="Administrador"></i>Administrador',
            'client' => '<i class="fa-solid fa-user me-2" title="Cliente"></i>Cliente',
        ];

        return $roles[$role] ?? 'Desconhecido';
    }
}

if (! function_exists('getUserAvailableActions')) {
    function getUserAvailableActions($user)
    {
        $actions = [];

        if ($user->id === Auth::user()->id) {
            return $actions;
        }

        $user->deleted_at !== null ? $actions[] = 'Recuperar' : $actions[] = 'Excluir';

        $user->active === 1 ? $actions[] = 'Desativar' : $actions[] = 'Ativar';

        ($user->blocked_until !== null && $user->blocked_until > now()) ? $actions[] = 'Desbloquear' : $actions[] = 'Bloquear';

        $actions[] = 'Senha';

        $links = [];
        $id = ['id' => Crypt::encrypt($user->id)];

        if (in_array('Senha', $actions)) {
            $links[] = '<a href="'.route('sysadmin.user.force.password.reset', $id).'" class="btn-white" title="Resetar senha"><i class="fa-solid fa-key"></i></a>';
        }

        if (in_array('Ativar', $actions)) {
            $links[] = '<a href="'.route('sysadmin.user.activate', $id).'" class="btn-white" title="Ativar"><i class="fa-solid fa-circle-check text-green-700"></i></a>';
        }

        if (in_array('Desativar', $actions)) {
            $links[] = '<a href="'.route('sysadmin.user.deactivate', $id).'" class="btn-white" title="Desativar"><i class="fa-solid fa-circle-xmark text-red-700"></i></a>';
        }

        if (in_array('Bloquear', $actions)) {
            $links[] = '<a href="'.route('sysadmin.user.block', $id).'" class="btn-white" title="Bloquear"><i class="fa-solid fa-user-lock text-red-500"></i></a>';
        }

        if (in_array('Desbloquear', $actions)) {
            $links[] = '<a href="'.route('sysadmin.user.unblock', $id).'" class="btn-white" title="Desbloquear"><i class="fa-solid fa-lock-open text-green-700"></i></a>';
        }

        if (in_array('Excluir', $actions)) {
            $links[] = '<a href="'.route('sysadmin.user.delete', $id).'" class="btn-white" title="Excluir"><i class="fa-solid fa-trash text-red-700"></i></a>';
        }

        if (in_array('Recuperar', $actions)) {
            $links[] = '<a href="'.route('sysadmin.user.restore', $id).'" class="btn-white" title="Recuperar"><i class="fa-solid fa-trash-arrow-up text-green-700"></i></a>';
        }

        return $links;
    }
}