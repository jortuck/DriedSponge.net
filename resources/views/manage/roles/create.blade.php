@extends('layouts.manage')
@section('title','Create New Role')
@section('description',"Create New Role")
@section('content')
<div class="container" id="#content">
    <br>
    <div class="row">
        <form id='create-role' class="col s12">
          <div class="row">
            <div class="input-field col s12">
              <input id="role_name" type="text" class="validate">
              <label for="role_name">Last Name</label>
            </div>
          </div>
          <button type="submit" class="btn green">Create Role</button>
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