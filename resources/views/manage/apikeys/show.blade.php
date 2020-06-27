@extends('layouts.manage')
@section('title','Edit '.$key->name)
@section('description','Edit '.$key->name)
@section('content')
    <div class="container" id="'content">
        <h2>{{$key->name}}'s Usage Statistics</h2>
        <a href="{{route('api.index')}}" class="btn">Go Back</a>
        @include('inc.FormMsg')
        <br>
        <br>
        <div class="card">
            <div class="card-content">

            </div>
        </div>
    </div>
    <script>
        const observer = lozad(); // lazy loads elements with default selector as '.lozad'
        observer.observe();
    </script>
@endsection
