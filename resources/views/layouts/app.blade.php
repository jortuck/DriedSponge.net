<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('inc.head')
    <body style="background:#0E1013;">
        <div class="banner banner-danger">
            <p><strong>Test Test Test Test </strong></p>
        </div>

        @include('inc.navbar')
    <div>
        <div class="container">
            @include('inc.messages')
        </div>
        @yield('content')
    </div>
    <script>
        M.AutoInit();
    </script>
    </body>
</html>
