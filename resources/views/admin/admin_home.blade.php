<x-layouts.inside-layout subtitle="{{ $subtitle ?? '' }}">
    <section class="w-full px-4 sm:px-6 lg:px-10 py-6 flex flex-col gap-10">

        <header class="w-full">
            <h1 class="title-1 font-bold">
                Agendamentos
            </h1>
        </header>

        <section aria-labelledby="today-title" class="space-y-6">
            <h2 id="today-title" class="title-2">
                Hoje
            </h2>

            @if ($today_appointments->count() > 0)
                <div class="mx-auto max-w-7xl grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($today_appointments as $appointment)
                        <x-admin.admin-appointment-preview :appointment="$appointment" />
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center gap-4 text-center">
                    <p class="text-white text-lg sm:text-2xl">
                        Não existem agendamentos para hoje
                    </p>

                    <button onclick="window.location.reload()"
                        class="text-lg text-white bg-red-700 rounded-full font-semibold px-4 py-3 hover:bg-red-800 transition cursor-pointer">
                        <i class="fa-solid fa-arrow-rotate-right"></i>
                    </button>
                </div>
            @endif
        </section>

        <div class="flex justify-center">
            <button id="btn-show-all" class="btn-red flex items-center gap-2">
                Ver todos
                <i class="fa-solid fa-angle-down"></i>
            </button>
        </div>

        <section id="all-appointments-section" aria-labelledby="all-title" class="hidden space-y-6">

            <header class="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
                <h2 id="all-title" class="title-2">
                    Todos os agendamentos
                </h2>

                <div class="flex items-center gap-3">
                    <label for="status-filter" class="text-lg text-white">
                        Filtrar por:
                    </label>

                    <select id="status-filter" class="input">
                        <option value="">Todos</option>
                        <option value="agendado">Agendado</option>
                        <option value="em_lavagem">Em lavagem</option>
                        <option value="finalizado">Finalizado</option>
                        <option value="entregue">Entregue</option>
                        <option value="cancelado">Cancelado</option>
                    </select>
                </div>
            </header>

            <div id="appointments-container"
                class="mx-auto max-w-7xl grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 text-center">

                <p id="no-results" class="hidden text-center text-white text-lg mt-6 col-span-full">
                    Nenhum agendamento encontrado para este filtro.
                </p>

                @foreach ($appointments as $appointment)
                    <article class="appointment-item" data-status="{{ $appointment->status }}">
                        <x-admin.admin-appointment-preview :appointment="$appointment" />
                    </article>
                @endforeach
            </div>
        </section>

    </section>

    <script>
        const btnShowAll = document.querySelector('#btn-show-all');
        const allSection = document.querySelector('#all-appointments-section');
        const statusFilter = document.querySelector('#status-filter');
        const appointmentItems = document.querySelectorAll('.appointment-item');
        const noResults = document.querySelector('#no-results');

        btnShowAll.addEventListener('click', () => {
            btnShowAll.classList.add('hidden');
            allSection.classList.remove('hidden');
            allSection.scrollIntoView({
                behavior: 'smooth'
            });
        });

        statusFilter.addEventListener('change', () => {
            const selected = statusFilter.value;
            let visibleCount = 0;

            appointmentItems.forEach(item => {
                const status = item.dataset.status;

                if (selected === '' || status === selected) {
                    item.classList.remove('hidden');
                    visibleCount++;
                } else {
                    item.classList.add('hidden');
                }
            });

            if (visibleCount === 0) {
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');
            }
        });
    </script>

</x-layouts.inside-layout>
