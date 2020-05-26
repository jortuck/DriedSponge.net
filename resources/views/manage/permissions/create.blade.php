@extends('layouts.manage')
@section('title','Create New Permission')
@section('description',"Create New Permission")
@section('content')
<div class="container-fluid-lg">
    <div class="container-fluid">
        <div class="content-box">
            <h1>Create New Permission</h1>
            @include('inc.FormMsg')      
            <form id="create-role">
                <div class="form-group">
                    <label for='name'>Permission Name</label>
                    <input id='name' feedback="#name-f" maxlength="30"  class="form-control form-control-alternative" placeholder="Enter a name for this permission">
                    <div id='name-f'></div>
                </div>
                <button class="btn btn-success" type="submit">Create Permission</button>
            </form>
            <script>
                $('#create-role').submit(function(e){
                    e.preventDefault()
                    $(this).hide()
                    $('#loading').removeClass('d-none');
                    axios({
                            method: 'post',
                            url: '/manage/permissions',
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
                                    location.href = '/manage/permissions';
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