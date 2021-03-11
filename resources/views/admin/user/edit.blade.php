@extends('template.master-dashboard')

@section('title', 'ویرایش کاربر')

@section('inner-content')
    <div class="row">
        @include('template.messages')
        <div class="col-12 col-md-6">
            <div class="card my-4">
                <div class="card-body">
                    <form method="post" action="{{ url('admin/users/edit') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="form-group">
                            <label>اسم</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>موبایل</label>
                            <input type="text" class="form-control" value="{{ $user->mobile }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>شماره پرسنلی</label>
                            <input type="text" class="form-control" name="employee_id"
                                   value="{{ $user->employee_id }}">
                        </div>
                        <div class="form-group">
                            <label>تیم</label>
                            <select class="form-control" name="team">
                                <option>--</option>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}"
                                            @if($user->team_id == $team->id) selected @endif
                                    >{{ $team->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>چپتر</label>
                            <select class="form-control" name="chapter">
                                <option>--</option>
                                @foreach($chapters as $chapter)
                                    <option value="{{ $chapter->id }}"
                                        @if($user->chapter_id == $chapter->id) selected @endif
                                    >{{ $chapter->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>ایمیل</label>
                            <input type="text" class="form-control" name="email"
                                   value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label>ایمیل باسلامی</label>
                            <input type="text" class="form-control" name="email_basalam"
                                   value="{{ $user->email_basalam }}">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="is_inter"
                                       id="is_inter"
                                       @if($user->is_inter) checked="checked" @endif
                                >
                                <label class="custom-control-label" for="is_inter">کارآموز</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">ثبت</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card my-4">
                <div class="card-body">
                    <form method="post" action="{{ url('admin/users/edit/avatar') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="form-group">
                            @if(!is_null($user->avatar))
                            <img src="{{ asset(Illuminate\Support\Facades\Storage::url($user->avatar)) }}" class="img-fluid mb-3">
                            @endif
                            <label>آواتار</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="avatar">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">ثبت</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
