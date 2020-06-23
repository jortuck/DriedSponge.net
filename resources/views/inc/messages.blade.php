@if(count($errors)>0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif
<div class="white-text">
    This site is in alpha
</div>
@if (session('success'))
<div class='alert alert-success'>
    {{session('success')}}
</div>
@endif
@if (session('error'))
<script>
    AlertError("{{session('error')}}")
</script>
@endif
