<div class="col">
    <div class="input-group input-group-outline my-3 {{ $errors->has($id) ? 'is-invalid' : 'mb-2' }}">
        <label class="form-label" for="{{ $id }}">{{ $label }}</label>
        <input type="{{ $type }}" class="form-control" name="{{ $id }}" id="{{ $id }}">
    </div>
    @error($id)
        <div class="invalid-feedback text-xs mb-2">
            {{ $message }}
        </div>
    @enderror
</div>