<x-layouts.inside-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">

    <section class="w-full flex justify-center px-3 sm:px-6 py-6 sm:py-10">
        <article
            class="w-full max-w-6xl
                   bg-zinc-900/90
                   border border-zinc-700
                   rounded-2xl
                   shadow-lg
                   p-5 sm:p-8 lg:p-12">

            <header class="text-center mb-8 sm:mb-12">
                <h1 class="title-1 text-2xl sm:text-3xl lg:text-4xl font-bold">
                    Contato
                </h1>

                <div class="h-1 w-24 sm:w-40 bg-red-600 rounded-full mx-auto mt-4"></div>

                <p
                    class="text-zinc-400 mt-5
                           text-sm sm:text-base
                           max-w-2xl mx-auto
                           leading-relaxed">
                    Entre em contato conosco para tirar dúvidas, obter suporte
                    ou conhecer mais sobre a plataforma BrilhaAuto.
                </p>
            </header>

            <section
                class="grid
                       grid-cols-1
                       sm:grid-cols-2
                       xl:grid-cols-4
                       gap-4 sm:gap-5">

                <article
                    class="bg-zinc-800/60
                           border border-zinc-700
                           rounded-xl
                           p-5 sm:p-6
                           flex gap-4
                           items-start
                           hover:border-red-600/50
                           transition">

                    <div class="shrink-0">
                        <i class="fa-solid fa-envelope text-2xl text-red"></i>
                    </div>

                    <div class="min-w-0">
                        <h2 class="font-semibold text-base sm:text-lg text-white mb-1">
                            E-mail
                        </h2>

                        <p class="text-zinc-400 break-words text-sm sm:text-base">
                            contato@brilhaauto.com
                        </p>
                    </div>

                </article>

                <article
                    class="bg-zinc-800/60
                           border border-zinc-700
                           rounded-xl
                           p-5 sm:p-6
                           flex gap-4
                           items-start
                           hover:border-red-600/50
                           transition">

                    <div class="shrink-0">
                        <i class="fa-solid fa-phone text-2xl text-red"></i>
                    </div>

                    <div>
                        <h2 class="font-semibold text-base sm:text-lg text-white mb-1">
                            Telefone
                        </h2>

                        <p class="text-zinc-400 text-sm sm:text-base">
                            (35) 99999-9999
                        </p>
                    </div>

                </article>

                <article
                    class="bg-zinc-800/60
                           border border-zinc-700
                           rounded-xl
                           p-5 sm:p-6
                           flex gap-4
                           items-start
                           hover:border-red-600/50
                           transition">

                    <div class="shrink-0">
                        <i class="fa-solid fa-location-dot text-2xl text-red"></i>
                    </div>

                    <div>
                        <h2 class="font-semibold text-base sm:text-lg text-white mb-1">
                            Localização
                        </h2>

                        <p class="text-zinc-400 text-sm sm:text-base">
                            Tapiratiba - SP, Brasil
                        </p>
                    </div>

                </article>

                <article
                    class="bg-zinc-800/60
                           border border-zinc-700
                           rounded-xl
                           p-5 sm:p-6
                           flex gap-4
                           items-start
                           hover:border-red-600/50
                           transition">

                    <div class="shrink-0">
                        <i class="fa-solid fa-clock text-2xl text-red"></i>
                    </div>

                    <div>
                        <h2 class="font-semibold text-base sm:text-lg text-white mb-1">
                            Atendimento
                        </h2>

                        <p class="text-zinc-400 text-sm sm:text-base">
                            Segunda à Sexta<br>
                            06:00 às 19:00
                        </p>
                    </div>

                </article>

            </section>

        </article>
    </section>

</x-layouts.inside-layout>