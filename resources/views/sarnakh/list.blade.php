@extends('template.master-dashboard')

@section('title', 'دفترچه تلفن')

@section('inner-content')
    <div class="card-columns">
        @foreach($links as $link)
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <a href="{{ $link->url }}">
                        <div class="font-weight-bold text-black">{{ $link->title }}</div>
                        <div>
                            <small class="text-muted">{{ $link->description }}</small>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    </div>
@endsection