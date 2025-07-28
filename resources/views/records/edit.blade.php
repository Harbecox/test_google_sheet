@extends('layouts.app')

@section('content')
    <h2>{{ isset($record) ? 'Редактировать' : 'Создать' }}</h2>

    <form method="POST" action="{{ isset($record) ? route('records.update', $record) : route('records.store') }}">
        @csrf
        @if(isset($record)) @method('PUT') @endif

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $record->title ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Author</label>
            <input name="author" class="form-control" value="{{ old('author', $record->author ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category" class="form-select" required>
                <option value="News" @selected(old('category', $record->category ?? '') === 'News')>News</option>
                <option value="Sports" @selected(old('category', $record->category ?? '') === 'Sports')>Sports</option>
                <option value="Entertainment" @selected(old('category', $record->category ?? '') === 'Entertainment')>Entertainment</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ old('description', $record->description ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Статус</label>
            <select name="status" class="form-select" required>
                <option value="Allowed" @selected(old('status', $record->status ?? '') === 'Allowed')>Allowed</option>
                <option value="Prohibited" @selected(old('status', $record->status ?? '') === 'Prohibited')>Prohibited</option>
            </select>
        </div>

        <a href="{{ route('records.index') }}" class="btn btn-secondary">Назад</a>
        <button class="btn btn-success">Сохранить</button>
    </form>
@endsection
