@extends('layouts.backend.app')
@section('content')
    @component('components.card.card-primary')
        @slot('title', __('text.trash'))
        @slot('action')
        <x-button.button-icon :title="__('button.back')" :route="route('master.outlet.index')" type="btn-primary" icon="fa fa-arrow-left" />
        @endslot
        @slot('body')
            {!! $dataTable->table(['class' => 'table table-striped']) !!}
        @endslot
    @endcomponent
@endsection

@push('js')
    {!! $dataTable->scripts() !!}
@endpush
