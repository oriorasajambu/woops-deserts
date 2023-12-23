@extends('admin.index')
@section('heads')
    <title>@lang('product.title.create')</title>
@endsection
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <form class="card-body px-5 pb-2 row gap-3" action="{{ route('product.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="input-group input-group-static mb-4">
                            <label for="category" class="ms-0">@lang('product.table.category')</label>
                            <select class="form-control" id="category" name="category">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('category')
                            <div class="invalid-feedback text-xs mb-2">
                                {{ $message }}
                            </div>
                        @enderror

                        <div
                            class="input-group input-group-static {{ $errors->has('name') || $errors->has('slug') ? 'is-invalid' : 'mb-2' }}">
                            <label>@lang('product.table.name')</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
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

                        <div
                            class="input-group input-group-dynamic {{ $errors->has('description') ? 'is-invalid' : 'mb-2' }}">
                            <textarea name="description" class="form-control" rows="5" placeholder="@lang('product.table.description')" spellcheck="false">{{ old('description') }}</textarea>
                        </div>
                        @error('description')
                            <div class="invalid-feedback text-xs mb-2">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="input-group input-group-static {{ $errors->has('price') ? 'is-invalid' : 'mb-2' }}">
                            <label>@lang('product.table.price')</label>
                            <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                        </div>
                        @error('price')
                            <div class="invalid-feedback text-xs mb-2">
                                {{ $message }}
                            </div>
                        @enderror

                        <input type="file" name="image" accept="image/png,image/gif,image/jpeg"
                            class="{{ $errors->has('image') ? 'is-invalid' : '' }} w-100" aria-describedby="image">
                        @error('image')
                            <div class="invalid-feedback text-xs mt-2">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="d-flex flex-row mt-3">
                            <div class="form-check ps-0">
                                <input id="watermark" class="form-check-input" type="checkbox" checked name="watermark">
                                <label class="custom-control-label tooltips" for="watermark" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-container="body" data-animation="true"
                                    data-bs-trigger="hover" title="Add Watermark Bottom Right Corner">Watermark</label>
                            </div>
                            <div class="form-check">
                                <input id="compress" class="form-check-input" type="checkbox" checked name="compress">
                                <label class="custom-control-label tooltips" for="compress" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-container="body" data-animation="true"
                                    data-bs-trigger="hover"
                                    title="Compress Image to width 300 in respect of Aspect Ratio">Compress</label>
                            </div>
                        </div>

                        <button type="submit" class="btn bg-gradient-success">@lang('product.button.add')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
