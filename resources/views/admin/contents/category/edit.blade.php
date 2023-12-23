@extends('admin.index')
@section('heads')
    <title>@lang('category.title.create')</title>
@endsection
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <form class="col-md-6" action="{{ route('category.update', $category->id) }}" method="POST">
                @method('PATCH')
                @csrf
                <div
                    class="input-group input-group-static {{ $errors->has('name') || $errors->has('slug') ? 'is-invalid' : 'mb-2' }}">
                    <label>@lang('category.table.name')</label>
                    <input type="text" class="form-control" name="name" value="{{ $errors->has('name') || $errors->has('slug') ? old('name') : $category->name }}">
                </div>
                @error('name')
                    <div class="invalid-feedback text-xs mb-2">
                        {{ $message }}
                    </div>
                @enderror
                @error('slug')
                    <div class="invalid-feedback text-xs mb-2">
                        {{ $message }}
                    </div>
                @enderror
                <button type="submit" class="btn bg-gradient-success">@lang('category.button.edit')</button>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
