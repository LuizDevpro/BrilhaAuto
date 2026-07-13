<x-layouts.inside-layout subtitle="{{ empty($subtitle) ? '' : $subtitle }}" flatpickr>


    <section class="flex justify-center items-center w-full h-full">
        <article
            class="input-card flex flex-col w-full max-w-md md:max-w-2xl xl:max-w-4xl h-fit max-h-full p-5 sm:p-6 rounded-2xl bg-zinc-900/90 border border-zinc-700 shadow-lg">
            <header class="text-center shrink-0 mb-6">
                <h2 class="title-2 text-lg sm:text-xl">
                    Agendar Lavagem - {{ $service->name }}
                </h2>

            </header>

            <form
                action="{{ route('appointments.new.appointment.submit', ['service_id' => Crypt::encrypt($service->id)]) }}"
                method="post" novalidate>
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="label block mb-1 text-sm">Telefone/WhatsApp para contato</label>
                        <input type="text" name="phone" class="input w-full py-1.5 text-sm"
                            placeholder="Ex: (19) 99876-5432" value="{{ old('phone') }}">
                        {!! showValidationError('phone', $errors) !!}
                    </div>

                    <div>
                        <label class="label block mb-1 text-sm">Data e Hora</label>
                        <input type="text" id="datetime" name="datetime" class="input w-full py-1.5 text-sm"
                            placeholder="Selecione data e horário" value="{{ old('datetime') }}">

                        {!! showValidationError('datetime', $errors) !!}
                    </div>

                    <div>
                        <label class="label block mb-1 text-sm">Tipo do Veículo</label>
                        <select name="vehicle_type" class="input w-full py-1.5 text-sm">
                            <option value="">Selecione</option>
                            <option value="Carro" {{ old('vehicle_type') == 'Carro' ? 'selected' : '' }}>Carro</option>
                            <option value="Moto" {{ old('vehicle_type') == 'Moto' ? 'selected' : '' }}>Moto</option>
                            <option value="Caminhonete" {{ old('vehicle_type') == 'Caminhonete' ? 'selected' : '' }}>
                                Caminhonete</option>
                            <option value="SUV" {{ old('vehicle_type') == 'SUV' ? 'selected' : '' }}>SUV</option>
                        </select>
                        {!! showValidationError('vehicle_type', $errors) !!}
                    </div>

                    <div>
                        <label class="label block mb-1 text-sm">Marca do Veículo</label>
                        <input type="text" name="brand" class="input w-full py-1.5 text-sm"
                            placeholder="Ex: Fiat, Chevrolet, Volkswagen" value="{{ old('brand') }}">
                        {!! showValidationError('brand', $errors) !!}
                    </div>

                    <div>
                        <label class="label block mb-1 text-sm">Modelo do Veículo</label>
                        <input type="text" name="model" class="input w-full py-1.5 text-sm"
                            placeholder="Ex: Gol, Onix, Corolla" value="{{ old('model') }}">
                        {!! showValidationError('model', $errors) !!}
                    </div>

                    <div>
                        <label class="label block mb-1 text-sm">Ano do Veículo (Opcional)</label>
                        <select name="year" class="input w-full py-1.5 text-sm">
                            <option value="">Selecione</option>
                            @for ($year = now()->year; $year >= 1995; $year--)
                                <option value="{{ $year }}" {{ old('year') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endfor
                        </select>
                        {!! showValidationError('year', $errors) !!}
                    </div>

                    <div>
                        <label class="label block mb-1 text-sm">Cor do Veículo</label>
                        <input type="text" name="color" class="input w-full py-1.5 text-sm"
                            placeholder="Ex: Branco, Preto, Azul" value="{{ old('color') }}">
                        {!! showValidationError('color', $errors) !!}
                    </div>

                    <div>
                        <label class="label block mb-1 text-sm">Placa do Veículo (Opcional)</label>
                        <input type="text" name="plate" class="input w-full py-1.5 text-sm"
                            placeholder="Digite a placa do veículo aqui" value="{{ old('plate') }}">
                        {!! showValidationError('plate', $errors) !!}
                    </div>

                    <div class="checkbox flex flex-col gap-1 text-sm" id="extrasWrapper">
                        @foreach ($service->additionalServices as $extra)
                            @php
                                $prices = $extra->prices->mapWithKeys(
                                    fn($p) => [
                                        $p->vehicle_type => $p->price,
                                    ],
                                );
                            @endphp

                            <label>
                                <input type="checkbox" name="extras[]" value="{{ $extra->id }}"
                                    data-prices='@json($prices)'
                                    {{ is_array(old('extras')) && in_array($extra->id, old('extras')) ? 'checked' : '' }}>
                                {{ $extra->name }}
                                <span class="text-zinc-400 extra-price"></span>
                            </label>
                        @endforeach
                    </div>

                    <div>
                        <label class="label block mb-1 text-sm">Observações (Opcional)</label>
                        <textarea name="observations" rows="3" class="input w-full py-1.5 text-sm resize-none"
                            placeholder="Ex: Carro com pelos de cachorro">{{ old('observations') }}</textarea>
                    </div>

                    <div>
                        <label class="label block mb-1 text-sm">Forma de Pagamento</label>
                        <div class="radio flex flex-wrap gap-4 text-sm">
                            <label>
                                <input type="radio" name="payment" value="Pix"
                                    {{ old('payment') == 'Pix' ? 'checked' : '' }}>
                                Pix
                            </label>
                            <label>
                                <input type="radio" name="payment" value="Débito"
                                    {{ old('payment') == 'Débito' ? 'checked' : '' }}>
                                Débito
                            </label>
                            <label>
                                <input type="radio" name="payment" value="Crédito"
                                    {{ old('payment') == 'Crédito' ? 'checked' : '' }}>
                                Crédito
                            </label>
                            <label>
                                <input type="radio" name="payment" value="Dinheiro"
                                    {{ old('payment') == 'Dinheiro' ? 'checked' : '' }}>
                                Dinheiro
                            </label>

                        </div>
                        {!! showValidationError('payment', $errors) !!}
                    </div>

                    <div>
                        <label class="label block mb-1 text-sm">Gostaria de busca e entrega?</label>
                        <div class="radio flex gap-4 text-sm">
                            <label>
                                <input type="radio" name="pickup" value="1"
                                    {{ old('pickup') === '1' ? 'checked' : '' }}>
                                Sim
                            </label>

                            <label>
                                <input type="radio" name="pickup" value="0"
                                    {{ old('pickup', '0') === '0' ? 'checked' : '' }}>
                                Não
                            </label>
                        </div>
                        {!! showValidationError('pickup', $errors) !!}
                    </div>

                    <div id="addressFields" class="{{ old('pickup') == '1' ? '' : 'hidden' }} contents">

                        <div>
                            <label class="label block mb-1 text-sm">Rua</label>
                            <input type="text" name="street" class="input w-full py-1.5 text-sm"
                                placeholder="Ex: Rua Thomas José Dias" value="{{ old('street') }}">
                            {!! showValidationError('street', $errors) !!}
                        </div>

                        <div>
                            <label class="label block mb-1 text-sm">Número</label>
                            <input type="number" name="number" class="input w-full py-1.5 text-sm"
                                placeholder="Ex: 1170" min="0" value="{{ old('number') }}">
                            {!! showValidationError('number', $errors) !!}
                        </div>

                        <div>
                            <label class="label block mb-1 text-sm">Bairro</label>
                            <input type="text" name="neighborhood" class="input w-full py-1.5 text-sm"
                                placeholder="Ex: Jardim Santa Deolinda" value="{{ old('neighborhood') }}">
                            {!! showValidationError('neighborhood', $errors) !!}
                        </div>

                        <div>
                            <label class="label block mb-1 text-sm">Complemento (Opcional)</label>
                            <input type="text" name="complement" class="input w-full py-1.5 text-sm"
                                placeholder="Ex: Em frente ao Supermercado Popular" value="{{ old('complement') }}">
                            {!! showValidationError('complement', $errors) !!}
                        </div>

                        <div>
                            <label class="label block mb-1 text-sm">Horário para busca</label>
                            <input type="text" id="pickup_time" name="pickup_time"
                                class="input w-full py-1.5 text-sm" value="{{ old('pickup_time') }}">
                            {!! showValidationError('pickup_time', $errors) !!}
                        </div>

                    </div>
                </div>

                @if (session()->has('server_error'))
                    <div class="flex justify-center items-center">
                        <div class="flex justify-center items-center mt-6 bg-red w-fit px-6 py-3 rounded-md">
                            {!! showServerErrorForm() !!}
                        </div>
                    </div>
                @endif
                @if (session()->has('appointment_success'))
                    <x-appointments.new_appointment_success />
                @endif

                <div class="mt-6 text-right">
                    <span class="text-sm text-white">Total</span>
                    <div class="text-xl font-semibold text-white">
                        R$ <span id="totalPrice">0,00</span>
                    </div>
                </div>


                <div class="flex flex-col md:flex-row gap-3 mt-8 w-full">
                    <a href="{{ route('services') }}"
                        class="btn-red-reverse w-full md:w-auto md:flex-1 text-center flex items-center justify-center gap-2">
                        Cancelar <i class="fa-solid fa-xmark"></i>
                    </a>

                    <button type="submit"
                        class="btn-red w-full md:w-auto md:flex-1 text-sm flex items-center justify-center gap-2">
                        Confirmar Agendamento
                    </button>
                </div>

            </form>




        </article>
    </section>

    <script>
        window.serviceBasePrices = @json(
            $service->prices->mapWithKeys(fn($price) => [
                    strtolower($price->vehicle_type) => $price->price,
                ]));
    </script>


    <script>
        const pickupRadios = document.querySelectorAll('input[name="pickup"]');
        const addressFields = document.querySelector('#addressFields');

        let pickupPicker = null;

        pickupRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                const show = radio.value === '1';
                addressFields.classList.toggle('hidden', !show);

                if (show && !pickupPicker) {
                    pickupPicker = flatpickr('#pickup_time', {
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: 'H:i',
                        time_24hr: true,
                        locale: 'pt',
                    });
                }

                if (!show && pickupPicker) {
                    pickupPicker.clear();
                }
            });
        });

        const BASE_HOURS = ['07:00', '09:00', '13:00', '15:00', '17:00'];

        let hourSelect = null;
        let selectedHour = null;

        const datetimePicker = flatpickr('#datetime', {
            enableTime: true,
            time_24hr: true,
            dateFormat: 'd/m/Y H:i',
            locale: 'pt',
            minDate: 'today',

            disable: [
                date => date.getDay() === 0 || date.getDay() === 6
            ],

            onReady(_, __, fp) {
                if (fp.timeContainer) {
                    fp.timeContainer.style.display = 'none';
                }
                injectFooter(fp);
            },

            onChange(selectedDates, _, fp) {
                if (!selectedDates.length) return;
                selectedHour = null;
                updateHourSelect(fp, selectedDates[0]);
            }
        });

        function injectFooter(fp) {
            const footer = document.createElement('div');
            footer.className =
                'flex flex-col gap-3 px-4 py-3 border-t border-zinc-700 bg-zinc-900';

            hourSelect = document.createElement('select');
            hourSelect.className =
                'w-full rounded-lg bg-zinc-800 text-white border border-zinc-700 ' +
                'px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-red-600';

            const button = document.createElement('button');
            button.type = 'button';
            button.textContent = 'Confirmar horário';
            button.className =
                'w-full rounded-lg bg-red-600 hover:bg-red-700 ' +
                'text-white text-sm font-medium py-2 transition';

            button.addEventListener('click', () => {
                if (!hourSelect.value) {
                    alert('Selecione um horário');
                    return;
                }

                selectedHour = hourSelect.value;
                applyHour(fp, selectedHour);
                fp.close();
            });

            footer.appendChild(hourSelect);
            footer.appendChild(button);
            fp.calendarContainer.appendChild(footer);
        }

        async function updateHourSelect(fp, date) {
            const availableHours = await loadAvailableHours(date);

            hourSelect.innerHTML = '';

            if (!availableHours.length) {
                const option = document.createElement('option');
                option.textContent = 'Sem horários disponíveis';
                option.disabled = true;
                hourSelect.appendChild(option);

                fp.clear();
                selectedHour = null;
                return;
            }

            availableHours.forEach(time => {
                const option = document.createElement('option');
                option.value = time;
                option.textContent = time;
                hourSelect.appendChild(option);
            });
        }

        function applyHour(fp, time) {
            if (!fp.selectedDates.length) return;

            const [hour, minute] = time.split(':').map(Number);
            const date = fp.selectedDates[0];

            date.setHours(hour, minute, 0, 0);
            fp.setDate(date, true);
        }

        function isToday(date) {
            const today = new Date();
            return date.toDateString() === today.toDateString();
        }

        async function loadAvailableHours(date) {
            const formattedDate = date.toISOString().split('T')[0];

            const response = await fetch(
                `/appointments/occupied-times?date=${formattedDate}`
            );

            const occupied = await response.json();

            let hours = BASE_HOURS.filter(hour => !occupied.includes(hour));

            if (isToday(date)) {
                const now = new Date();
                const currentMinutes = now.getHours() * 60 + now.getMinutes();

                hours = hours.filter(hour => {
                    const [h, m] = hour.split(':').map(Number);
                    const hourMinutes = h * 60 + m;
                    return hourMinutes > currentMinutes;
                });
            }

            return hours;
        }

        const vehicleSelect = document.querySelector('[name="vehicle_type"]');
        const extrasWrapper = document.getElementById('extrasWrapper');
        const totalEl = document.getElementById('totalPrice');

        function formatPrice(value) {
            return (value / 100).toFixed(2).replace('.', ',');
        }

        function normalizeVehicle(value) {
            return value?.toLowerCase();
        }

        function updatePrices() {
            const vehicle = normalizeVehicle(vehicleSelect.value);
            let total = 0;

            if (vehicle && window.serviceBasePrices?.[vehicle]) {
                total += Number(window.serviceBasePrices[vehicle]);
            }

            extrasWrapper.querySelectorAll('input[type="checkbox"]').forEach(input => {
                const prices = JSON.parse(input.dataset.prices || '{}');
                const priceSpan = input.closest('label').querySelector('.extra-price');

                priceSpan.textContent = '';

                if (!vehicle || prices[vehicle] === undefined) {
                    return;
                }

                const extraPrice = Number(prices[vehicle]);

                if (extraPrice === 0) {
                    priceSpan.textContent = ' (Grátis)';
                } else {
                    priceSpan.textContent = ` (R$ ${formatPrice(extraPrice)})`;
                }

                if (input.checked) {
                    total += extraPrice;
                }
            });

            totalEl.textContent = formatPrice(total);
        }

        vehicleSelect.addEventListener('change', updatePrices);
        extrasWrapper.addEventListener('change', updatePrices);

        updatePrices();
    </script>




</x-layouts.inside-layout>
