@extends('layouts.app')

@section('content')
    <h1>Records</h1>

    <div class="mb-3 d-flex justify-content-between">
        <div class="d-flex gap-2 align-items-end">
            <a href="{{ route('records.create') }}" class="btn btn-primary">Создать</a>

            <form class="d-flex align-items-end" action="{{ route('records.generate') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-warning">Сгенерировать 1000 строк</button>
            </form>

            <form class="d-flex align-items-end" action="{{ route('records.truncate') }}" method="POST" onsubmit="return confirm('Удалить все?')">
                @csrf
                <button type="submit" class="btn btn-danger">Очистить таблицу</button>
            </form>
        </div>

        <form action="{{ route('records.export_settings.update') }}" class="d-flex gap-2 align-items-end" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label>sheet url</label>
                <input name="google_sheet_url" class="form-control" value="{{ $export_setting->google_sheet_url ?? "" }}">
            </div>
            <div>
                <label>sheet name</label>
                <input name="google_sheet_name" class="form-control" value="{{ $export_setting->google_sheet_name ?? "" }}">
            </div>
            <button type="submit" class="btn btn-success">Сохранить</button>
        </form>
    </div>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Category</th>
            <th>Views</th>
            <th>Status</th>
            <th>Created</th>
            <th>Updated</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($records as $record)
            <tr>
                <td>{{ $record->id }}</td>
                <td>{{ $record->title }}</td>
                <td>{{ $record->author }}</td>
                <td>{{ $record->category }}</td>
                <td>{{ $record->views }}</td>
                <td>{{ $record->status }}</td>
                <td>{{ $record->created_at }}</td>
                <td>{{ $record->updated_at }}</td>
                <td>
                    <a href="{{ route('records.edit', $record) }}" class="btn btn-sm btn-info">Edit</a>
                    <form action="{{ route('records.destroy', $record) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $records->links() }}
@endsection
