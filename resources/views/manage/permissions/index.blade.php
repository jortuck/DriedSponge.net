@extends('layouts.manage')
@section('title','Permission Management')
@section('description',"Permissions")
@section('content')
<div class="container" id="content">
            <h1>All Permissions</h1>
            <a href="{{route('permissions.create')}}" class="btn green">Create New Permission</a>
            <br>
            <br>
                <table class="responsive-table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Created At</th>
                        <th>Settings</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($perms as $perm)
                        <tr id="perm-{{$perm->id}}">
                                <td>{{$perm->name}}</td>
                                <td><span data-position="right" data-tooltip="{{ \Carbon\Carbon::parse($perm->created_at)->format('n/j/Y g:i A')}}" class="ts tooltipped">{{\Carbon\Carbon::parse($perm->created_at)->diffForHumans()}}</span></td>
                                <td><button onclick="DeletePerm('{{$perm->id}}')" class="btn red"><i class="material-icons center">delete_sweep</i></button></td>
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
                                AlertMaterializeSuccess(response.data.success);
                                $("#perm-"+id).remove();
                            } else {
                                AlertMaterializeError(response.data.error);
                            }
                        });
                    }
                </script>
            </div>
<script>
    const observer = lozad(); // lazy loads elements with default selector as '.lozad'
    observer.observe();
</script>
@endsection
