@extends('layouts.manage')
@section('title','Edit '.$role->name)
@section('description','Edit '.$role->name)
@section('content')
<div class="container" id="'content">
        <h1>Edit {{$role->name}}</h1>
            @include('inc.FormMsg')
            <div class="card">
                <div class="card-content">
                    <form id="edit-name">
                        <div class="input-field">
                            <input id='role_name' type="text" value="{{$role->name}}"  maxlength="30" minlength="3" class="validate">
                            <label for='role_name'>Role Name</label>
                            <span id="role_name-msg" class="helper-text" data-error="" data-success=""></span>
                        </div>
                        <button class="btn btn-success" type="submit">Save Name</button>
                    </form>
                    <h4>Permissions</h4>
                    @foreach ($permissionsAll as $perm)
                        <p>
                            <label>
                            <input
                                @if ($role->hasPermissionTo("*") && $perm->name != "*" )
                                disabled
                                @elseif($role->hasPermissionTo(explode('.',$perm->name)[0].'.*') && $perm->name !== explode('.',$perm->name)[0].'.*' && $perm->name != "*")
                                disabled
                                @endif
                                data-group="{{explode('.',$perm->name)[0]}}" @if(isset(explode('.',$perm->name)[1])) data-second='{{explode('.',$perm->name)[1]}}' @else data-second='null'  @endif data-name="{{$perm->id}}" class="filled-in" id="perm-{{$perm->id}}" type="checkbox" @if ($role->hasPermissionTo($perm->name)) checked @endif >
                                <span>{{$perm->name}}</span>
                            </label>
                        </p>
                    @endforeach
                </div>
            </div>


            <script>
                $('input[type="checkbox"]').click(function(e){
                    e.preventDefault()
                    let name = $(this).data('name');
                    let group = $(this).data('group');
                    let second = $(this).data('second');
                    axios({
                            method: 'PUT',
                            url: '/manage/roles/{{$role->id}}',
                            data: {
                                pid: name,
                                perm: 1
                            }
                    })
                    .then(function(response) {
                            if (response.data.success) {
                                AlertMaterializeSuccess(response.data.success);
                                if(second==="*"){
                                    $(`input[data-group="${group}"]`).prop('checked', response.data.status);
                                    if(response.data.status === true){
                                        $(`input[data-group="${group}"]`).prop('disabled', true);
                                        $(`input[data-group="${group}"][data-second='*']`).prop('disabled', false);
                                    }else{
                                        $(`input[data-group="${group}"]`).prop('disabled', false);
                                    }
                                    }else if(group==="*"){
                                    $('input[type="checkbox"]').prop('checked',  response.data.status);
                                    if(response.data.status === true){
                                        $('input[type="checkbox"]').prop('disabled', true);
                                        $('input[data-group="*"]').prop('disabled', false);
                                    }else{
                                        $('input[type="checkbox"]').prop('disabled', false);
                                    }
                                }else{
                                    $(`input[data-name="${name}"]`).prop('checked', response.data.status);
                                }
                            } else {
                                AlertMaterializeError(response.data.error);
                            }
                        });
                })
                $('#edit-name').submit(function(e){
                    e.preventDefault()
                    $(this).hide()
                    $('#loading').removeClass('d-none');
                    axios({
                            method: 'PUT',
                            url: '/manage/roles/{{$role->id}}',
                            data: {
                                role_name: $("#role_name").val()
                            }
                        })
                        .then(function(response) {

                            $('#loading').addClass('d-none');
                            $('#edit-name').show()
                            if (response.data.success) {
                                MaterialValidate('#role_name')
                                AlertMaterializeSuccess(response.data.success)
                            } else {
                                if (response.data.error) {
                                    AlertMaterializeError(response.data.error);
                                }
                                MaterialValidate('#role_name')
                                $.each(response.data, function(key, value) {
                                    MaterialInvalidate('#' + key, value)
                                });
                            }
                        });
                })
            </script>
</div>
<script>
    const observer = lozad(); // lazy loads elements with default selector as '.lozad'
    observer.observe();
</script>
@endsection
