<x-layouts.inside-layout subtitle="{{ $subtitle ?? '' }}" datatables>

    <section class="flex items-center justify-center w-full">

        @if ($users->count() === 0)

            <div class="flex items-center justify-center my-16">
                <div class="bg-white border border-zinc-200 rounded-xl px-8 py-6 text-center">
                    <p class="text-zinc-500 text-lg">
                        Não existem usuários cadastrados.
                    </p>
                </div>
            </div>

        @else

            <div class="bg-white border border-zinc-200 rounded-xl p-6 w-full">

                <div class="w-full flex flex-col sm:flex-row sm:justify-end gap-3 mb-4">
                    <a href="{{ route('sysadmin.user.create') }}" class="btn-red w-full sm:w-auto text-center">
                        Criar novo usuário
                    </a>
                </div>

                <div class="w-full">
                    <table
                        id="table-users"
                        class="w-full text-sm text-left text-zinc-700"
                    >
                        <thead class="bg-red text-white">
                            <tr>
                                <th class="px-4 py-3 text-xs uppercase tracking-wide">ID</th>
                                <th class="px-4 py-3 text-xs uppercase tracking-wide">Nome e Sobrenome</th>
                                <th class="px-4 py-3 text-xs uppercase tracking-wide">Email</th>
                                <th class="px-4 py-3 text-xs uppercase tracking-wide text-center">Status</th>
                                <th class="px-4 py-3 text-xs uppercase tracking-wide text-center">Perfil</th>
                                <th class="px-4 py-3 text-xs uppercase tracking-wide text-center">Criado em</th>
                                <th class="px-4 py-3 text-xs uppercase tracking-wide text-center">Ações</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-zinc-200">
                            @foreach ($users as $user)
                                <tr>
                                    <td class="px-4 py-3 font-medium text-zinc-900">
                                        {{ $user->id }}
                                    </td>

                                    <td class="px-4 py-3 font-medium text-zinc-900">
                                        {{ $user->name_surname }}
                                    </td>

                                    <td class="px-4 py-3">
                                        {{ $user->email }}
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        {!! getUserStatus($user) !!}
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        {!! getUserRole($user->role) !!}
                                    </td>

                                    <td class="px-4 py-3 text-center whitespace-nowrap">
                                        {{ $user->created_at->format('d/m/Y') }}
                                    </td>

                                    <td class="px-4 py-3">
                                        <div class="flex items-center justify-center gap-2 whitespace-nowrap">
                                            {!! implode('', getUserAvailableActions($user)) !!}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>

        @endif

    </section>

    <script>
        window.addEventListener('load', () => {
            const tableEl = document.getElementById('table-users');
            if (!tableEl) return;

            $('#table-users').DataTable({
                language: {
                    url: "{{ asset('assets/DataTables/pt-BR.json') }}"
                },
                pageLength: 10,
                lengthChange: false,
                ordering: true,

                responsive: false,
                scrollX: true,
                autoWidth: true,

                dom:
                    '<"flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4"f>' +
                    'rt' +
                    '<"flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mt-4"ip>',
            });
        });
    </script>

    <style>
        #table-users tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        #table-users tbody tr:nth-child(even) {
            background-color: #e4e4e7;
        }

        #table-users tbody tr:hover {
            background-color: #d5d5d6;
        }

        .dataTables_wrapper,
        .dataTables_scroll,
        .dataTables_scrollHead,
        .dataTables_scrollBody,
        table.dataTable {
            width: 100% !important;
        }

        .dataTables_scrollBody {
            overflow-x: auto !important;
        }
    </style>

</x-layouts.inside-layout>
