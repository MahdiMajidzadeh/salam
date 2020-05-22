@foreach ($errors->all() as $message)
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
@endforeach
@if (session('msg-error'))
    <div class="alert alert-danger" role="alert">
        {{ session('msg-error') }}
    </div>
@endif
@if (session('msg-ok'))
    <div class="alert alert-success" role="alert">
        {{ session('msg-ok') }}
    </div>
@endif