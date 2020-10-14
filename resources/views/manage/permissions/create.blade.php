@extends('layouts.manage')
@section('title','Create New Permission')
@section('description',"Create New Permission")
@section('content')
<div class="container" id="content">
            <h2>Create New Permission</h2>
            @include('inc.FormMsg')
            <div class="d-none card" id="success-message">
                <div class="card-content green">
                    <h4>Success!</h4>
                    <p id="succtext"></p>
                </div>
                <div class="card-action">
                    <a href="{{route('permissions.create')}}">Create Another Permission</a>
                    <a href="{{route('permissions.index')}}">Return To Permissions Page</a>
                </div>
            </div>
            <div class="card">
                <form id="create-perm">
                    <div class="card-content">
                        <div class="input-field">
                            <input class="validate" id='perm_name' maxlength="30"  type="text">
                            <label for='perm_name'>Permission Name</label>
                            <span data-error="" data-success="" class="helper-text" id='perm_name-msg'></span>
                        </div>
                        <label>
                            <input type="checkbox" value="api_perm" class="filled-in" id="api_perm" />
                            <span>Api Permission</span>
                        </label>
                    </div>
                    <div class="card-action">
                        <button class="btn green" type="submit">Create Permission</button>
                        &nbsp;
                        <a class="btn red" href="{{route('permissions.index')}}">Cancel</a>
                    </div>
                </form>
            </div>
            <script>
                $('#create-perm').submit(function(e){
                    e.preventDefault()
                    $(this).hide()
                    $('#loading').removeClass('d-none');
                    axios({
                            method: 'post',
                            url: '/manage/permissions',
                            data: {
                                perm_name: $("#perm_name").val(),
                                api_perm: $('#api_perm').check()
                            }
                        })
                        .then(function(response) {
                            $('#loading').addClass('d-none');
                            if (response.data.success) {
                                $("#succtext").html(response.data.success);
                                $("#success-message").removeClass('d-none');
                            } else {
                                $('#create-perm').show()
                                if (response.data.error) {
                                    AlertMaterializeError(response.data.error);
                                }
                                MaterialValidate('#name')
                                $.each(response.data, function(key, value) {
                                    console.log(key, value)
                                    MaterialInvalidate('#' + key, value)
                                });
                            }
                        });
                })
            </script>
</div>
<script>
    const observer = lozad(); // lazy loads elements with default selector as '.lozad'
    observer.observe();
</script>
@endsection
