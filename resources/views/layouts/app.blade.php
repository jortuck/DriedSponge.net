<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('inc.head')
    <body class="bg-primary">
        @include('inc.navbar')
    <main>
        <div class="container">
            @include('inc.messages')
        </div>
        @yield('content')
    </main>
    <script>
        M.AutoInit();
    </script>
        @include('inc.footer')
    </body>
</html>
