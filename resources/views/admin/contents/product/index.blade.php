@extends('admin.index')
@section('heads')
    <title>@lang('product.title.index')</title>
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
                            <h6 class="text-white text-capitalize ps-3">
                                @lang('product.table.title')
                            </h6>
                            <a href="{{ route('product.create') }}"
                                class="btn bg-gradient-success me-3">@lang('product.button.add')
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-secondary text-xxs font-weight-bolder opacity-7">
                                            @lang('product.table.name')
                                        </th>
                                        <th class="text-secondary text-xxs font-weight-bolder opacity-7">
                                            @lang('product.table.description')
                                        </th>
                                        <th class="text-secondary text-xxs font-weight-bolder opacity-7">
                                            @lang('product.table.price')
                                        </th>
                                        <th class="text-secondary text-xxs font-weight-bolder opacity-7">
                                            @lang('product.table.image')
                                        </th>
                                        <th class="text-secondary text-xxs font-weight-bolder opacity-7">
                                            @lang('product.table.category')
                                        </th>
                                        <th class="text-secondary text-xxs font-weight-bolder opacity-7">
                                            @lang('product.table.created_by')
                                        </th>
                                        <th class="text-secondary text-xxs font-weight-bolder opacity-7">
                                            @lang('product.table.action')
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>
                                                <div class="d-flex flex-column px-3">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $product->name }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column px-3">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $product->description }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column px-3">
                                                    <p class="text-xs font-weight-bold mb-0">{{ number_format($product->price, 2) }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column px-3">
                                                    <img class="avatar avatar-sm me-3" src="{{ asset($product->image) }}" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column px-3">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $product->category->name ?? '-' }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column px-3">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $product->user->name ?? '-' }}</p>
                                                </div>
                                            </td>
                                            <td class="d-flex align-middle gap-1">
                                                <form method="POST" action="{{ route('product.destroy', $product->id) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit"
                                                        class="btn btn-outline-primary">@lang('product.button.delete')
                                                    </button>
                                                </form>
                                                <a href="{{ route('product.edit', $product->id) }}"
                                                    class="btn btn-outline-secondary">@lang('product.button.edit')
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
