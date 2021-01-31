@extends('template.master-dashboard')

@section('title', 'لیست ادمین ها')

@section('inner-content')
    <div class="card  d-print-none">
        <div class="card-body">
            <form class="form-inline">
                <div class="form-group ml-3">
                    <label for="name">نام : </label>
                    {{ $user->name }}
                </div>
            </form>
        </div>
    </div>

    <div class="card  d-print-none">
        <div class="card-body">
            <form action="{{ url('notice') }}" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                @foreach($permissions as $permission)
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="permissions[]"
                               value="{{ $permission->id }}" id="per_{{ $permission->id }}"
                                @if(in_array($permission->id,$userPermissions->toArray())) checked @endif>
                        <label class="custom-control-label"
                               for="per_{{ $permission->id }}">{{ $permission->name }}</label>
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary mb-2">ثبت</button>
            </form>
        </div>
    </div>
@endsection