<x-layouts.outside-layout subtitle="Página não encontrada">


    <section class="w-full min-h-[70vh] px-4 sm:px-6 lg:px-10 py-10 flex items-center justify-center">

        <article class="info-card max-w-xl w-full p-8 sm:p-10 text-center space-y-6">

            <header class="space-y-2">
                <h1 class="text-5xl font-bold text-red-500">404</h1>
                <h2 class="title-2 text-xl sm:text-2xl">
                    Página não encontrada
                </h2>
            </header>

            <p class="text-zinc-300 text-sm sm:text-base leading-relaxed">
                A página que você tentou acessar não existe, foi removida
                ou o endereço informado está incorreto.
            </p>

            <footer class="flex flex-col sm:flex-row gap-4 justify-center pt-4">
                <button onclick="history.back()" class="btn-red">
                    <i class="fa-solid fa-arrow-left"></i> Voltar
                </button>
            </footer>

        </article>

    </section>



</x-layouts.outside-layout>