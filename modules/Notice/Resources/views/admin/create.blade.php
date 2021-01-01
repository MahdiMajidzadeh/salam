@extends('template.master-dashboard')

@section('title', 'افزودن اطلاعیه')

@section('inner-content')
    <div class="row">
        <div class="col-12 col-md-8 mx-auto">
            @include('template.messages')
            <div class="card my-4">
                <div class="card-body">
                    <form method="post" action="{{ url('admin/notices/create') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>عنوان</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="form-group">
                            <label>بنر</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file" name="banner">
                                <label class="custom-file-label" for="file">Choose file</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>تاریخ شروع: </label>
                                    <input type="text" class="form-control" id="date_start">
                                    <input type="hidden" class="form-control" name="date_start_alt" id="date_start_alt">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>تاریخ پایان: </label>
                                    <input type="text" class="form-control" id="date_end">
                                    <input type="hidden" class="form-control" name="date_end_alt" id="date_end_alt">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>محتوا</label>
                            <textarea class="form-control" name="content" id="summernote"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">افزودن</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="{{ mix('css/persian-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('summernote/summernote-bs4.min.css') }}" rel="stylesheet">
@endpush

@push('js')
    <script src="{{ mix('js/persian-date.min.js') }}"></script>
    <script src="{{ mix('js/persian-datepicker.min.js') }}"></script>
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
            $("#date_start").pDatepicker({
                altField: '#date_start_alt',
                altFormat: 'X',
                timePicker: {
                    enabled: true
                }
            });
            $("#date_end").pDatepicker({
                altField: '#date_end_alt',
                altFormat: 'X',
                timePicker: {
                    enabled: true
                }
            });
        });
    </script>
@endpush