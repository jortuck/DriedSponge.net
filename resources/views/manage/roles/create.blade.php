@extends('layouts.manage')
@section('title','Create New Role')
@section('description',"Create New Role")
@section('content')
<div class="container" id="#content">
    <h2 class="white-text">Create Role</h2>
    <br>
    <div class="card grey darken-4-5">  
        <form  id='create-role' class="col s6">
        <div class="card-content">
          <div class="row">
            <div class="input-field dark col s12">
              <input id="role_name" type="text" class="validate">
              <label  for="role_name">Role Name</label>
            </div>
          </div>
        </div>
        <div class="card-action">
            <button type="submit" class="btn green">Create Role</button>
            &nbsp;
            <a href="/manage/roles" class="btn red">Cancel</a>
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
                    url: '/manage/roles',
                    data: {
                        name: $("#role_name").val()
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
                        Validate('#role_name')
                        $.each(response.data, function(key, value) {
                            console.log(key, value)
                            InValidate('#' + key, value)
                        });
                    }
                });
        })
    </script>
</div>
<script>
    //navitem = document.getElementById('adminlink').classList.add('active')
    const observer = lozad(); // lazy loads elements with default selector as '.lozad'
    observer.observe();
</script>
@endsection