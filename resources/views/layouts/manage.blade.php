<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('inc.head')
<link id='dark-theme-css' rel="stylesheet" href="@if(Cookie::get('theme') == 'dark') /css/dark.css @endif">
<body>
@include('inc.manage.navbar')
<style>
    .sidenav.sidenav-fixed {
        left: 0;
        -webkit-transform: translateX(0);
        transform: translateX(0);
        position: fixed;
    }
    h1,h2,h3,h4,h5,h6{
        font-family: Roboto;
    }
</style>
<div class="app">
    <div class="container">
        @include('inc.messages')
    </div>
    @yield('content')
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    M.AutoInit();
    $(document).ready(function(){
        $('.sidenav').sidenav();
    });
    $('#theme-toggle').click(function () {
        let curtheme = getCookie('theme');
        if (curtheme === "dark") {
            $('#dark-theme-css').attr('href', ' ')
            $('#user-bg-img').attr('src', 'https://i.driedsponge.net/images/png/SiB6Y.png')
            document.cookie = 'theme=light; path=/';
            console.log('go light')
        } else {
            $('#user-bg-img').attr('src', 'https://i.driedsponge.net/images/png/sb7Po.png')
            $('#dark-theme-css').attr('href', '/css/dark.css')
            document.cookie = 'theme=dark; path=/';
            console.log('go dark')

        }
    })

</script>
</body>

</html>
