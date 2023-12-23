<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $label }}"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form id="uploadImageModalForm" method="POST" action="{{ $route }}" class="modal-content bg-light"
            enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $label }}">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modal-body-form" class="modal-body">
                <input type="file" name="files" accept="image/png,image/gif,image/jpeg"
                    class="{{ $errors->has('files') ? 'is-invalid' : '' }} w-100" aria-describedby="files">
                @error('files')
                    <div class="invalid-feedback text-xs mt-2">
                        {{ $message }}
                    </div>
                @enderror
                <div class="d-flex flex-row mt-3">
                    @if ($watermark === 'true')
                        <div class="form-check ps-0">
                            <input id="watermark" class="form-check-input" type="checkbox" checked name="watermark">
                            <label class="custom-control-label tooltips" for="watermark" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-container="body" data-animation="true"
                                data-bs-trigger="hover" title="Add Watermark Bottom Right Corner">Watermark</label>
                        </div>
                    @endif
                    @if ($compress === 'true')
                        <div class="form-check">
                            <input id="compress" class="form-check-input" type="checkbox" checked name="compress">
                            <label class="custom-control-label tooltips" for="compress" data-bs-toggle="tooltip"
                                data-bs-placement="top" data-container="body" data-animation="true"
                                data-bs-trigger="hover"
                                title="Compress Image to width 300 in respect of Aspect Ratio">Compress</label>
                        </div>
                    @endif
                </div>
                @if ($alt === 'true')
                    <div class="input-group input-group-static {{ $errors->has('alt') ? 'is-invalid' : 'mb-2' }}">
                        <label>@lang('product.table.alt')</label>
                        <input type="text" class="form-control" name="alt" value="{{ old('alt') }}"
                            placeholder="Woops Dessert Bar">
                    </div>
                    @error('alt')
                        <div class="invalid-feedback text-xs mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                @endif
            </div>
            <div id="modal-body-loading" style="display: none" class="modal-body">
                <div id="progress-bar-horizontal" style="display: none" class="progress-wrapper">
                    <div class="progress-info">
                        <div class="progress-percentage">
                            <span class="text-sm font-weight-bold">0%</span>
                        </div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100" style="width: 0%;"></div>
                    </div>
                </div>
                <div id="spinner-image-processing"
                    class="d-flex flex-row justify-content-center align-items-center gap-3">
                    <div class="spinner-border" role="status">
                        <span class="sr-only"></span>
                    </div>
                    <span>Upload Finish, Please Wait for Image Processing...</span>
                </div>
            </div>
            <div class="modal-footer pb-0">
                <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Cancel</button>
                <button id="btn-upload" type="submit" class="btn btn-outline-success">Upload</button>
            </div>
        </form>
    </div>
</div>
