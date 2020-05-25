@extends('master-dashboard')

@section('title', 'لیست کاربران')

@section('inner-content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">اسم</th>
            <th scope="col">موبایل</th>
            <th scope="col">سطح دسترسی</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->mobile }}</td>
                <td>{{ roleName($user->role_id) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$users->links()}}
@endsection
