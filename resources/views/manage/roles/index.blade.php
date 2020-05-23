@extends('layouts.manage')
@section('title','Dashboard')
@section('description',"Manage stuff here")
@section('content')
<div class="container-fluid-lg">
    <div class="container-fluid">
        <div class="content-box">
            <h1>Existing Roles</h1>
            <a href="/manage/roles/create" class="btn btn-success">Create New Role</a>
            <br>
            <br>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <th>Name</th>
                        <th>Created At</th> 
                        <th>Settings</th> 
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{$role->name}}</td>
                                <td>{{$role->created_at}}</td>
                                <td><a href='/manage/roles/{{$role->id}}/edit' class="btn btn-sm btn-info">Edit</a><a href='/manage/roles/{{$role->id}}/delete' class="btn btn-sm btn-danger">Delete</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    navitem = document.getElementById('adminlink').classList.add('active')
    const observer = lozad(); // lazy loads elements with default selector as '.lozad'
    observer.observe();
</script>
@endsection