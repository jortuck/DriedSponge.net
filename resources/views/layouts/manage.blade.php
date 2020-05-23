<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('inc.head')  
    <body>
        <div class="app">
        @include('inc.manage.navbar')  
        <div class="container">
            @include('inc.messages')     
        </div>   
        @yield('content')
    </div>
        @include('inc.footer')     
    </body>
</html>