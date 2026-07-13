<x-layouts.inside-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">

    <section class="w-full flex justify-center px-4 sm:px-6 py-8 sm:py-12">
        <article
            class="w-full max-w-4xl bg-zinc-900/90 border border-zinc-700 rounded-2xl shadow-lg p-6 sm:p-8 lg:p-12">

            <header class="text-center mb-8 sm:mb-10">
                <h1 class="title-1 text-3xl sm:text-4xl font-bold">
                    Sobre Nós
                </h1>

                <div class="h-1 w-1/2 sm:w-1/4 bg-red-600 rounded-full mx-auto mt-4"></div>

                <p class="text-zinc-400 mt-6 text-sm sm:text-base max-w-2xl mx-auto">
                    Conheça a missão da BrilhaAuto e como buscamos tornar o cuidado
                    com o seu veículo mais simples, moderno e acessível.
                </p>
            </header>

            <section
                class="space-y-6 text-zinc-200 text-sm sm:text-base leading-7 sm:leading-8">

                <p>
                    A <strong class="text-red">BrilhaAuto</strong> nasceu com o objetivo
                    de tornar o agendamento de lavagens automotivas mais simples,
                    rápido e moderno. Sabemos que a correria do dia a dia muitas vezes
                    dificulta encontrar tempo para cuidar do veículo, por isso criamos
                    uma plataforma que conecta clientes e serviços de lavagem de forma
                    prática e eficiente.
                </p>

                <p>
                    Nosso propósito é oferecer uma experiência intuitiva, permitindo
                    que os usuários agendem serviços com poucos cliques, escolham
                    horários disponíveis e acompanhem seus agendamentos de maneira
                    organizada.
                </p>

                <p>
                    Na BrilhaAuto, acreditamos que tecnologia e praticidade podem
                    transformar tarefas do cotidiano em processos mais simples.
                    Por isso, buscamos desenvolver soluções que proporcionem mais
                    comodidade, organização e agilidade tanto para os clientes quanto
                    para os estabelecimentos parceiros.
                </p>

                <p>
                    Mais do que um sistema de agendamento, a BrilhaAuto representa
                    <strong class="text-red">
                        inovação, confiança e compromisso
                    </strong>
                    em facilitar o cuidado com o seu veículo.
                </p>
            </section>

            <section
                class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-10">

                <article
                    class="bg-zinc-800/60 border border-zinc-700 rounded-xl p-5 text-center">
                    <i class="fa-solid fa-calendar-check text-3xl text-red mb-3"></i>

                    <h2 class="font-semibold text-white text-lg mb-2">
                        Praticidade
                    </h2>

                    <p class="text-zinc-400 text-sm">
                        Agende serviços em poucos cliques, de forma rápida e intuitiva.
                    </p>
                </article>

                <article
                    class="bg-zinc-800/60 border border-zinc-700 rounded-xl p-5 text-center">
                    <i class="fa-solid fa-bolt text-3xl text-red mb-3"></i>

                    <h2 class="font-semibold text-white text-lg mb-2">
                        Agilidade
                    </h2>

                    <p class="text-zinc-400 text-sm">
                        Menos burocracia e mais organização para clientes e parceiros.
                    </p>
                </article>

                <article
                    class="bg-zinc-800/60 border border-zinc-700 rounded-xl p-5 text-center">
                    <i class="fa-solid fa-shield-halved text-3xl text-red mb-3"></i>

                    <h2 class="font-semibold text-white text-lg mb-2">
                        Confiança
                    </h2>

                    <p class="text-zinc-400 text-sm">
                        Uma plataforma desenvolvida para oferecer segurança e comodidade.
                    </p>
                </article>

            </section>

        </article>
    </section>

</x-layouts.inside-layout>