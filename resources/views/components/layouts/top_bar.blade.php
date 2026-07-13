<header class="bg-red text-white opacity-90 fixed top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-4 py-2 gap-2">

        <a href="{{ auth()->check() ? auth()->user()->homeRoute() : route('home') }}">
            <div class="flex items-center">
                <img src="{{ asset('assets/images/logo_texto_branco.png') }}" class="w-full h-10 rounded-full me-2" alt="Logo">
            </div>
        </a>    

    
        @can('guest-or-client')
            <nav class="hidden md:flex gap-8 text-lg font-medium">
                <a href="{{ route('home') }}" class="menu-link flex items-center gap-2">
                    <i class="fa-solid fa-house"></i> INÍCIO
                </a>
                <a href="{{ route('services') }}" class="menu-link flex items-center gap-2">
                    <i class="fa-solid fa-screwdriver-wrench"></i> SERVIÇOS
                </a>
                <a href="{{ route('contact.us') }}" class="menu-link flex items-center gap-2">
                    <i class="fa-solid fa-phone"></i> CONTATO
                </a>
                <a href="{{ route('about.us') }}" class="menu-link flex items-center gap-2">
                    <i class="fa-solid fa-circle-info"></i> SOBRE
                </a>
            </nav>
        @endcan

        <div class="hidden md:block relative">

            @auth
                <button id="profileBtn" class="flex items-center gap-2 bg-red-700 px-4 py-2 rounded-lg hover:bg-red-800 ">
                    {{ auth()->user()->name_surname ?? 'Perfil' }}
                    <i class="fa-regular fa-circle-user"></i>
                </button>

                <div id="profileMenu" class="hidden absolute right-0 mt-2 w-60 bg-red text-white shadow-lg p-2 z-50 ">
                    @can('client')
                        <a href="{{ route('profile') }}" class="block px-4 py-2 rounded-lg hover:bg-red-400">
                            <i class="fa-solid fa-user me-2"></i> Meus Agendamentos
                        </a>
                    @endcan

                    <a href="{{ route('logout') }}" class="block px-4 py-2 rounded-lg hover:bg-red-400">
                        <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Sair
                    </a>
                </div>
            @endauth

            @guest
                <a href="{{ route('login') }}"
                    class="flex items-center gap-2 bg-red-700 px-4 py-2 rounded-lg hover:bg-red-800">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Entre ou Cadastre-se
                </a>
            @endguest

        </div>

        <button id="menuBtn" class="md:hidden text-2xl">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>

    <div id="mobileMenu" class="hidden md:hidden bg-red-700 p-4 space-y-4">

        @can('guest-or-client')
            <a href="{{ route('home') }}" class="flex items-center gap-3 text-lg">
                <i class="fa-solid fa-house"></i> INÍCIO
            </a>

            <a href="{{ route('services') }}" class="flex items-center gap-3 text-lg">
                <i class="fa-solid fa-screwdriver-wrench"></i> SERVIÇOS
            </a>

            <a href="{{ route('contact.us') }}" class="flex items-center gap-3 text-lg">
                <i class="fa-solid fa-phone"></i> CONTATO
            </a>

            <a href="{{ route('about.us') }}" class="flex items-center gap-3 text-lg">
                <i class="fa-solid fa-circle-info"></i> SOBRE
            </a>
        @endcan

        <hr class="border-red-500">

        @auth
            <a href="{{ route('profile') }}" class="flex items-center gap-3 text-lg">
                <i class="fa-regular fa-circle-user"></i> Meus Agendamentos
            </a>

            <a href="{{ route('logout') }}" class="flex items-center gap-3 text-lg">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Sair
            </a>
        @endauth

        @guest
            <a href="{{ route('login') }}" class="flex items-center gap-3 text-lg">
                <i class="fa-solid fa-right-to-bracket"></i> Entre ou Cadastre-se
            </a>
        @endguest

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

    profileBtn?.addEventListener('click', () => {
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
    });
</script>
