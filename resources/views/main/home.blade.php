<x-layouts.inside-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">

   <section class="w-full h-full md:w-1/2 flex items-start md:items-center px-6 md:px-10">
        <div class="flex flex-col gap-10 items-start max-w-md w-full mx-auto">
            
            <header class="flex flex-col gap-4">
                <h1 class="text-red italic font-bold text-3xl">
                    Calori Car - Estética Automotiva
                </h1>

                <p class="text-zinc-500 text-lg">
                    Especialistas em estética automotiva, cuidando do seu carro com excelência.
                </p>
            </header>

            <a href="{{ route('services') }}" class="btn-red">
                Quero Agendar <i class="fa-regular fa-paper-plane"></i>
            </a>

        </div>
    </section>

</x-layouts.inside-layout>
