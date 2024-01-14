@extends('public.index')
@section('heads')
    <title>Keranjang</title>
@endsection
@section('content')
    <header class="header-2">
        <div class="page-header min-vh-75 relative">
            <span class="mask bg-gradient-primary opacity-4 pt-6"></span>
            <form class="container mt-6" action="{{ route('order.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="card card-body blur shadow-blur col-lg-6 my-6 bg-light">
                        <div class="px-6">
                            <div class="row">
                                @livewire('textfield.input-text-field', [
                                    'id' => 'email',
                                    'type' => 'text',
                                    'label' => 'Email',
                                ])
                            </div>
                            <div class="row">
                                @livewire('textfield.input-text-field', [
                                    'id' => 'country',
                                    'type' => 'text',
                                    'label' => 'Negara',
                                ])
                            </div>
                            <div class="row">
                                @livewire('textfield.input-text-field', [
                                    'id' => 'first_name',
                                    'type' => 'text',
                                    'label' => 'Nama Pertama',
                                ])
                                @livewire('textfield.input-text-field', [
                                    'id' => 'last_name',
                                    'type' => 'text',
                                    'label' => 'Nama Akhir',
                                ])
                            </div>
                            <div class="row">
                                @livewire('textfield.input-text-field', [
                                    'id' => 'company',
                                    'type' => 'text',
                                    'label' => 'Perusahaan (Optional)',
                                ])
                            </div>
                            <div class="row">
                                @livewire('textfield.input-text-field', [
                                    'id' => 'address',
                                    'type' => 'text',
                                    'label' => 'Alamat',
                                ])
                            </div>
                            <div class="row">
                                @livewire('textfield.input-text-field', [
                                    'id' => 'city',
                                    'type' => 'text',
                                    'label' => 'Kota',
                                ])
                            </div>
                            <div class="row">
                                @livewire('textfield.input-text-field', [
                                    'id' => 'province',
                                    'type' => 'text',
                                    'label' => 'Provinsi',
                                ])
                                @livewire('textfield.input-text-field', [
                                    'id' => 'postal_code',
                                    'type' => 'text',
                                    'label' => 'Kode Pos',
                                ])
                            </div>
                            <div class="row">
                                @livewire('textfield.input-text-field', [
                                    'id' => 'phone',
                                    'type' => 'text',
                                    'label' => 'Nomor Telepon',
                                ])
                            </div>
                            @livewire('button.complete-order-button')
                        </div>
                    </div>
                    @livewire('cart.preview-cart')
                </div>
            </form>
        </div>
    </header>
@endsection
@section('scripts')
@endsection
