<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('inc.head')

<body>
    @include('inc.manage.navbar')
    <div class="app">
        <div class="container">
            @include('inc.messages')
        </div>
        <div id='pre-content'>
            <div class="masthead indigo shadowed">
                <div class="container">
                    <h2>@yield('title')</h2>
                </div>
            </div>
        </div>
        @yield('content')
    </div>
    <script>
        $("#left-nav-btn").sideNav({
            menuWidth: 250,
            edge: "left"
        });
    </script>
</body>

</html>