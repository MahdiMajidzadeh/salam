@extends('template.master-dashboard')

@section('title', $title)

@section('inner-content')
    <div class="row">
        <div class="col-12 my-3">
            <h2>{{ $title }}</h2>
        </div>
        @foreach($items as $item)
            <div class="col-6 col-md-3">
                <a href="{{ url('rofagha/?'.$slug.'='. $item->id) }}">
                    <div class="card my-2">
                        <div class="card-body text-center">
                            {{ $item->name }}
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

@endsection
