<x-layouts.outside-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">

    <main class="flex min-h-[72vh] items-center justify-center px-4 py-6 sm:px-6">

        <article class="input-card w-full max-w-md p-4 sm:max-w-lg sm:p-6">

            <header>

                <div class="flex justify-center items-center mb-1 gap-2">
                    <img src="{{ asset('assets/images/logo_texto.png') }}" alt="Logo"
                        class="h-15 w-80 object-cover select-none">
                </div>

                <div class="my-2 h-px w-full bg-red-600"></div>

                <h1 class="title-1 mb-4 text-center">
                    Definir senha
                </h1>

                <p class="mb-6 text-center text-sm leading-relaxed text-white sm:text-base">
                    A conta
                    <strong>{{ $user->email }}</strong>
                    foi localizada.
                    <br>
                    Defina uma nova senha para acessar a plataforma.
                </p>

            </header>

            <form action="{{ route('recover.password.define.new.submit') }}" method="POST" novalidate>

                @csrf

                <input type="hidden" name="user_id" value="{{ Crypt::encrypt($user->id) }}">

                <div class="mb-4">

                    <label for="password" class="label block">
                        Nova senha
                    </label>

                    <div class="relative">

                        <input type="password" id="password" name="password" class="input w-full pr-10"
                            placeholder="Digite sua nova senha">

                        <i id="togglePassword"
                            class="fa-regular fa-eye absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer hover:text-zinc-500"></i>

                    </div>

                    {!! showValidationError('password', $errors) !!}
                    {!! showServerError() !!}

                </div>

                <div class="mb-6">

                    <label for="password_confirmation" class="label block">
                        Confirmar senha
                    </label>

                    <div class="relative">

                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="input w-full pr-10" placeholder="Confirme sua nova senha">

                        <i id="togglePasswordConfirmation"
                            class="fa-regular fa-eye absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer hover:text-zinc-500"></i>

                    </div>

                    {!! showValidationError('password_confirmation', $errors) !!}

                </div>

                <button type="submit" class="btn-red w-full">
                    Definir senha
                </button>

            </form>

        </article>

    </main>

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
