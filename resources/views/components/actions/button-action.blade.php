<x-button.dropdown-button :title="__('field.action')">
    @foreach ($data['action'] as $item)
        @if ($query->deleted_at != null)
            @if ($item['title'] == 'Restore' || $item['title'] == 'Pulihkan')
                <a class="dropdown-item has-icon" href="{{ $item['route'] }}"><i class="{{ $item['icon'] }}"></i>
                    {{ $item['title'] }}</a>
            @endif
            @if ($item['title'] == 'Delete Permanently' || $item['title'] == 'Hapus Permanen')
            <a class="dropdown-item has-icon" href="javascript:;" onclick="hapus(`{{ $item['route'] }}`)"><i class="{{ $item['icon'] }}"></i>
                {{ $item['title'] }}</a>
            @endif
        @else
                @if ($item['title'] == 'Delete' || $item['title'] == 'Hapus')
                    <a class="dropdown-item has-icon" href="javascript:;" onclick="hapus(`{{ $item['route'] }}`)"><i
                            class="{{ $item['icon'] }}"></i>
                        {{ $item['title'] }}</a>
                @elseif($item['title'] != 'Pulihkan' && $item['title'] != 'Restore' && $item['title'] != 'Delete Permanently' && $item['title'] != 'Hapus Permanen')
                    <a class="dropdown-item has-icon" href="{{ $item['route'] }}"><i class="{{ $item['icon'] }}"></i>
                        {{ $item['title'] }}</a>
                @endif
        @endif
    @endforeach
</x-button.dropdown-button>
