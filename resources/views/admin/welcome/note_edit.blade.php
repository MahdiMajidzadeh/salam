@extends('template.master-dashboard')

@section('title', 'ویرایش یادداشت')

@section('inner-content')
    <div class="row">
        <div class="col-12 col-md-8 mx-auto">
            @include('template.messages')
            <div class="card my-4">
                <div class="card-body">
                    <form method="post" action="{{ url('admin/welcome/notes/edit') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $note->id }}">
                        <div class="form-group">
                            <label>عنوان</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title', $note->title) }}">
                        </div>
                        <div class="form-group">
                            <label>روز</label>
                            <input type="text" class="form-control" name="day" value="{{ old('day', $note->day) }}">
                        </div>
                        <div class="form-group">
                            <label>محتوا</label>
                            <textarea class="form-control" name="content" id="summernote">{{ old('content', $note->content) }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">افزودن</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="{{ asset('summernote/summernote-bs4.min.css') }}" rel="stylesheet">
@endpush

@push('js')
    <script src="{{ asset('summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('summernote/summernote-fa-IR.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#summernote').summernote({
                height: 400,
                lang: 'fa-IR',
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['insert', ['link', 'picture', 'video']],
                    ['table', ['table']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
@endpush