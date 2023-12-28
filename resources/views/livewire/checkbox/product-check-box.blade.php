<div class="form-check">
    <input wire:model.defer="checked" wire:click="checkChanged" class="form-check-input" type="checkbox" id="{{$product->name}}">
    <label class="form-check-label" for="{{$product->name}}">
        {{ $product->name }}
    </label>
</div>