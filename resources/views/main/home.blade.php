<x-layouts.inside-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}" :fullWidth="true">

    <section class="relative w-full h-screen overflow-hidden">

    <img
        src="{{ asset('assets/images/banner.png') }}"
        alt="Banner"
        class="absolute inset-0 w-full h-full object-cover">

    <div class="absolute inset-0 bg-black/60"></div>

    <section class="relative z-10 w-full h-screen md:w-1/2 flex items-center px-6 md:px-10">
        <div class="flex flex-col gap-6 md:gap-10 items-start max-w-md md:max-w-xl">

            <header class="flex flex-col gap-3 md:gap-4">
                <h1 class="text-white italic font-bold text-3xl sm:text-4xl lg:text-5xl">
                    Brilha Auto - Estética Automotiva
                </h1>

                <p class="text-zinc-200 text-base sm:text-lg">
                    Especialistas em estética automotiva, cuidando do seu carro com excelência.
                </p>
            </header>

            <a href="{{ route('services') }}" class="btn-red">
                Quero Agendar
                <i class="fa-regular fa-paper-plane"></i>
            </a>

        </div>
    </section>

</section>

</x-layouts.inside-layout>