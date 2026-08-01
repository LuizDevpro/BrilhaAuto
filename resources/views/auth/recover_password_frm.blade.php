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
                    Recuperar senha
                </h1>

                <p class="mb-6 text-center text-sm leading-relaxed text-white sm:text-base">
                    Informe o e-mail cadastrado em sua conta.
                    Enviaremos um link para que você possa definir uma nova senha.
                </p>

            </header>

            <form action="{{ route('recover.password.submit') }}" method="POST" novalidate>

                @csrf

                <div class="mb-6">

                    <label for="username" class="label block">
                        E-mail
                    </label>

                    <input type="email" id="username" name="username" class="input w-full"
                        placeholder="seuemail@exemplo.com" value="{{ old('username') }}">

                    {!! showValidationError('username', $errors) !!}
                    {!! showServerError() !!}

                </div>

                <button type="submit" class="btn-red w-full">
                    Recuperar senha
                </button>

            </form>

            <footer class="mt-6 text-center text-sm text-white">

                <span class="italic">
                    Lembrou da senha?
                </span>

                <a href="{{ route('login') }}" class="link ml-1">
                    Entrar
                </a>

            </footer>

        </article>

    </main>

</x-layouts.outside-layout>
