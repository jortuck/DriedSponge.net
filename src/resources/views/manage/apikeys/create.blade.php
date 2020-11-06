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
            <a href="#" onclick="Reset()">Create Another Api Key</a>
            <a href="{{route('api.index')}}">Return To Api Keys Page</a>
        </div>
    </div>
    <div class="card">
        <form action="{{route('api.store')}}" method="post"  id='create-key' class="col s6">
        <div class="card-content">
          <div class="row">
            <div class="input-field col s12">
              <input  id="key_name" name="key_name" type="text" class="validate" maxlength="50">
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
        function Reset(){
            $('#success-message').addClass("d-none");
            $('#create-key').show().formReset();
        }
        $(() => {
            $('#create-key').formInit({
                callback: function (response) {
                    if (response.data.success) {
                        $("#create-key").hide();
                        $("#succtext").html(response.data.success);
                        $('#success-message').removeClass('d-none')
                    } else {
                        $('#create-key').show()
                        if (response.data.error) {
                            window.AlertError(response.data.error);
                        }
                        var r = response.data;
                        for (var key in r){
                            MaterialInvalidate(key, r[key][0],true)
                        }
                    }
                },
                loader: {
                    enabled:true,
                    fullScreen:false,
                    destroyLoader:true,
                    theme:"loading-cover-dark"
                },
            });
        })
    </script>
</div>
<script>
    const observer = lozad();
    observer.observe();
</script>
@endsection
