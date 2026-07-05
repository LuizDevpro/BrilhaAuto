<x-layouts.outside-layout subtitle="Sessão expirada">

    <section class="w-full min-h-[70vh] px-4 sm:px-6 lg:px-10 py-10 flex items-center justify-center">

        <article class="info-card max-w-xl w-full p-8 sm:p-10 text-center space-y-6">

            <header class="space-y-2">
                <h1 class="text-5xl font-bold text-red-500">419</h1>
                <h2 class="title-2 text-xl sm:text-2xl">
                    Sessão expirada
                </h2>
            </header>

            <p class="text-zinc-300 text-sm sm:text-base leading-relaxed">
                Sua sessão expirou por motivos de segurança.
                Atualize a página ou faça login novamente para continuar.
            </p>

            <footer class="flex flex-col sm:flex-row gap-4 justify-center pt-4">
                <button onclick="history.back()" class="btn-red">
                    <i class="fa-solid fa-arrow-left"></i> Voltar
                </button>
            </footer>

        </article>

    </section>

</x-layouts.outside-layout>
