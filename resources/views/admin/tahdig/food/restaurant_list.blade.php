@extends('template.master-dashboard')

@section('title', 'لیست رستوران')

@section('inner-content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">شناسه</th>
            <th scope="col">اسم</th>
        </tr>
        </thead>
        <tbody>
        @foreach($restaurants as $restaurant)
            <tr>
                <td>{{ $restaurant->id }}</td>
                <td>{{ $restaurant->name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
