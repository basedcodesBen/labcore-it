<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LabCore IT - @yield('title')</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Flowbite -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    @stack('head')
</head>

<body class="font-sans antialiased">

    <!-- Sidebar or Navigation -->
    @include('components.navigation')

    <div class="flex flex-col lg:flex-row">
        <!-- Content Area -->
        <div class="w-full p-6 lg:w-9/12">
            @yield('content')
        </div>
    </div>

    <!-- Footer -->
    @include('components.footer')

    @stack('scripts')
</body>

</html>
