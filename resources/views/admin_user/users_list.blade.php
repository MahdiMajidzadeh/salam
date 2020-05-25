@extends('master-dashboard')

@section('title', 'لیست کاربران')

@section('inner-content')
    <div class="card  d-print-none">
        <div class="card-body">
            <form class="form-inline">
                <div class="form-group ml-3">
                    <label for="name">نام : </label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group ml-3">
                    <label for="mobile">موبایل : </label>
                    <input type="text" class="form-control" id="mobile" name="mobile">
                </div>
                <button type="submit" class="btn btn-primary ml-3">جستجو</button>
            </form>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">اسم</th>
            <th scope="col">موبایل</th>
            <th scope="col">سطح دسترسی</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->mobile }}</td>
                <td>{{ roleName($user->role_id) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$users->links()}}
@endsection
