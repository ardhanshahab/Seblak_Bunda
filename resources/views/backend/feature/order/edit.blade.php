@extends('layouts.backend.app')
@section('content')
    <div class="row">
        <div class="col-12">
            @component('components.backend.card.card-form')
                @slot('action', Route('master.outlet.update',$data['outlet']->id))
                @slot('content')

                <x-forms.input name="name" id="name" :label="__('field.outlet_name')" :value="$data['outlet']->name" :isRequired="true" />

                <x-forms.input name="address" id="address" :label="__('field.outlet_address')" :value="$data['outlet']->address" :isRequired="true" />

                <x-forms.input type="textarea" name="description" id="description" :value="$data['outlet']->description" :label="__('field.description')" :isRequired="true" />
                

                <div class="text-right">
                    <a href="{{ Route('master.outlet.index') }}" class="btn btn-secondary " href="#">{{ __('button.cancel') }}</a>
                    <button type="submit" class="btn btn-primary " href="#">{{ __('button.save') }}</button>
                </div>
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).on('keyup', '#name', function() {
            let val = $(this).val();
            let slugformat = val.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
            $('#slug').val(slugformat);
        });
    </script>
@endpush
