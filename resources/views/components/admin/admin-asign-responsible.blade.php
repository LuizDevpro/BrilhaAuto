<div class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 px-4">
    <section
        class="info-card w-full max-w-md sm:max-w-lg bg-zinc-900 border border-zinc-700 rounded-2xl shadow-xl p-6 sm:p-8 flex flex-col gap-6 text-center">
        <header>
            <h2 id="success-title" class="text-lg sm:text-xl font-semibold text-white">
                Atribuir responsável
            </h2>
        </header>

        <form action="{{ route('admin.assign.appointmet.responsible', ['appointment_id' => Crypt::encrypt($appointment->id)]) }}" method="post" novalidate>
            @csrf
            <div class="mb-4">
                <label for="responsible_name" class="label">Nome do(a) responsável</label>
                <input type="text" name="responsible_name" id="responsible_name" class="input"
                    placeholder="Nome do(a) responsável aqui" value="{{ old('responsible_name') }}">
                {!! showValidationError('responsible_name', $errors) !!}

            </div>

<footer class="flex flex-col sm:flex-row gap-3 justify-center">
            <button onclick="window.location.reload()" class="btn-red-reverse w-full sm:w-auto text-center">Cancelar</a>

            <button type="submit" class="btn-red w-full sm:w-auto text-center">Confirmar</button>
        </footer>
        </form>

        
    </section>
</div>
