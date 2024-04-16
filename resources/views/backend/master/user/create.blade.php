@extends('layouts.backend.app')
@section('content')
    <div class="row">
        <div class="col-12">
            @component('components.backend.card.card-form')
                @slot('action', Route('master.product.store'))
                @slot('content')
                    <x-forms.select name="role" id="role" :label="__('field.category_name')">
                            <option value="admin">Admin</option>
                            <option value="cashier">Kasir</option>
                    </x-forms.select>
                    <x-forms.input name="name" id="name" :label="__('field.product_name')" :isRequired="true" />
                    <x-forms.input type="number" name="price" id="price" :label="__('field.price')" :isRequired="true" />
                    <x-forms.input type="textarea" name="description" id="description" :label="__('field.description')" :isRequired="true" />
                    
                    <div class="form-group">
                        <label class="">{{ __('field.image') }}</label>
                        <div class="input-images-1 pt-2"></div>
                    </div>
                    <div class="text-right">
                        <a href="{{ Route('master.outlet.index') }}" class="btn btn-secondary " href="#">{{ __('button.cancel') }}</a>
                        <button type="submit" class="btn btn-primary " href="#">{{ __('button.save') }}</button>
                    </div>

                @endslot
            @endcomponent
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('imageuploader/imageuploader.css') }}">
@endpush
@push('js')
    <script src="{{ asset('imageuploader/imageuploader.js') }}"></script>
    <script>
        $('.input-images-1').imageUploader();
    </script>
@endpush