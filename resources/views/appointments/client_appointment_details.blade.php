<x-layouts.inside-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">

    <section class="w-full px-4 sm:px-6 lg:px-10 py-6">

        <header class="flex w-full items-center justify-between mb-8 gap-4 flex-wrap">
            <h1 class="title-2">Detalhes do Agendamento</h1>

            <a href="{{ route('profile') }}" class="btn-red whitespace-nowrap">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </header>

        <article class="info-card p-6 sm:p-8 space-y-8">

            <header>
                <h2 class="title-2 text-lg sm:text-xl">
                    Agendamento {{ $appointment->appointment_datetime->format('d/m/Y H:i') }}
                   - {!! getAppointmentStatusTextColor($appointment->status) !!}
                </h2>
            </header>

            <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <article class="bg-zinc-900 rounded-xl p-5 border border-zinc-700">
                    <h3 class="font-semibold text-base mb-4 text-red-500">
                        Dados do Serviço
                    </h3>

                    <ul class="space-y-2 text-sm text-zinc-200">
                        <li>
                            <strong>Serviço escolhido:</strong>
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
                    </ul>
                </article>

                <article class="bg-zinc-900 rounded-xl p-5 border border-zinc-700">
                    <h3 class="font-semibold text-base mb-4 text-red-500">
                        Dados do Veículo
                    </h3>

                    <ul class="space-y-2 text-sm text-zinc-200">
                        <li>
                            <strong>Tipo:</strong> {{ $appointment->vehicle_type }}
                        </li>
                        <li>
                            <strong>Marca:</strong> {{ $appointment->vehicle_brand }}
                        </li>
                        <li>
                            <strong>Modelo:</strong> {{ $appointment->vehicle_model }}
                        </li>
                        <li>
                            <strong>Cor:</strong> {{ $appointment->vehicle_color }}
                        </li>

                        @if (!empty($appointment->vehicle_plate))
                            <li>
                                <strong>Placa:</strong> {{ $appointment->vehicle_plate }}
                            </li>
                        @endif
                    </ul>
                </article>

                @if (!empty($appointment->address))
                    <article class="bg-zinc-900 rounded-xl p-5 border border-zinc-700">
                        <h3 class="font-semibold text-base mb-4 text-red-500">
                            Endereço
                        </h3>

                        <p class="text-sm text-zinc-200 leading-relaxed">
                            {{ $appointment->address->street }},
                            {{ $appointment->address->number }} —
                            {{ $appointment->address->neighborhood }}
                            @if (!empty($appointment->address->complement))
                                , {{ $appointment->address->complement }}
                            @endif
                        </p>
                    </article>
                @endif

            </section>

        </article>

    </section>

</x-layouts.inside-layout>
