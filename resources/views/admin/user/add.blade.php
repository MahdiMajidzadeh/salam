@extends('template.master-dashboard')

@section('title', 'افزودن کاربر')

@section('inner-content')
    <div class="row">
        <div class="col-12 col-md-6 mx-auto">
            @include('template.messages')
            <div class="card my-4">
                <div class="card-body">
                    <form method="post" action="{{ url('admin/users/add') }}">
                        @csrf
                        <div class="form-group">
                            <label>اسم</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label>موبایل</label>
                            <input type="text" class="form-control" name="mobile">
                        </div>
                        <div class="form-group">
                            <label>شماره پرسنلی</label>
                            <input type="text" class="form-control" name="employee_id">
                        </div>
                        <div class="form-group">
                            <label>تیم</label>
                            <select class="form-control" name="team">
                                <option value="">--</option>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>چپتر</label>
                            <select class="form-control" name="chapter">
                                <option value="">--</option>
                                @foreach($chapters as $chapter)
                                    <option value="{{ $chapter->id }}">{{ $chapter->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>ایمیل</label>
                            <input type="text" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label>ایمیل باسلامی</label>
                            <input type="text" class="form-control" name="email_basalam">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="is_inter"
                                       id="is_inter">
                                <label class="custom-control-label" for="is_inter">کارآموز</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">افزودن</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
