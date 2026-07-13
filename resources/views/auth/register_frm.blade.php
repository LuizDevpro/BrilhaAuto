<x-layouts.outside-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">

    <section class="min-h-[72vh] flex items-center justify-center px-4 sm:px-6">

        <div class="input-card w-full max-w-md sm:max-w-lg p-3 sm:p-4">

            <div class="flex justify-center items-center mb-1 gap-2">
                <img src="{{ asset('assets/images/logo_texto.png') }}" alt="Logo"
                    class="h-15 w-80 object-cover select-none">
            </div>

            <div class="h-px w-full bg-red-600 my-1"></div>

            <p class="title-1 text-center mb-1 text-sm sm:text-base">
                Cadastrar-se
            </p>

            <form action="{{ route('register.submit') }}" method="post" novalidate>
                @csrf

                <div class="mb-0.5">
                    <label for="name_surname" class="label block text-xs">
                        Nome e Sobrenome
                    </label>
                    <input type="text" class="input w-full py-0.5 text-sm" id="name_surname" name="name_surname"
                        placeholder="Ex: José Silva" value="{{ old('name_surname') }}">
                    {!! showValidationError('name_surname', $errors) !!}
                    {!! showServerError() !!}
                </div>

                <div class="mb-0.5">
                    <label for="email" class="label block text-xs">
                        E-mail
                    </label>
                    <input type="email" class="input w-full py-0.5 text-sm" id="email" name="email"
                        placeholder="seuemail@gmail.com" value="{{ old('email') }}">
                    {!! showValidationError('email', $errors) !!}
                </div>

                <div class="mb-0.5">
                    <label for="password" class="label block text-xs">
                        Senha
                    </label>

                    <div class="relative">
                        <input type="password" class="input w-full py-0.5 text-sm pr-8" id="password" name="password"
                            placeholder="suasenhaaqui">

                        <i class="fa-regular fa-eye absolute right-2 top-1/2 -translate-y-1/2 cursor-pointer hover:text-zinc-600"
                            id="togglePassword"></i>
                    </div>

                    {!! showValidationError('password', $errors) !!}
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="label block text-xs">
                        Confirmar Senha
                    </label>

                    <div class="relative">
                        <input type="password" class="input w-full py-0.5 text-sm pr-8" id="password_confirmation"
                            name="password_confirmation" placeholder="confirme sua senha">

                        <i class="fa-regular fa-eye absolute right-2 top-1/2 -translate-y-1/2 cursor-pointer hover:text-zinc-600"
                            id="togglePasswordConfirmation"></i>
                    </div>
                </div>

                <div class="text-center mb-1">
                    <button type="submit" class="btn-red w-full sm:w-auto px-4 py-0.5 text-sm">
                        Cadastrar-se
                    </button>
                </div>

            </form>

            <div class="flex flex-col sm:flex-row text-white text-xs text-center mt-1 justify-center items-center gap-1">
                <p class="italic">Já tem uma conta?</p>
                <a href="{{ route('login') }}" class="link">
                    Entre aqui
                </a>
            </div>

        </div>

    </section>

    <script>
        function togglePassword(inputId, eyeId) {
            const input = document.getElementById(inputId);
            const eye = document.getElementById(eyeId);

            eye.addEventListener('click', () => {
                input.type = input.type === 'password' ? 'text' : 'password';
                eye.classList.toggle('fa-eye');
                eye.classList.toggle('fa-eye-slash');
            });
        }

        togglePassword('password', 'togglePassword');
        togglePassword('password_confirmation', 'togglePasswordConfirmation');
    </script>

</x-layouts.outside-layout>
