@extends('layouts.app')
@section('title','Feedback')
@section('description',"Submit feedback about my site. Let me know of any bugs or known issues")
@section('content')

<div class="container-fluid-lg">
    <div class="container-fluid">
        @guest
        <div class="content-box">
            <h1>You must login to send feedback</h1>
            <br>
            <div class="text-center">
                <a href='{{url('/login')}}'><img src='https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_02.png'></a>
                <br>
                <br>
                <h2>This is required so we can keep track of who sends feedback.</h2>
            </div>
        </div>
        @endguest
        @auth
        @if (Auth::user()->Bans)
            <div class="content-box">
                <h1>You Are Banned</h1>
                <p class="text-center text-danger">You are banned and are not allowed to submit any data.</p>
            <p class="text-center text-danger"><b>{{Auth::user()->Bans->reason}}</b></p>
            </div>
        @else
        <div class="content-box">
            <h1>Send Feedback</h1>
            <p class="text-center">Send me feedback about this site or anything else in general</p>
            <div class="alert alert-success d-none" id="success-message" role="alert">
                Insert Success Message Here
            </div>
            <div id='loading' class="progress d-none">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
            </div>
            <form id="send-feedback">
                <div class="form-group">
                    <label for='subject'>Subject</label>
                    <input id='subject' feedback="#subject-f" class="form-control form-control-alternative" placeholder="Enter a subject">
                    <div id='subject-f'></div>
                </div>
                <div class="form-group">
                    <label for='Message'>Message</label>
                    <textarea id='message' feedback="#message-f" rows='5' class="form-control form-control-alternative" placeholder="Enter a message. Max 100 characters."></textarea>
                    <div id='message-f'></div>
                </div>
                <button type="submit" class="btn btn-success">Send Feedback</button>
            </form>
            <script>
                $('#send-feedback').submit(function(e) {
                    $('#send-feedback').hide()
                    $('#loading').removeClass('d-none');
                    e.preventDefault();
                    axios({
                            method: 'post',
                            url: '/feedback',
                            data: {
                                subject: $("#subject").val(),
                                message: $("#message").val()
                            }
                        })
                        .then(function(response) {
                            $('#loading').addClass('d-none');
                            if (response.data.success) {
                                $("#success-message").text(response.data.success);
                                $("#success-message").removeClass('d-none');
                                setInterval(function() {
                                    location.reload();
                                }, 4000)
                            } else {
                                $('#send-feedback').show()
                                if (response.data.error) {
                                    AlertError(response.data.error);
                                }
                                $.each(response.data, function(key, value) {
                                    console.log(key, value)
                                    InValidate('#' + key, value)
                                });
                            }
                        });
                })
            </script>
        </div >
        @endif
        @endauth
    </div>
</div>
<script>
    navitem = document.getElementById('otherlink').classList.add('active')
    const observer = lozad(); // lazy loads elements with default selector as '.lozad'
    observer.observe();
</script>
@endsection