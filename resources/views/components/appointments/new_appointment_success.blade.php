<div class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 px-4">
    <section class="info-card w-full max-w-md sm:max-w-lg bg-zinc-900 border border-zinc-700 rounded-2xl shadow-xl p-6 sm:p-8 flex flex-col gap-6 text-center">
        <header>
            <h2 id="success-title" class="text-lg sm:text-xl font-semibold text-white">
                Agendamento realizado com sucesso!
            </h2>
        </header>

        <div>
            <p class="text-sm sm:text-base text-zinc-300 leading-relaxed">
                Você pode acompanhar os detalhes e o status dos seus agendamentos
                no seu <span class="font-medium text-white">perfil</span>.
            </p>
        </div>

        <footer class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('home') }}" class="btn-red w-full sm:w-auto text-center"> Voltar para o início </a>

            <a href="{{ route('profile') }}" class="btn-red w-full sm:w-auto text-center"> Ir para o perfil</a>
        </footer>
    </section>
</div>
