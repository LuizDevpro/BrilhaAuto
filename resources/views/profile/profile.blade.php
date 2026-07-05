<x-layouts.inside-layout subtitle="{{ $subtitle ?? '' }}">
    <section class="w-full px-4 sm:px-6 lg:px-10 py-6 flex flex-col gap-10">

        <header class="flex w-full items-center justify-between gap-4 flex-wrap">
            <h1 class="title-2">Meus Agendamentos</h1>

            <a href="{{ route('home') }}" class="btn-red whitespace-nowrap">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </header>

        @if ($future_appointments->count() > 0)

            <section aria-labelledby="future-appointments">
                <h2 id="future-appointments" class="sr-only">
                    Agendamentos Futuros
                </h2>

                <div class="mx-auto max-w-7xl flex flex-wrap justify-center gap-6 items-stretch">
                    @foreach ($future_appointments as $appointment)
                        <x-profile.appointment-status :appointment="$appointment" />
                    @endforeach
                </div>
            </section>

            @if ($past_appointments->count() > 0)
                <section aria-labelledby="past-appointments" class="mt-6">
                    <header class="mb-8">
                        <h2 id="past-appointments" class="title-2">
                            Agendamentos Passados
                        </h2>
                    </header>

                    <div class="mx-auto max-w-7xl flex flex-wrap justify-center gap-6 items-stretch">
                        @foreach ($past_appointments as $appointment)
                            <x-profile.appointment-status :appointment="$appointment" />
                        @endforeach
                    </div>
                </section>
            @endif

        @else
            <section class="flex flex-col items-center justify-center gap-10 text-center mt-10">
                <p class="text-white text-2xl">
                    Você ainda não tem nenhum agendamento.
                </p>

                <a href="{{ route('services') }}" class="btn-red">
                    Quero Agendar <i class="fa-regular fa-paper-plane"></i>
                </a>
            </section>
        @endif

    </section>
</x-layouts.inside-layout>
