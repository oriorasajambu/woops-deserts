<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-upload-payment">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h5 class="modal-title">Upload Bukti Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modal-body-form" class="modal-body">
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row justify-content-center">
                        <div class="align-self-center">
                        <img src="{{ asset('assets/public/img/logo_bri.png') }}" style="width: 100px">
                    </div>
                    </div>
                    <h3 class="text-center">Buat Pembayaran Via BRI</h3>
                    <h4 class="text-center">133301001105534</h4>
                    <p class="text-center">A.N Wulanda Apriliani</p>
                    <h4 class="text-center">@lang('currency.in_ID') {{ number_format($total, 2) }}</h4>
                </div>
                <input wire:model="image" type="file" name="image" accept="image/png,image/gif,image/jpeg"
                    class="{{ $errors->has('image') ? 'is-invalid' : '' }} w-100" aria-describedby="image">
                @error('image')
                    <div class="invalid-feedback text-xs mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="modal-footer pb-0">
                <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Batal</button>
                <button type="submit" wire:click.prevent="uploadPayment" class="btn bg-gradient-success">Upload</button>
            </div>
        </div>
    </div>
</div>
