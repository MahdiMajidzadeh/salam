@extends('template.master')

@section('title', 'پخش زنده')

@section('css-box', 'login-bg')

@section('content')
    <div class="row justify-content-center align-items-center h100">
        <div class="col-12 text-center">
            <div class="text-white text-center">
                <h3 class="text-white">
                    باسلامیها
                </h3>
                <p class="text-white">پخش زنده</p>
            </div>
            <div id="twitch-embed"></div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://embed.twitch.tv/embed/v1.js"></script>
    <script type="text/javascript">
        new Twitch.Player("twitch-embed", {
            width: 854,
            height: 480,
            channel: "basalammasir",
            allowfullscreen: true,
            autoplay: true,
        });
    </script>
@endpush