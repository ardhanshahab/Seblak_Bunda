@extends('layouts.backend.app')
@section('content')
    @component('components.card.card-primary')
        @slot('title', __('text.trash'))
        @slot('action')
        <x-button.button-icon :title="__('button.back')" :route="route('master.category.index')" type="btn-primary" icon="fa fa-arrow-left" />
        @endslot
        @slot('body')
            {!! $dataTable->table(['class' => 'table table-striped']) !!}
        @endslot
    @endcomponent
@endsection

@push('js')
    <script>
        $('.btn-tes').on('click',function(){
            return alert('ok');
        })
    </script>
    {!! $dataTable->scripts() !!}
@endpush
