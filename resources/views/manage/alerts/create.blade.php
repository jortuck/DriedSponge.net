@extends('layouts.manage')
@section('title','Create New Role')
@section('description',"Create New Role")
@section('content')
<div class="container" id="#content">
    <h2>Create Alert</h2>
    <br>
    @include('inc.FormMsg')
    <div class="d-none card" id="success-message">
        <div class="card-content green">
            <h4>Success!</h4>
            <p id="succtext"></p>
        </div>
        <div class="card-action">
            <a href="#" onclick="CreateNewResponse('#create-alert')">Post Another Alert</a>
            <a href="{{route('alerts.index')}}">Return To Alerts Page</a>
        </div>
    </div>
    <div class="card">
        <form  id='create-alert' class="col s6">
        <div class="card-content">
          <div class="row">
              <div class="input-field on-dark col s12 m12 l12">
                  <textarea  id="message" class="materialize-textarea validate" maxlength="1120 " data-length="1120 "></textarea>
                  <label for="message">Message *</label>
                  <span id="message-msg" class="helper-text" data-error="" data-success="" ></span>
              </div>
              <div class="input-field on-dark col s12 m12 l4">
                  <p>
                      <label>
                          <input type="checkbox" id="twitter" class="filled-in" />
                          <span>Post On Twitter</span>
                      </label>
                  </p>
              </div>
              <div class="input-field on-dark col s12 m12 l4">
                  <p>
                      <label>
                          <input type="checkbox" id="website" class="filled-in" />
                          <span>Post On Website</span>
                      </label>
                  </p>
              </div>
              <div class="input-field on-dark col s12 m12 l4">
                  <p>
                      <label>
                          <input type="checkbox" id="discord" class="filled-in" />
                          <span>Send To Discord</span>
                      </label>
                  </p>
              </div>
          </div>
        </div>
        <div class="card-action">
            <button type="submit" class="btn green">Post Alert</button>
            &nbsp;
            <a href="{{route('alerts.index')}}" class="btn red">Cancel</a>
        </div>
        </form>
      </div>
    <script>
        $(document).ready(function() {
            $('textarea, input[data-length]').characterCounter();
        });
        $('#create-alert').submit(function(e) {
            e.preventDefault()
            $(this).hide()
            $('#loading').removeClass('d-none');
            axios({
                    method: 'post',
                    url: '{{route('alerts.store')}}',
                    data: {
                        message: $("#message").val(),
                        twitter: $("#twitter").is(":checked"),
                        website: $("#website").is(":checked"),
                        discord: $("#discord").is(":checked")
                    }
                })
                .then(function(response) {
                    $('#loading').addClass('d-none');
                    if (response.data.success) {
                        $("#succtext").html(response.data.success);
                        $('#success-message').removeClass('d-none')
                    } else {
                        $('#create-alert').show()
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
