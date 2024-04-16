@extends('layouts.backend.app')
@section('content')
    @component('components.card.card-primary')
        @slot('title', __('text.data_category'))
        @slot('action')
        <x-button.button-icon :title="__('button.trash')" :route="route('master.category.trash')" type="btn-danger" icon="fa fa-trash" />
        <x-button.button-icon :title="__('button.add')" :route="route('master.category.create')" type="btn-primary" icon="fa fa-plus" />
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
