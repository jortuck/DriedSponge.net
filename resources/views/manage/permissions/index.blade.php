@extends('layouts.manage')
@section('title','Permission Management')
@section('description',"Permissions")
@section('content')
<div class="container-fluid-lg">
    <div class="container-fluid">
        <div class="content-box">
            <h1>All Permissions</h1>
            <a href="/manage/permissions/create" class="btn btn-success">Create New Permission</a>
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
                        @foreach ($perms as $perm)
                        <tr id="perm-{{$perm->id}}">
                                <td>{{$perm->name}}</td>
                                <td>{{$perm->created_at}}</td>
                                <td><button onclick="DeletePerm('{{$perm->id}}')" class="btn btn-sm btn-danger">Delete</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <script>
                    function DeletePerm(id){
                        axios({
                            method: 'DELETE',
                            url: '/manage/permissions/'+id,
                        })
                        .then(function(response) {
                              if (response.data.success) {
                                AlertSuccess(response.data.success);
                                $("#perm-"+id).remove();
                            } else {
                                AlertError(response.data.error); 
                            }
                        });
                    }
                </script>
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