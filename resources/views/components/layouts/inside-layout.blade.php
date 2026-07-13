@props([
    'subtitle' => '',
    'fullWidth' => false,
    'datatables' => false,
    'flatpickr' => false,
])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}{{ empty($subtitle) ? '' : ' | ' . $subtitle }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/images/favicon/site.webmanifest') }}">

    @vite('resources/css/app.css')

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">

    {{-- DataTables --}}
    @if ($datatables)
        <link rel="stylesheet" href="{{ asset('assets/DataTables/datatables.min.css') }}">
        <script src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
    @endif

    {{-- Flatpickr --}}
    @if ($flatpickr)
        <link rel="stylesheet" href="{{ asset('assets/flatpickr/flatpickr.min.css') }}">
        <script src="{{ asset('assets/flatpickr/flatpickr.min.js') }}"></script>
        <script src="{{ asset('assets/flatpickr/pt.js') }}"></script>
    @endif

</head>

<body class="bg-gray-950 min-h-screen flex flex-col">

    <x-layouts.top_bar />

    <main @class(['flex-1', 'p-8 pt-20' => !$fullWidth])>
        {{ $slot }}
    </main>

</body>

</html>
