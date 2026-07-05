<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME')}} {{empty($subtitle) ? '' : ' | ' . $subtitle }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.jpg') }}" type="image/jpg">
    @vite('resources/css/app.css')

    {{-- fontawesome 6.x --}}
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">

    {{-- datatables --}}
    @if (!empty($datatables))
    <link rel="stylesheet" href="{{ asset('assets/DataTables/datatables.min.css') }}">
    <script src="{{ asset('assets/DataTables/datatables.min.js') }}"></script>
    @endif
    {{-- flatpickr --}}
    @if (!empty($flatpickr))
        <link rel="stylesheet" href="{{ asset('assets/flatpickr/flatpickr.min.css') }}">
        <script src="{{ asset('assets/flatpickr/flatpickr.min.js') }}"></script>
        <script src="{{ asset('assets/flatpickr/pt.js') }}"></script>
    @endif

</head>
<body class="bg-gray-950 h-screen flex flex-col">

    <x-layouts.top_bar />

    <main class="flex flex-1 p-8 pt-20!">
        {{ $slot }}
    </main>

    
</body>


</html>