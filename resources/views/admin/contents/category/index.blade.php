@extends('admin.index')
@section('heads')
    <title>@lang('category.title.index')</title>
@endsection
@section('content')
    <div class="container-fluid py-4">
        @include('admin.components.alert')
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div
                            class="d-flex justify-content-between align-items-center bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">@lang('category.table.title')</h6>
                            <a href="{{ route('category.create') }}" class="btn bg-gradient-success me-3">@lang('category.button.add')</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-secondary text-xxs font-weight-bolder opacity-7">
                                            @lang('category.table.name')
                                        </th>
                                        <th class="text-secondary text-xxs font-weight-bolder opacity-7">
                                            @lang('category.table.action')
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>
                                                <div class="d-flex flex-column px-3">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $category->name }}</p>
                                                </div>
                                            </td>
                                            <td class="d-flex align-middle gap-1">
                                                <form method="POST" action="{{ route('category.destroy', $category->id) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit"
                                                        class="btn btn-outline-primary">@lang('category.button.delete')</button>
                                                </form>
                                                <a href="{{ route('category.edit', $category->id) }}"
                                                    class="btn btn-outline-secondary">@lang('category.button.edit')
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
