@extends('layouts.manage')
@section('title','Roles')
@section('description',"Roles")
@section('content')
    <div class="container" id="#content">
            <h3 class="text-center">Existing Roles</h3>
            <div class="text-center">
                <a href="/manage/roles/create" class="btn green"><i class="material-icons left">add</i>Create New Role</a>
            </div>
            <br>

            <div class="row">
                @foreach ($roles as $role)
            <div id='role-{{$role->id}}' class="col s12 m6">
                  <div class="card white darken-1">
                    <div class="card-content black-text">
                      <span class="card-title"><strong>{{$role->name}} (ID: {{$role->id}})</strong></span>
                      <p>Created: <span data-position="right" data-tooltip="{{ \Carbon\Carbon::parse($role->created_at)->format('n/j/Y g:i A')}}" class="ts tooltipped">{{ \Carbon\Carbon::parse($role->created_at)->diffForHumans()}}</span></p>
                    </div>
                    <div class="card-action">
                        <a href='/manage/roles/{{$role->id}}/edit' class="waves-effect waves-light blue btn"><i class="material-icons left">mode_edit</i>Edit</a>
                        &nbsp;
                        <button onclick="DeleteRole('{{$role->id}}')" class="waves-effect waves-light red btn"><i class="material-icons left">delete_sweep</i>Delete</button>
                    </div>
                  </div>
                </div>
                @endforeach
                </div>
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
    $(document).ready(function(){
      $('.tooltipped').tooltip();
    });
</script>
@endsection