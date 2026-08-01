<footer class="mt-auto border-t border-red-700 bg-zinc-950 text-white">

    <div class="mx-auto grid max-w-7xl gap-10 px-6 py-10 md:grid-cols-3">

        {{-- Marca --}}
        <section>

            <img
                src="{{ asset('assets/images/logo_texto_branco.png') }}"
                alt="BrilhaAuto"
                class="mb-4 h-12 w-auto">

            <p class="text-sm leading-6 text-zinc-400">
                Sistema de agendamento online para lava-rápidos,
                desenvolvido para facilitar o atendimento e oferecer
                mais praticidade aos clientes.
            </p>

        </section>

        {{-- Navegação --}}
        <nav>

            <h2 class="mb-4 text-lg font-semibold text-white">
                Navegação
            </h2>

            <ul class="space-y-3 text-zinc-400">

                <li>
                    <a href="{{ route('home') }}" class="hover:text-red-500 transition">
                        Início
                    </a>
                </li>

                <li>
                    <a href="{{ route('services') }}" class="hover:text-red-500 transition">
                        Serviços
                    </a>
                </li>

                <li>
                    <a href="{{ route('about.us') }}" class="hover:text-red-500 transition">
                        Sobre
                    </a>
                </li>

                <li>
                    <a href="{{ route('contact.us') }}" class="hover:text-red-500 transition">
                        Contato
                    </a>
                </li>

            </ul>

        </nav>

        {{-- Contato --}}
        <section>

            <h2 class="mb-4 text-lg font-semibold">
                Contato
            </h2>

            <ul class="space-y-3 text-zinc-400">

                <li class="flex items-center gap-3">
                    <i class="fa-solid fa-envelope text-red-500"></i>
                    luizdev.pro@gmail.com
                </li>

                <li class="flex items-center gap-3">
                    <i class="fa-solid fa-phone text-red-500"></i>
                    (19) 98338-2653
                </li>

                <li class="flex items-center gap-3">
                    <i class="fa-solid fa-location-dot text-red-500"></i>
                    Tapiratiba - SP
                </li>

            </ul>

        </section>

    </div>

    <div class="border-t border-zinc-800">

        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-3 px-6 py-5 text-sm text-zinc-500 md:flex-row">

            <p>
                © {{ date('Y') }} BrilhaAuto. Todos os direitos reservados.
            </p>

            <div class="flex items-center gap-5">

                <a href="{{ route('privacy.policy') }}"
                    class="hover:text-red-500 transition">
                    Política de Privacidade
                </a>

                <a href="{{ route('terms.of.use') }}"
                    class="hover:text-red-500 transition">
                    Termos de Uso
                </a>

            </div>

        </div>

    </div>

</footer>