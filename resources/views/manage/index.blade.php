@extends('layouts.manage')
@section('title','Dashboard')
@section('description',"Manage stuff here")
@section('content')
<div id='content' class="container">
    <h1>Test</h1>

</div>
<script>
    navitem = document.getElementById('dashlink').classList.add('active')
    const observer = lozad(); // lazy loads elements with default selector as '.lozad'
    observer.observe();
</script>
@endsection