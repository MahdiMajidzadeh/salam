@extends('template.master-dashboard')

@section('title', 'لیست یادداشت های انبوردینگ')

@section('inner-content')
    <div class="card my-4">
        <div class="card-body">
            <a href="{{ url('admin/welcome/notes/create') }}" class="btn btn-primary">افزودن یادداشت</a>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">روز</th>
            <th scope="col">عنوان</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($notes as $note)
            <tr>
                <td>{{ $note->day }}</td>
                <td>{{ $note->title }}</td>
                <td>
                    <a href="{{ url('admin/welcome/notes/'.$note->id.'/edit') }}" class="btn btn-primary">ویرایش</a>
                    <a href="{{ url('admin/welcome/notes/'.$note->id.'/delete') }}"
                       class="btn btn-outline-primary">حذف</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
