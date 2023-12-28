@extends('admin.index')
@section('heads')
    <title>Payment Report</title>
@endsection
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div
                            class="d-flex justify-content-between align-items-center bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">
                                @lang('payment.table.title')
                            </h6>
                            {{-- <button type="button" 
                                data-bs-toggle="modal" 
                                data-bs-target="#modal-create-payment" 
                                class="btn bg-gradient-success me-3">@lang('payment.button.add')
                            </button> --}}
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        @livewire('table.payment-table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
