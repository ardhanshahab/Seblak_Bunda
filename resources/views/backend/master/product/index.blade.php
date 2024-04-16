@extends('layouts.backend.app')
@section('content')
    @component('components.card.card-primary')
        @slot('title', __('Data Produk'))
        @slot('action')
        <x-button.button-icon :title="__('button.trash')" :route="route('master.product.trash')" type="btn-danger" icon="fa fa-trash" />
        <x-button.button-icon :title="__('button.add')" :route="route('master.product.create')" type="btn-primary" icon="fa fa-plus" />
        @endslot
        @slot('body')
            {!! $dataTable->table(['class' => 'table table-striped']) !!}
        @endslot
    @endcomponent
@endsection

@push('js')
    {!! $dataTable->scripts() !!}
@endpush
