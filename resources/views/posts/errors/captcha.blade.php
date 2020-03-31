<div class="form-group row">
    <label for="g-recaptcha" class="col-md-4 col-form-label text-md-right">{{ __('Капча') }}</label>
    <div class="col-md-6">
        @error('g-recaptcha-response')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>{{$message}}</strong>
        </div>
        @enderror
        {!! htmlFormSnippet() !!}

    </div>
</div>
