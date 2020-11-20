@extends('master-dashboard')

@section('title', 'لیست ادمین ها')

@section('inner-content')
    <div class="card  d-print-none my-4">
        <div class="card-body">
            <form class="form-inline">
                <div class="form-group ml-3">
                    <label for="name">نام : </label>
                    <input type="text" class="form-control" name="user" id="autocomplete"/>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">کد</th>
            <th scope="col">اسم</th>
            <th scope="col">اسم</th>
        </tr>
        </thead>
        <tbody>
        @foreach($admins as $user)
            <tr class="@if(!is_null($user->deactivated_at)) text-muted @endif">
                <td>{{ $user->id }}</td>
                <td>{{ $user->employment_id }}</td>
                <td>{{ $user->name }}</td>
                <td><a href="{{ url('admin/acl/'. $user->id) }}" class="btn btn-dark">ویرایش</a> </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@push('js')
    <script src="{{ mix('js/jquery.autocomplete.min.js') }}"></script>
    <script>
        $('#autocomplete').autocomplete({
            serviceUrl: '{{ url('admin/ajax/users/list') }}',
            paramName: 'q',
            transformResult: function(response) {
                return {
                    suggestions: $.map(JSON.parse(response).data, function(dataItem) {
                        return { value: dataItem.name, data: dataItem.id };
                    })
                };
            },
            onSelect: function (suggestion) {
                window.location.replace('{{ url('admin/acl') }}/'+ suggestion.data);
            }
        });
    </script>
@endpush