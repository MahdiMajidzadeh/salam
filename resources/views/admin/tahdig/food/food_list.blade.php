@extends('template.master-dashboard')

@section('title', 'لیست غذا ها')

@section('inner-content')
    <table class="table table-striped" id="table">
        <thead>
        <tr>
            <th scope="col">شناسه</th>
            <th scope="col">نام غذا</th>
            <th scope="col">قیمت</th>
            <th scope="col">رستوران</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($foods as $food)
            <tr>
                <td>{{ $food->id }}</td>
                <td>{{ $food->name }}</td>
                <td>{{ $food->price }}</td>
                <td>{{ $food->Restaurant->name }}</td>
                <td><a href="{{ url('admin/foods/'.$food->id) }}" class="btn btn-primary">ویرایش</a> </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@push('css')
    <link href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

@push('js')
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#table').DataTable({
                paging: false
            });
        });
    </script>
@endpush