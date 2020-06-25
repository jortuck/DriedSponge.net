<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('inc.head')
    <body style="background: #0E1013;">
    <div class="banner banner-success">
        <p><b>This site is currently in development and is currently unfinished! If you come across any bugs or you have a suggestion please <a href="mailto:driedsponge@driedsponge.net" target="_blank">email me</a>.</b>
    </div>
    <br>
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
