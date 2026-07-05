<article
    class="info-card {{ getAppointmentStatusBorderColor($appointment->status) }} flex flex-col w-full max-w-xs sm:max-w-sm
           p-5 sm:p-6 backdrop-blur
           shadow-md hover:shadow-lg
           transition-all duration-300
           hover:-translate-y-0.5">

    <header class="flex flex-col items-center text-center">
        <h2 class="title-2 text-base sm:text-lg">
            {{ $appointment->service->name }}
        </h2>

        <div class="h-px w-full {{ getAppointmentStatusHrColor($appointment->status) }} my-2.5"></div>
    </header>

    <section class="flex flex-col sm:flex-row justify-between items-center gap-3">
        <div class="flex-1 text-xs sm:text-sm text-zinc-200 leading-relaxed text-center sm:text-left">
            {!! getAppointmentStatusText($appointment->status) !!}
        </div>

        <div class="flex flex-1 flex-col items-center text-zinc-200 leading-relaxed text-center mt-2">
            <p class="text-lg sm:text-xl">
                {{ $appointment->appointment_datetime->format('d/m/Y') }}
            </p>
            <p class="text-lg sm:text-xl">
                {{ $appointment->appointment_datetime->format('H:i') }}
            </p>
        </div>
    </section>

    <footer class="pt-5 flex justify-center">
        <a href="{{ route('appointments.details', ['appointment_id' => Crypt::encrypt($appointment->id)]) }}"
           class="btn-red flex items-center gap-1.5
                  whitespace-nowrap
                  px-4 py-2
                  text-sm">
            Ver detalhes
            <i class="fa-solid fa-circle-info text-sm"></i>
        </a>
    </footer>

</article>
