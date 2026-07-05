<article
    class="info-card {{ getAppointmentStatusBorderColor($appointment->status) }}
           flex flex-col w-full sm:max-w-sm
           max-w-md
           p-4 sm:p-5
           backdrop-blur
           shadow-sm hover:shadow-md
           transition-all duration-300
           hover:-translate-y-0.5">

    <header class="space-y-2">

        <div class="flex items-center gap-2 text-md text-zinc-200">
            <i class="fa-solid fa-user text-red-500 text-xs"></i>
            <span class="truncate">
                {{ $appointment->user->name_surname }}
            </span>
        </div>

        <div class="flex items-center gap-2 text-md text-zinc-200">
            <i class="fa-solid fa-screwdriver-wrench text-red-500 text-xs"></i>
            <span class="truncate">
                {{ $appointment->service->name }}
            </span>
        </div>

        <div class="flex items-center gap-2 text-md text-zinc-200">
            <i class="fa-solid fa-phone text-red-500 text-xs"></i>
            <span>
                {{ $appointment->phone }}
            </span>
        </div>

        <div class="h-px w-full {{ getAppointmentStatusHrColor($appointment->status) }} mt-3"></div>
    </header>

    <section class="flex justify-between items-center gap-3 mt-3">

        <div class="flex flex-col text-zinc-200 text-md">
            <span class="font-medium">
                {{ $appointment->appointment_datetime->format('d/m/Y') }}
            </span>
            <span class="text-xs text-zinc-400">
                {{ $appointment->appointment_datetime->format('H:i') }}
            </span>
        </div>

        <div class="text-right text-zinc-200 text-md font-semibold">
            {!! formatPrice($appointment->total_price) !!}
        </div>

    </section>

    <footer class="mt-4 flex justify-between items-center">

        <a href="{{ route('admin.appointment.details', ['appointment_id' => Crypt::encrypt($appointment->id)]) }}"
           class="btn-red px-3 py-1.5 text-xs flex items-center gap-1">
            Detalhes
            <i class="fa-solid fa-circle-info text-xs"></i>
        </a>

        <span class="text-sm text-zinc-400">
            #{{ $appointment->id }}
        </span>

    </footer>

</article>
