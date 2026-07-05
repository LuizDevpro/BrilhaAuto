<x-layouts.inside-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">

    <section class="w-full px-4 sm:px-6 lg:px-10 py-6">

        <header class="flex w-full items-center justify-between mb-8 gap-4 flex-wrap">
            <h1 class="title-2">Detalhes do Agendamento #{{ $appointment->id }}</h1>

            <a href="{{ route('admin.home') }}" class="btn-red whitespace-nowrap">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </header>

        <article class="info-card p-6 sm:p-8 space-y-8">

            <header>
                <h2 class="title-2 text-lg sm:text-xl text-center">
                    Agendamento {{ $appointment->appointment_datetime->format('d/m/Y H:i') }}
                    - {!! getAppointmentStatusTextColor($appointment->status) !!}
                </h2>
            </header>

            <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <article class="bg-zinc-900 rounded-xl p-5 border border-zinc-700 space-y-3">
                    <h3 class="font-semibold text-base text-red-500">
                        Status
                    </h3>

                    <ul class="space-y-2 text-sm text-zinc-200 list-none">
                        <li>
                            <strong>Status:</strong>
                            {!! getAppointmentStatusTextColor($appointment->status) !!}
                        </li>

                        <li>
                            <strong>Agendado para:</strong>
                            {{ $appointment->appointment_datetime->format('d/m/Y H:i') }}
                        </li>

                        <li>
                            <strong>Criado em:</strong>
                            {{ $appointment->created_at->format('d/m/Y H:i') }}
                        </li>

                        @if ($appointment->status === 'cancelado')
                            <li>
                                <strong>Cancelado em:</strong>
                                {{ $appointment->canceled_at?->format('d/m/Y H:i') }}
                            </li>

                            <div class="pt-3">
                                <a href="{{ route('admin.reactivate.appointment', ['appointment_id' => Crypt::encrypt($appointment->id)]) }}"
                                    class="px-3 py-2 rounded-lg bg-yellow-600 text-white text-xs inline-flex items-center gap-1">
                                    Reativar agendamento <i class="fa-solid fa-rotate-left"></i>
                                </a>
                            </div>
                        @elseif (is_null($appointment->started_at))
                            <li class="pt-3 flex gap-3 flex-wrap">
                                <a href="{{ route('admin.cancel.appointment', ['appointment_id' => Crypt::encrypt($appointment->id)]) }}"
                                    class="px-3 py-2 rounded-lg bg-red-600 text-white text-xs inline-flex items-center gap-1">
                                    Cancelar <i class="fa-solid fa-xmark"></i>
                                </a>

                                <a href="{{ route('admin.start.appointment', ['appointment_id' => Crypt::encrypt($appointment->id)]) }}"
                                    class="px-3 py-2 rounded-lg bg-blue-600 text-white text-xs inline-flex items-center gap-1">
                                    Começar <i class="fa-solid fa-clock"></i>
                                </a>
                            </li>
                        @elseif (is_null($appointment->finished_at))
                            <li>
                                <strong>Iniciado em:</strong>
                                {{ $appointment->started_at->format('d/m/Y H:i') }}
                            </li>

                            <li class="pt-3 flex gap-3 flex-wrap">
                                <a href="{{ route('admin.cancel.appointment', ['appointment_id' => Crypt::encrypt($appointment->id)]) }}"
                                    class="px-3 py-2 rounded-lg bg-red-600 text-white text-xs inline-flex items-center gap-1">
                                    Cancelar <i class="fa-solid fa-xmark"></i>
                                </a>

                                <a href="{{ route('admin.finish.appointment', ['appointment_id' => Crypt::encrypt($appointment->id)]) }}"
                                    class="px-3 py-2 rounded-lg bg-green-600 text-white text-xs inline-flex items-center gap-1">
                                    Finalizado <i class="fa-solid fa-check"></i>
                                </a>
                            </li>
                        @else
                            <li>
                                <strong>Finalizado em:</strong>
                                {{ $appointment->finished_at->format('d/m/Y H:i') }}
                            </li>

                            @if (is_null($appointment->delivered_at))
                                <div class="pt-3">
                                    <a href="{{ route('admin.delivered.appointment', ['appointment_id' => Crypt::encrypt($appointment->id)]) }}"
                                        class="px-3 py-2 rounded-lg bg-green-600 text-white text-xs inline-flex items-center gap-1">
                                        Entregue <i class="fa-solid fa-check"></i>
                                    </a>
                                </div>
                            @else
                                <li>
                                    <strong>Entregue em:</strong>
                                    {{ $appointment->delivered_at->format('d/m/Y H:i') }}
                                </li>
                            @endif
                        @endif
                    </ul>
                </article>



                <article class="bg-zinc-900 rounded-xl p-5 border border-zinc-700 space-y-4">
                    <h3 class="font-semibold text-base text-red-500">
                        Dados do Serviço
                    </h3>

                    <ul class="space-y-2 text-sm text-zinc-200">
                        <li>
                            <strong>Serviço:</strong>
                            {{ $appointment->service->name }}
                        </li>

                        <li>
                            <strong>Serviços adicionais:</strong>
                            @if ($appointment->additionalServices->isNotEmpty())
                                <ul class="list-disc list-inside mt-1 space-y-1">
                                    @foreach ($appointment->additionalServices as $additional)
                                        <li>{{ $additional->name }}</li>
                                    @endforeach
                                </ul>
                            @else
                                Nenhum
                            @endif
                        </li>

                        <li>
                            <strong>Forma de pagamento:</strong>
                            {{ $appointment->payment_method }}
                        </li>

                        <li>
                            <strong>Responsável:</strong>
                            @if ($appointment->responsible)
                                {{ $appointment->responsible }}
                            @else
                                <button id="assign_responsible_button"
                                    class="inline-flex items-center gap-1 text-xs text-red-400 hover:text-red-500 cursor-pointer">
                                    <i class="fa-solid fa-user-plus"></i> Atribuir responsável
                                </button>
                            @endif
                        </li>
                    </ul>
                </article>

                <article class="bg-zinc-900 rounded-xl p-5 border border-zinc-700 space-y-4">
                    <h3 class="font-semibold text-base text-red-500">
                        Dados do Veículo
                    </h3>

                    <ul class="space-y-2 text-sm text-zinc-200">
                        <li><strong>Tipo:</strong> {{ $appointment->vehicle_type }}</li>
                        <li><strong>Marca:</strong> {{ $appointment->vehicle_brand }}</li>
                        <li><strong>Modelo:</strong> {{ $appointment->vehicle_model }}</li>
                        <li><strong>Cor:</strong> {{ $appointment->vehicle_color }}</li>

                        @if (!empty($appointment->vehicle_plate))
                            <li><strong>Placa:</strong> {{ $appointment->vehicle_plate }}</li>
                        @endif

                        @if (!empty($appointment->observations))
                            <li>
                                <strong>Observações:</strong>
                                {{ $appointment->observations }}
                            </li>
                        @endif
                    </ul>
                </article>

                <article class="bg-zinc-900 rounded-xl p-5 border border-zinc-700 space-y-4">
                    <h3 class="font-semibold text-base text-red-500">
                        Dados do Cliente
                    </h3>

                    <ul class="space-y-2 text-sm text-zinc-200">
                        <li>
                            <strong>Nome:</strong>
                            {{ $appointment->user->name_surname }}
                        </li>

                        <li>
                            <strong>Telefone:</strong>
                            {{ $appointment->phone }}
                        </li>
                    </ul>
                </article>

                <article class="bg-zinc-900 rounded-xl p-5 border border-zinc-700 space-y-4">
                    <h3 class="font-semibold text-base text-red-500">
                        Endereço
                    </h3>

                    <p class="text-sm text-zinc-200">
                        <strong>Busca e entrega?</strong>
                        {{ $appointment->address ? 'Sim' : 'Não' }}
                    </p>

                    @if ($appointment->address)
                        <p class="text-sm text-zinc-200 leading-relaxed">
                            {{ $appointment->address->street }},
                            {{ $appointment->address->number }} —
                            {{ $appointment->address->neighborhood }}
                            @if (!empty($appointment->address->complement))
                                , {{ $appointment->address->complement }}
                            @endif
                        </p>
                    @endif
                </article>

            </section>

        </article>

        <div class="hidden" id="assign_responsible_form">
            <x-admin.admin-asign-responsible :appointment="$appointment" />
        </div>

    </section>

    <script>
        const assignResponsibleButton = document.querySelector('#assign_responsible_button');
        const assignResponsibleForm = document.querySelector('#assign_responsible_form');

        assignResponsibleButton.addEventListener('click', () => {
            assignResponsibleForm.classList.toggle('hidden');
        });
    </script>

</x-layouts.inside-layout>
