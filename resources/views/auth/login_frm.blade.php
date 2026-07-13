<x-layouts.outside-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">

    <section class="min-h-[85vh] flex items-center justify-center px-4 sm:px-6 lg:px-8">

        <div class="input-card w-full max-w-md sm:max-w-lg p-5 sm:p-6">

            <div class="flex justify-center items-center mb-3 sm:mb-4 gap-2">
                <img src="{{ asset('assets/images/logo_texto.png') }}" alt="Logo"
                    class="h-20 w-90 object-cover select-none">
            </div>

            <div class="h-px w-full bg-red-600 my-2"></div>

            <p class="title-1 text-center mb-4 text-xl sm:text-2xl">
                Entrar
            </p>

            <form action="{{ route('login.submit') }}" method="post" novalidate>
                @csrf

                <div class="mb-3">
                    <label for="email" class="label block mb-1 text-sm">
                        E-mail
                    </label>

                    <input type="email" class="input w-full py-1.5 text-sm" id="email" name="email"
                        placeholder="seuemail@gmail.com" value="{{ old('email') }}">
                    {!! showValidationError('email', $errors) !!}
                    {!! showServerError() !!}
                </div>

                <div class="mb-3">
                    <label for="password" class="label block mb-1 text-sm">
                        Senha
                    </label>

                    <div class="relative">
                        <input type="password" class="input w-full pr-9 py-1.5 text-sm" id="password" name="password"
                            placeholder="suasenhaaqui">

                        <i class="fa-regular fa-eye absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer hover:text-zinc-600"
                            id="togglePassword" title="Mostrar senha"></i>
                    </div>

                    {!! showValidationError('password', $errors) !!}
                </div>

                <div class="text-right text-xs sm:text-sm font-light italic text-white mb-4">
                    <a href="#" class="link">
                        Esqueci minha senha
                    </a>
                </div>

                <div class="text-center mb-3">
                    <button type="submit" class="btn-red w-full sm:w-auto px-7 py-1.5 text-sm">
                        Entrar
                    </button>
                </div>

            </form>

            <div
                class="flex flex-col sm:flex-row text-white text-sm text-center mt-2 justify-center items-center gap-1">
                <p class="italic">Ainda não tem uma conta?</p>
                <a href="{{ route('register') }}" class="link">Cadastre-se</a>
            </div>

        </div>

    </section>

    <script>
        const passInput = document.querySelector("#password");
        const passEye = document.querySelector("#togglePassword");

        passEye.addEventListener('click', () => {
            passInput.type = passInput.type === 'password' ? 'text' : 'password';

            passEye.classList.toggle('fa-eye');
            passEye.classList.toggle('fa-eye-slash');

            passEye.title = passEye.title === 'Mostrar senha' ? 'Esconder senha' : 'Mostrar senha';
        });
    </script>

</x-layouts.outside-layout>
