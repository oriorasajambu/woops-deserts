<div wire:ignore.self class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="modal-cancel-order">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content bg-light">
            <div class="modal-header">
                <h5 class="modal-title">@lang('order.modal.cancel')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modal-body-form" class="modal-body">
                <h6>@lang('common.cancel_confirmation_title')</h6>
                <p>@lang('common.cancel_confirmation_desc')</p>
            </div>
            <div class="modal-footer pb-0">
                <button type="submit" wire:click.prevent="cancel" class="btn bg-gradient-danger">@lang('order.button.cancel')</button>
            </div>
        </div>
    </div>
</div>
