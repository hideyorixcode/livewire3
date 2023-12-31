<div>
    @if (data_get($setUp, "header.toggleColumns"))
        <div class="btn-group btn-group-sm">
            <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                {{--                                <x-livewire-powergrid::icons.eye-off height="20" /> --}}
                <i class="fas fa-fw fa-eye-slash me-2" style="font-size: 20px; width: 20px;"></i>
            </button>
            <ul class="dropdown-menu">
                @foreach ($columns as $column)
                    @if (!$column->forceHidden)
                        <li wire:click="$dispatch('pg:toggleColumn-{{ $tableName }}', { field: '{{ $column->field }}'})"
                            wire:key="toggle-column-{{ $column->field }}">
                            <a class="dropdown-item" href="#">
                                @if ($column->hidden === false)
                                    <i class="fas fa-fw fa-eye me-2" style="font-size: 20px; width: 20px;"></i>
                                    {{--                                    <x-livewire-powergrid::icons.eye width="20"/> --}}
                                @else
                                    <i class="fas fa-fw fa-eye-slash me-2" style="font-size: 20px; width: 20px;"></i>
                                    {{--                                    <x-livewire-powergrid::icons.eye-off width="20"/> --}}
                                @endif
                                {!! $column->title !!}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endif
</div>
