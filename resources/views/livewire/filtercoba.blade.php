@if ($is_open_filter)
    <div class="mt-2">
        <div class="row">
            <div class="col-md-4">

                <input wire:key="input-title" data-id="title" wire:model.live.debounce.600ms="filters.input_text.title"
                    type="text" class="col-12 col-sm-8 form-control form-control-sm shadow-none"
                    wire:input.debounce.700ms="filterInputText('title', $event.target.value, 'Judul')"
                    placeholder="cari judul...">

            </div>

            <div class="col-md-4">

                <input wire:key="input-datetime" data-id="datetime"
                    wire:model.live.debounce.600ms="filters.input_text.created_at" type="datetime-local"
                    class="col-12 col-sm-8 form-control form-control-sm shadow-none"
                    wire:input.debounce.700ms="filterdate-picker('created_at', $event.target.value, 'Time')"
                    placeholder="">

            </div>
        </div>


    </div>
@endif
