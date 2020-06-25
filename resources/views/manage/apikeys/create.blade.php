@extends('layouts.manage')
@section('title','Create New Role')
@section('description',"Create New Role")
@section('content')
<div class="container" id="#content">
    <h2>Create An API Key</h2>
    <br>
    @include('inc.FormMsg')
    <div class="d-none card" id="success-message">
        <div class="card-content green">
            <h4>Success!</h4>
            <p id="succtext"></p>
        </div>
        <div class="card-action">
            <a href="{{route('api.create')}}">Create Another Api Key</a>
            <a href="{{route('api.index')}}">Return To Api Keys Page</a>
        </div>
    </div>
    <div class="card">
        <form  id='create-key' class="col s6">
        <div class="card-content">
          <div class="row">
            <div class="input-field col s12">
              <input  id="key_name" type="text" class="validate" maxlength="50">
                <label  for="key_name">Key Name</label>
                <span id="role_name-msg" class="helper-text" data-error="" data-success=""></span>
            </div>
          </div>
        </div>
        <div class="card-action">
            <button type="submit" class="btn green">Create Key</button>
            &nbsp;
            <a href="{{route('api.index')}}" class="btn red">Cancel</a>
        </div>
        </form>
      </div>
    <script>
        $('#create-key').submit(function(e) {
            e.preventDefault()
            $(this).hide()
            $('#loading').removeClass('d-none');
            axios({
                    method: 'post',
                    url: '{{route('api.store')}}',
                    data: {
                        key_name: $("#key_name").val()
                    }
                })
                .then(function(response) {
                    $('#loading').addClass('d-none');
                    if (response.data.success) {
                        $("#succtext").html(response.data.success);
                        $('#success-message').removeClass('d-none')
                    } else {
                        $('#create-key').show()
                        if (response.data.error) {
                            window.AlertError(response.data.error);
                        }
                        window.MaterialValidate('#key_name')
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
