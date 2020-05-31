<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('inc.head')

<body>
    @include('inc.manage.navbar')
    <div class="app">
        <div class="container">
            @include('inc.messages')
        </div>
        @yield('content')
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
          M.AutoInit();
    </script>
</body>

</html>
