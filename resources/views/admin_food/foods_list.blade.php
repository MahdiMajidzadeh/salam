@extends('master-dashboard')

@section('title', 'لیست غذا ها')

@section('inner-content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">نام غذا</th>
            <th scope="col">قیمت</th>
            <th scope="col">رستوران</th>
        </tr>
        </thead>
        <tbody>
        @foreach($foods as $food)
            <tr>
                <td>{{ $food->name }}</td>
                <td>{{ $food->price }}</td>
                <td>{{ $food->Restaurant->name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
