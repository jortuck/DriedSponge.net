@extends('layouts.manage')
@section('title','Create New Role')
@section('description',"Create New Role")
@section('content')
<div class="container-fluid-lg">
    <div class="container-fluid">
        <div class="content-box">
            <h1>Create New Role</h1>
            @include('inc.FormMsg')      
            <form id="create-role">
                <div class="form-group">
                    <label for='name'>Role Name</label>
                    <input id='name' feedback="#name-f" maxlength="30" minlength="3" class="form-control form-control-alternative" placeholder="Enter a name for this role">
                    <div id='name-f'></div>
                </div>
                <button class="btn btn-success" type="submit">Create Role</button>
            </form>
            <script>
                $('#create-role').submit(function(e){
                    e.preventDefault()
                    $(this).hide()
                    $('#loading').removeClass('d-none');
                    axios({
                            method: 'post',
                            url: '/manage/roles',
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