<x-layouts.inside-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">

    <section class="w-full flex justify-center items-center">
        <article class="w-full max-w-xl bg-zinc-900 border border-zinc-700 rounded-2xl p-6 sm:p-8 space-y-8 h-fit">

            <header class="space-y-4 text-center">
                <p class="text-zinc-300">
                    Tem certeza que deseja forçar a redefinição de senha para o usuário
                </p>

                <p class="text-2xl sm:text-3xl font-bold text-red break-all">
                    {{ $user->name_surname }}?
                </p>
            </header>

            <form action="{{ route('sysadmin.user.force.password.reset.confirm', ['id' => Crypt::encrypt($user->id)]) }}"
                method="post" class="space-y-6" novalidate>

                @csrf

                <div>
                    <label for="new_password" class="label block text-md">
                        Nova senha
                    </label>

                    <div class="relative">
                        <input type="password" id="new_password" name="new_password" class="input w-full py-1 text-sm pr-8"
                            placeholder="Nova senha aqui">

                        <i id="togglePassword"
                            class="fa-regular fa-eye absolute right-2 top-1/2 -translate-y-1/2 cursor-pointer hover:text-zinc-500">
                        </i>
                    </div>

                    {!! showValidationError('new_password', $errors) !!}
                </div>

                <div class="flex flex-col sm:flex-row justify-center gap-4 pt-4">
                    <a href="{{ route('sysadmin.home') }}"
                        class="btn-red-reverse w-full sm:w-auto flex items-center justify-center gap-2">
                        Não
                        <i class="fa fa-times"></i>
                    </a>

                    <button type="submit" class="btn-red w-full sm:w-auto flex items-center justify-center gap-2">
                        Alterar
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
    </script>

</x-layouts.inside-layout>
