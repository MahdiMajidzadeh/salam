@extends('template.master-dashboard')

@section('title', 'لیست اطلاعیه ها')

@section('inner-content')
    <div class="card my-4">
        <div class="card-body">
            <a href="{{ url('admin/notices/create') }}" class="btn btn-primary">افزودن اطلاعیه</a>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">اسم</th>
            {{--<th scope="col"></th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach($notices as $notice)
            <tr>
                <td>{{ $notice->id }}</td>
                <td>{{ $notice->title }}</td>
{{--                <td><a href="{{ url('admin/users/'.$user->id) }}" class="btn btn-primary">ویرایش</a></td>--}}
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $notices->links() }}
@endsection
