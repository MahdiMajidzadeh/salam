@extends('template.master-dashboard')

@section('title', 'تنظیمات کاربر')

@section('inner-content')
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3">
            <nav class="nav">
                <a class="nav-link btn btn-secondary" href="{{ url('/setting/') }} ">کاربر</a>
                <a class="nav-link" href="{{ url('/setting/tahdig') }} ">ته دیگ</a>
                <a class="nav-link" href="{{ url('/setting/password-reset') }}">تغیر رمز</a>
            </nav>
        </div>
        <div class="col-12 col-md-6 offset-md-3">
            @include('template.messages')
            <div class="card my-4">
                <div class="card-body">
                    <form method="post" action="{{ url('setting') }}">
                        @csrf
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
                            <input type="text" class="form-control" value="{{ $user->employee_id }}" disabled>
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
                            <label>معرفی</label>
                            <textarea class="form-control" name="biography">{{ $user->biography }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>پروفایل لینکدین</label>
                            <input type="text" class="form-control" name="linkedin_url"
                                   value="{{ $user->linkedin_url }}">
                        </div>
                        <div class="form-group">
                            <label>پروفایل ویرگول</label>
                            <input type="text" class="form-control" name="virgool_url"
                                   value="{{ $user->virgool_url }}">
                        </div>
                        <button type="submit" class="btn btn-primary">تغییر</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection