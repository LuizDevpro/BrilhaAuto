<x-layouts.outside-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}">

    <main class="flex min-h-[72vh] items-center justify-center px-4 py-6 sm:px-6">

        <article class="main-card w-full max-w-xl p-6 sm:p-8">

            <header class="mb-8 text-center">

                <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-green-600">

                    <i class="fa-solid fa-envelope-circle-check text-3xl text-white"></i>

                </div>

                <h1 class="title-1 mb-3">
                    E-mail enviado
                </h1>

                <p class="text-sm leading-relaxed text-white sm:text-base">
                    Enviamos um link para redefinição de senha para:
                </p>

                <p class="mt-2 break-all font-semibold text-red-500">
                    {{ $email }}
                </p>

                <p class="mt-4 text-sm text-zinc-300">
                    Verifique sua caixa de entrada e também a pasta de spam caso o e-mail não apareça em alguns minutos.
                </p>

            </header>

            <div class="text-center">

                <a href="{{ route('home') }}"
                    class="btn-red inline-flex w-full items-center justify-center gap-2 sm:w-auto">

                    <i class="fa-solid fa-house"></i>

                    Voltar para o início

                </a>

            </div>

        </article>

    </main>

</x-layouts.outside-layout>
