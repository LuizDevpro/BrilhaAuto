<x-layouts.inside-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}" flatpickr>

    <section class="w-full flex justify-center items-center">
        <article class="w-full max-w-xl bg-zinc-900 border border-zinc-700 rounded-2xl p-6 sm:p-8 space-y-8 h-fit">

            <header class="space-y-3 text-center">
                <p class="text-zinc-300 text-sm sm:text-base">
                    Indique a data e hora até quando a conta deverá permanecer
                    <strong class="text-red">bloqueada</strong>.
                </p>

                <p class="font-semibold text-lg sm:text-2xl text-red break-all">
                    {{ $user->email }}
                </p>
            </header>

            <form
                action="{{ route('sysadmin.user.block.submit') }}"
                method="post"
                novalidate
                class="space-y-8">

                @csrf

                <input type="hidden" name="user_id" value="{{ Crypt::encrypt($user->id) }}">

                <div class="flex flex-col items-center gap-2">
                    <label for="blocked_until" class="text-sm text-zinc-400">
                        Bloquear até
                    </label>

                    <input
                        type="text"
                        name="blocked_until"
                        id="blocked_until"
                        class="input w-full sm:w-3/4 text-center text-lg"
                        placeholder="Selecione a data e hora">

                    {!! showValidationError('blocked_until', $errors) !!}
                </div>

                <div class="flex flex-col sm:flex-row justify-center gap-4 pt-4">
                    <a
                        href="{{ route('sysadmin.home') }}"
                        class="btn-red-reverse w-full sm:w-auto flex items-center justify-center gap-2">
                        <i class="fa fa-times"></i>
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="btn-red w-full sm:w-auto flex items-center justify-center gap-2"
                        id="btn_block_user">
                        <i class="fa fa-lock"></i>
                        Bloquear Conta
                    </button>
                </div>

            </form>

        </article>
    </section>

    <script>
        flatpickr('#blocked_until', {
            enableTime: true,
            dateFormat: 'Y-m-d H:i',
            minDate: 'today',
            time_24hr: true,
            locale: 'pt',
            altInput: true,
            altFormat: 'd/m/Y H:i',
            defaultDate: "{{ old('blocked_until', now()->format('Y-m-d H:i')) }}"
        });
    </script>

</x-layouts.inside-layout>
