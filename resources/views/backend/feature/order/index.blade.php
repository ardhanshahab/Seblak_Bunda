@extends('layouts.backend.app')
@section('content')
    @component('components.card.card-primary')
        @slot('title', __('text.data_order'))
        @slot('action')
        <x-button.button-icon :title="__('button.trash')" :route="route('feature.order.trash')" type="btn-danger" icon="fa fa-trash" />
        @endslot
        @slot('body')
            {!! $dataTable->table(['class' => 'table table-striped']) !!}
        @endslot
    @endcomponent
@endsection

@push('js')
    {!! $dataTable->scripts() !!}
@endpush
