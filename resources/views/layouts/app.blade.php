<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('includes.admin.head')
</head>
<body>
    <div id="app">
        @include('includes.admin.header')

        <main class="py-4">
            @yield('content')
        </main>


    </div>
</body>
</html>
