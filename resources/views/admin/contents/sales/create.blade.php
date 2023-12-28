<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-create-sales">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h5 class="modal-title">@lang('sales.modal.add')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modal-body-form" class="modal-body">
                <div class="row">
                    <div class="input-group input-group-static {{ $errors->has('invoice_id') ? 'is-invalid' : 'mb-2' }}">
                        <label for="invoiceId" class="ms-0">Invoice ID</label>
                        <select class="form-control" wire:model="invoice_id" id="invoiceId">
                            <option value="" selected>Select Invoice</option>
                            @foreach ($invoices as $item)
                                <option value="{{ $item->id }}">#{{ sprintf('%07d', $item->id) }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('invoice_id')
                        <div class="invalid-feedback text-xs mb-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer pb-0">
                <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">@lang('common.cancel')</button>
                <button type="submit" wire:click.prevent="store" class="btn bg-gradient-success">@lang('sales.button.add')</button>
            </div>
        </div>
    </div>
</div>

