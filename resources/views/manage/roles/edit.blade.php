@extends('layouts.manage')
@section('title','Edit '.$role->name)
@section('description','Edit '.$role->name)
@section('content')
<div class="container-fluid-lg">
    <div class="container-fluid">
        <div class="content-box">
        <h1>Edit {{$role->name}}</h1>
            @include('inc.FormMsg')      
            <form id="edit-role">
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
                <input onclick="toggleperm('{{$perm->id}}')" class="custom-control-input" id="perm-{{$perm->id}}" type="checkbox" @if ($role->hasPermissionTo($perm->name)) checked @endif >
                <label class="custom-control-label" name='{{$perm->name}}' value="{{$perm->name}}" for="perm-{{$perm->id}}">{{$perm->name}}</label>
            </div>
            @endforeach
            <script>
                function toggleperm(name){
                    $('#loading').removeClass('d-none');
                    axios({
                            method: 'PUT',
                            url: '/manage/roles/{{$role->id}}',
                            data: {
                                pid: name,
                                perm: 1
                            }
                    })
                    .then(function(response) {
                            $('#loading').addClass('d-none');
                            if (response.data.success) {
                                AlertSuccess(response.data.success);
                            } else {
                                AlertError(response.data.error);
                            }
                        });
                }
                $('#create-role').submit(function(e){
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
                            $('#loading').addClass('d-none');
                            if (response.data.success) {
                                $("#success-message").html(response.data.success);
                                $("#success-message").removeClass('d-none');
                                setInterval(function() {
                                    location.href = '/manage/roles';
                                }, 2500)
                            } else {
                                $('#create-role').show()
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