@extends('layouts.manage')
@section('title','Create New Role')
@section('description',"Create New Role")
@section('content')
<div class="container" id="#content">
    <h2>Create Role</h2>
    <br>
    @include('inc.FormMsg')
    <div class="d-none card" id="success-message">
        <div class="card-content green">
            <h4>Success!</h4>
            <p id="succtext"></p>
        </div>
        <div class="card-action">
            <a href="{{route('roles.create')}}">Create Another Role</a>
            <a href="{{route('roles.index')}}">Return To Roles Page</a>
        </div>
    </div>
    <div class="card">
        <form  id='create-role' class="col s6">
        <div class="card-content">
          <div class="row">
            <div class="input-field col s12">
              <input  id="role_name" type="text" class="validate">
                <label  for="role_name">Role Name</label>
                <span id="role_name-msg" class="helper-text" data-error="" data-success=""></span>
            </div>
          </div>
        </div>
        <div class="card-action">
            <button type="submit" class="btn green">Create Role</button>
            &nbsp;
            <a href="{{route('roles.index')}}" class="btn red">Cancel</a>
        </div>
        </form>
      </div>
    <script>
        $('#create-role').submit(function(e) {
            e.preventDefault()
            $(this).hide()
            $('#loading').removeClass('d-none');
            axios({
                    method: 'post',
                    url: '{{route('roles.store')}}',
                    data: {
                        role_name: $("#role_name").val()
                    }
                })
                .then(function(response) {
                    $('#loading').addClass('d-none');
                    if (response.data.success) {
                        $("#succtext").html(response.data.success);
                        $('#success-message').removeClass('d-none')
                    } else {
                        $('#create-role').show()
                        if (response.data.error) {
                            wiwndow.AlertError(response.data.error);
                        }
                        window.MaterialValidate('#role_name')
                        $.each(response.data, function(key, value) {
                            window.MaterialInvalidate('#' + key, value)
                        });
                    }
                });
        })
    </script>
</div>
<script>
    const observer = lozad();
    observer.observe();
</script>
@endsection
