<x-layouts.inside-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">

    <section class="w-full px-4 sm:px-6 lg:px-10 py-6">

        <header class="flex w-full items-center justify-between mb-8 gap-4 flex-wrap">
            <h1 class="title-2">Serviços</h1>

            <a href="{{ route('home') }}" class="btn-red whitespace-nowrap">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </header>

        <article class="w-full">
            <div class="mx-auto max-w-7xl flex flex-wrap justify-center gap-6 items-stretch">

                @foreach ($services as $service)
                    <x-services.service-card :service="$service" />
                @endforeach

            </div>
            </article>

    </section>

</x-layouts.inside-layout>
