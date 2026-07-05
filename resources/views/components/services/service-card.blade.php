<article class="info-card flex flex-col w-full max-w-sm p-6 sm:p-7 rounded-2xl bg-zinc-900/90 backdrop-blur border border-zinc-700 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">

    <header class="flex flex-col items-center text-center">
        <h2 class="title-2 text-lg sm:text-xl">
            {{ $service->name }}
        </h2>

        <div class="h-px w-full bg-red-600 my-3"></div>
    </header>

    <section class="flex-1 text-sm sm:text-base text-zinc-200 leading-relaxed">
        {!! $service->description !!}
    </section>

    <footer class="pt-6 flex justify-center">
        <a href="{{ route('services.service.description', ['service_id' => Crypt::encrypt($service->id)]) }}" class="btn-red flex items-center gap-2 whitespace-nowrap px-5 py-2.5">
            Mais informações
            <i class="fa-solid fa-circle-info"></i>
        </a>

    </footer>

</article>
