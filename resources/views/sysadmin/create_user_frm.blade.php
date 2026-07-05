<x-layouts.inside-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">

    <section class="w-full flex justify-center items-center">
        <article class="w-full max-w-xl bg-zinc-900 border border-zinc-700 rounded-2xl p-6 sm:p-8 space-y-8 h-fit">

            <header class="flex items-center justify-between">
                <h1 class="title-2 font-semibold">
                    Novo usuário
                </h1>

            </header>

            <hr class="border-zinc-700">

            <form
                action="{{ route('sysadmin.user.create.submit') }}"
                method="post"
                novalidate
                class="space-y-4">

                @csrf

                <div>
                    <label for="role" class="label block text-sm">Perfil</label>
                    <select name="role" id="role" class="input w-full">
                        <option value="admin" {{ old('role', 'admin') === 'admin' ? 'selected' : '' }}>Administrador</option>
                        <option value="client" {{ old('role') === 'client' ? 'selected' : '' }}>Usuário</option>
                    </select>
                    {!! showValidationError('role', $errors) !!}
                </div>

                <div>
                    <label for="name_surname" class="label block text-xs">
                        Nome e Sobrenome
                    </label>
                    <input
                        type="text"
                        id="name_surname"
                        name="name_surname"
                        class="input w-full py-1 text-sm"
                        placeholder="Ex: José Silva"
                        value="{{ old('name_surname') }}">
                    {!! showValidationError('name_surname', $errors) !!}
                    {!! showServerError() !!}
                </div>

                <div>
                    <label for="email" class="label block text-xs">
                        E-mail
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="input w-full py-1 text-sm"
                        placeholder="seuemail@gmail.com"
                        value="{{ old('email') }}">
                    {!! showValidationError('email', $errors) !!}
                </div>

                <div>
                    <label for="password" class="label block text-xs">
                        Senha
                    </label>

                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="input w-full py-1 text-sm pr-8"
                            placeholder="sua senha aqui">

                        <i
                            id="togglePassword"
                            class="fa-regular fa-eye absolute right-2 top-1/2 -translate-y-1/2 cursor-pointer hover:text-zinc-500">
                        </i>
                    </div>

                    {!! showValidationError('password', $errors) !!}
                </div>

                <div>
                    <label for="password_confirmation" class="label block text-xs">
                        Confirmar senha
                    </label>

                    <div class="relative">
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="input w-full py-1 text-sm pr-8"
                            placeholder="confirme sua senha">

                        <i
                            id="togglePasswordConfirmation"
                            class="fa-regular fa-eye absolute right-2 top-1/2 -translate-y-1/2 cursor-pointer hover:text-zinc-500">
                        </i>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-between gap-2 mx-4 pt-6">
                    <a
                    href="{{ route('sysadmin.home') }}"
                    class="btn-red-reverse flex items-center justify-center gap-2 w-full sm:w-auto">
                    Cancelar
                    <i class="fa fa-xmark"></i>
                </a>
                    <button
                        type="submit"
                        class="btn-red flex items-center justify-center gap-2 w-full sm:w-auto">
                        Criar usuário
                        <i class="fa fa-check"></i>
                    </button>
                </div>

            </form>

        </article>
    </section>

    <script>
        function toggleVisibility(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            icon.addEventListener('click', () => {
                const isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });
        }

        toggleVisibility('password', 'togglePassword');
        toggleVisibility('password_confirmation', 'togglePasswordConfirmation');
    </script>

</x-layouts.inside-layout>
