@extends('layouts.manage')
@section('title','Edit '.$role->name)
@section('description','Edit '.$role->name)
@section('content')
<div class="container-fluid-lg">
    <div class="container-fluid">
        <div class="content-box">
        <h1>Edit {{$role->name}}</h1>
            @include('inc.FormMsg')      
            <form id="edit-name">
                <div class="form-group">
                    <label for='name'>Role Name</label>
                    <input id='name' value="{{$role->name}}" feedback="#name-f" maxlength="30" minlength="3" class="form-control form-control-alternative" placeholder="Enter a name for this role">
                    <div id='name-f'></div>
                </div>
                <button class="btn btn-success" type="submit">Save Name</button>
            </form>
            <br>
            <label>Permissions</label>
            @foreach ($permissionsAll as $perm)
            <div class="custom-control custom-checkbox mb-3">
            <input data-group="{{explode('.',$perm->name)[0]}}" @if(isset(explode('.',$perm->name)[1])) data-second='{{explode('.',$perm->name)[1]}}' @else data-second='null'  @endif data-name="{{$perm->id}}" class="custom-control-input" id="perm-{{$perm->id}}" type="checkbox" @if ($role->hasPermissionTo($perm->name)) checked @endif >
                <label class="custom-control-label"  for="perm-{{$perm->id}}">{{$perm->name}}</label>
            </div>
            @endforeach
            <script>
                $('input[type="checkbox"]').click(function(e){
                    e.preventDefault()
                    $('input[type="checkbox"]').prop('disabled', true);
                    var name = $(this).data('name');
                    var group = $(this).data('group');
                    var second = $(this).data('second');
                    axios({
                            method: 'PUT',
                            url: '/manage/roles/{{$role->id}}',
                            data: {
                                pid: name,
                                perm: 1
                            }
                    })
                    .then(function(response) {
                    $('input[type="checkbox"]').prop('disabled', false);
                            if (response.data.success) {
                                AlertSuccess(response.data.success);
                                if(second=="*"){
                                    $(`input[data-group="${group}"]`).prop('checked', response.data.status);
                                }else if(group=="*"){
                                    $('input[type="checkbox"]').prop('checked',  response.data.status);
                                }else{
                                    $(`input[data-name="${name}"]`).prop('checked', response.data.status);
                                }
                            } else {
                                AlertError(response.data.error);
                            }
                        });
                })
                $('#edit-name').submit(function(e){
                    $('input[type="checkbox"]').prop('disabled', true);
                    e.preventDefault()
                    $(this).hide()
                    $('#loading').removeClass('d-none');
                    axios({
                            method: 'PUT',
                            url: '/manage/roles/{{$role->id}}',
                            data: {
                                name: $("#name").val()
                            }
                        })
                        .then(function(response) {
                    $('input[type="checkbox"]').prop('disabled', false);

                            $('#loading').addClass('d-none');
                            $('#edit-name').show()
                            if (response.data.success) {
                                Validate('#name')
                                AlertSuccess(response.data.success)
                            } else {
                                if (response.data.error) {
                                    AlertError(response.data.error);
                                }
                                Validate('#name')
                                $.each(response.data, function(key, value) {
                                    console.log(key, value)
                                    InValidate('#' + key, value)
                                });
                            }
                        });
                })
            </script>
        </div>
    </div>
</div>
<script>
    navitem = document.getElementById('adminlink').classList.add('active')
    const observer = lozad(); // lazy loads elements with default selector as '.lozad'
    observer.observe();
</script>
@endsection