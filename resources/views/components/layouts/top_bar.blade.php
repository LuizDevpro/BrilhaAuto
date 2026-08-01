<header class="fixed top-0 left-0 z-50 w-full bg-red-700/95 text-white shadow-md">

    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">

        <a href="{{ auth()->check() ? auth()->user()->homeRoute() : route('home') }}" class="flex items-center shrink-0">

            <img src="{{ asset('assets/images/logo_texto_branco.png') }}" alt="Logo BrilhaAuto"
                class="h-9 sm:h-10 w-auto object-contain select-none">

        </a>

        @can('guest-or-client')
            <nav class="hidden md:flex items-center gap-7 lg:gap-8 text-[15px] font-medium">

                <a href="{{ route('home') }}" class="menu-link flex items-center gap-2 whitespace-nowrap">
                    <i class="fa-solid fa-house"></i>
                    <span>INÍCIO</span>
                </a>

                <a href="{{ route('services') }}" class="menu-link flex items-center gap-2 whitespace-nowrap">
                    <i class="fa-solid fa-screwdriver-wrench"></i>
                    <span>SERVIÇOS</span>
                </a>

                <a href="{{ route('contact.us') }}" class="menu-link flex items-center gap-2 whitespace-nowrap">
                    <i class="fa-solid fa-phone"></i>
                    <span>CONTATO</span>
                </a>

                <a href="{{ route('about.us') }}" class="menu-link flex items-center gap-2 whitespace-nowrap">
                    <i class="fa-solid fa-circle-info"></i>
                    <span>SOBRE</span>
                </a>

            </nav>
        @endcan

        <div class="hidden md:block relative">

            @auth

                <button id="profileBtn"
                    class="flex max-w-60 items-center gap-2 rounded-lg bg-red-700 px-4 py-2 transition hover:bg-red-800">

                    <span class="truncate">
                        {{ auth()->user()->name_surname ?? 'Perfil' }}
                    </span>

                    <i class="fa-regular fa-circle-user text-lg"></i>

                </button>

                <div id="profileMenu"
                    class="absolute right-0 mt-2 hidden w-64 rounded-xl border border-red-500 bg-red p-2 shadow-xl">
                    @can('client')
                        <a href="{{ route('profile') }}"
                            class="flex items-center gap-3 rounded-lg px-4 py-3 transition hover:bg-red-500">

                            <i class="fa-solid fa-user w-5 text-center"></i>

                            <span>Meus Agendamentos</span>

                        </a>
                    @endcan

                    <a href="{{ route('logout') }}"
                        class="flex items-center gap-3 rounded-lg px-4 py-3 transition hover:bg-red-500">

                        <i class="fa-solid fa-arrow-right-from-bracket w-5 text-center"></i>

                        <span>Sair</span>

                    </a>

                </div>

            @endauth

            @guest

                <a href="{{ route('login') }}"
                    class="flex items-center gap-2 whitespace-nowrap rounded-lg bg-red-700 px-4 py-2 transition hover:bg-red-800">

                    <i class="fa-solid fa-right-to-bracket"></i>

                    <span>Entre ou Cadastre-se</span>

                </a>

            @endguest

        </div>

        <button id="menuBtn" class="rounded-lg p-2 text-2xl transition hover:bg-red-700 md:hidden"
            aria-label="Abrir menu">

            <i class="fa-solid fa-bars"></i>

        </button>

    </div>

    <div id="mobileMenu" class="hidden border-t border-red-500 bg-red-700 md:hidden">

        <div class="flex flex-col gap-2 px-4 py-5">

            @can('guest-or-client')
                <a href="{{ route('home') }}"
                    class="flex items-center gap-3 rounded-lg px-3 py-3 transition hover:bg-red-600">

                    <i class="fa-solid fa-house w-5 text-center"></i>

                    <span>INÍCIO</span>

                </a>

                <a href="{{ route('services') }}"
                    class="flex items-center gap-3 rounded-lg px-3 py-3 transition hover:bg-red-600">

                    <i class="fa-solid fa-screwdriver-wrench w-5 text-center"></i>

                    <span>SERVIÇOS</span>

                </a>

                <a href="{{ route('contact.us') }}"
                    class="flex items-center gap-3 rounded-lg px-3 py-3 transition hover:bg-red-600">

                    <i class="fa-solid fa-phone w-5 text-center"></i>

                    <span>CONTATO</span>

                </a>

                <a href="{{ route('about.us') }}"
                    class="flex items-center gap-3 rounded-lg px-3 py-3 transition hover:bg-red-600">

                    <i class="fa-solid fa-circle-info w-5 text-center"></i>

                    <span>SOBRE</span>

                </a>
            @endcan

            <hr class="my-2 border-red-500">
            @auth

                @can('client')
                    <a href="{{ route('profile') }}"
                        class="flex items-center gap-3 rounded-lg px-3 py-3 transition hover:bg-red-600">

                        <i class="fa-regular fa-circle-user w-5 text-center"></i>

                        <span>Meus Agendamentos</span>

                    </a>
                @endcan

                <a href="{{ route('logout') }}"
                    class="flex items-center gap-3 rounded-lg px-3 py-3 transition hover:bg-red-600">

                    <i class="fa-solid fa-arrow-right-from-bracket w-5 text-center"></i>

                    <span>Sair</span>

                </a>

            @endauth

            @guest

                <a href="{{ route('login') }}"
                    class="flex items-center gap-3 rounded-lg px-3 py-3 transition hover:bg-red-600">

                    <i class="fa-solid fa-right-to-bracket w-5 text-center"></i>

                    <span>Entre ou Cadastre-se</span>

                </a>

            @endguest

        </div>

    </div>

</header>

<script>
    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    const profileBtn = document.getElementById('profileBtn');
    const profileMenu = document.getElementById('profileMenu');

    menuBtn?.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    profileBtn?.addEventListener('click', (e) => {
        e.stopPropagation();
        profileMenu.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {

        if (
            profileBtn &&
            profileMenu &&
            !profileBtn.contains(e.target) &&
            !profileMenu.contains(e.target)
        ) {
            profileMenu.classList.add('hidden');
        }

        if (
            menuBtn &&
            mobileMenu &&
            !menuBtn.contains(e.target) &&
            !mobileMenu.contains(e.target)
        ) {
            mobileMenu.classList.add('hidden');
        }

    });

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) {
            mobileMenu.classList.add('hidden');
        }
    });
</script>
