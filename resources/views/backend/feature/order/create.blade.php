@extends('layouts.backend.app')
@section('content')
    <div class="row">
        <div class="col-12">
            @component('components.backend.card.card-form')
                @slot('action', Route('master.outlet.store'))
                @slot('content')

                    <x-forms.input name="name" id="name" :label="__('field.outlet_name')" :isRequired="true" />

                    <x-forms.input name="address" id="address" :label="__('field.outlet_address')" :isRequired="true" />

                    <x-forms.input type="textarea" name="description" id="description" :label="__('field.description')" :isRequired="true" />
                    

                    <div class="text-right">
                        <a href="{{ Route('master.outlet.index') }}" class="btn btn-secondary " href="#">{{ __('button.cancel') }}</a>
                        <button type="submit" class="btn btn-primary " href="#">{{ __('button.save') }}</button>
                    </div>

                @endslot
            @endcomponent
        </div>
    </div>
@endsection
