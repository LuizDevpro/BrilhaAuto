<x-layouts.inside-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">

    <section class="w-full flex justify-center px-4 sm:px-6 py-6 sm:py-10">
        <article
            class="w-full max-w-md lg:max-w-xl
                   flex flex-col
                   rounded-2xl
                   bg-zinc-900/90
                   border border-zinc-700
                   shadow-lg
                   p-5 sm:p-8
                   gap-6">

            <header class="text-center">
                <h2 class="title-2 text-lg sm:text-xl">
                    {{ $service->name }}
                </h2>

                <div class="h-px w-3/4 mx-auto bg-red-600 mt-3"></div>
            </header>

            <section class="text-sm sm:text-base text-zinc-200 leading-relaxed">
                {!! $service->description !!}
            </section>

            <section class="space-y-4">
                <h3 class="title-2 text-center text-red-600 text-base sm:text-lg">
                    Preços base por categoria
                </h3>

                <ul class="space-y-2 text-sm sm:text-base text-zinc-200">
                    @foreach ($service->prices as $price)
                        <li class="flex items-center gap-2">
                            <span class="whitespace-nowrap">
                                {{ $price->vehicle_type }}
                            </span>

                            <span class="flex-1 border-b border-dotted border-zinc-600"></span>

                            <span class="whitespace-nowrap font-medium">
                                {!! formatPrice($price->price) !!}
                            </span>
                        </li>
                    @endforeach
                </ul>

                <p class="text-xs text-zinc-400 leading-snug">
                    * Preços base. O valor final pode variar conforme serviços adicionais
                    e nível de sujeira.
                </p>
            </section>

            <footer class="flex flex-col sm:flex-row justify-center gap-3 pt-2">
                <a
                    href="{{ route('services') }}"
                    class="btn-red-reverse w-full sm:w-auto flex items-center justify-center gap-2 px-4 py-2 text-sm">
                    <i class="fa-solid fa-arrow-left"></i>
                    Voltar
                </a>

                <a
                    href="{{ route('appointments.new.appointment', ['service_id' => Crypt::encrypt($service->id)]) }}"
                    class="btn-red w-full sm:w-auto flex items-center justify-center gap-2 px-4 py-2 text-sm">
                    Quero Este
                    <i class="fa-solid fa-check"></i>
                </a>
            </footer>

        </article>
    </section>

</x-layouts.inside-layout>
