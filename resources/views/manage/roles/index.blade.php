@extends('layouts.manage')
@section('title','Roles')
@section('description',"Roles")
@section('content')
    <div class="container" id="content">
            <h2>Roles</h2>
            <a href="{{route('roles.create')}}" data-position="right" data-tooltip="Create New Role" class="tooltipped btn waves-effect waves-light green"><i class="material-icons left">add</i> Create New Role</a>
            <br>
            <br>
                @foreach ($roles as $role)
                <div id='role-{{$role->id}}' >
                  <div class="card">
                    <div class="card-content">
                      <span class="card-title"><strong>{{$role->name}}</strong></span>
                      <p>Created: <span data-position="right" data-tooltip="{{ \Carbon\Carbon::parse($role->created_at)->format('n/j/Y g:i A')}}" class="ts tooltipped">{{ \Carbon\Carbon::parse($role->created_at)->diffForHumans()}}</span></p>
                      <p>Edited: <span data-position="right" data-tooltip="{{ \Carbon\Carbon::parse($role->updated_at)->format('n/j/Y g:i A')}}" class="ts tooltipped">{{ \Carbon\Carbon::parse($role->created_at)->diffForHumans()}}</span></p>
                      <p>ID: {{$role->id}}</p>
                    </div>
                    <div class="card-action">
                        <a href='/manage/roles/{{$role->id}}/edit' class="btn waves-effect waves-light blue"><i class="material-icons left">mode_edit</i>Edit</a>
                        &nbsp;
                        <button onclick="DeleteRole('{{$role->id}}')" class="waves-effect waves-light red btn"><i class="material-icons left">delete_sweep</i>Delete</button>
                    </div>
                  </div>
                </div>
                @endforeach
                <script>
                    function DeleteRole(id){
                        axios({
                            method: 'DELETE',
                            url: '/manage/roles/'+id,
                        })
                        .then(function(response) {
                              if (response.data.success) {
                                M.toast({html:response.data.success,classes:'green'})
                                $("#role-"+id).remove();
                            } else {
                                AlertError(response.data.error);
                            }
                        });
                    }
                </script>
</div>
<script>
    //navitem = document.getElementById('roleslink').classList.add('active')
    const observer = lozad(); // lazy loads elements with default selector as '.lozad'
    observer.observe();
</script>
@endsection
