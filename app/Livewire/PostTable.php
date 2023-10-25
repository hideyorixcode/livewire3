<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Responsive;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class PostTable extends PowerGridComponent
{
    use WithExport;

    use LivewireAlert;

    public $is_open_filter = false;

    public string $sortField = 'id';

    public string $sortDirection = 'desc';

    public function setUp(): array
    {
        $this->showCheckBox();
        // $this->persist(['columns', 'filters']);

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()
                ->showSearchInput()
                ->showToggleColumns()
                ->includeViewOnBottom('livewire.filtercoba'),
            Footer::make()
                ->showPerPage(25)
                ->showRecordCount(),
            // Responsive::make(),
        ];
    }

    public function header(): array
    {
        if (count($this->checkboxValues) != 0) {
            return [
                Button::add('bulk-delete')
                    ->slot('<i class="fas fa-trash fa-fw"></i> Hapus')
                    ->class('btn btn-sm btn-danger')
                    ->dispatch('bulkDelete', []),
            ];
        } else {
            return [];
        }
    }

    protected function getListeners()
    {
        return array_merge(
            parent::getListeners(), [
            'eventX',
            'eventY',
            'bulkDelete',
        ]);
    }

    public function bulkDelete(): void
    {
        if (count($this->checkboxValues) == 0) {
            $this->alert('warning', 'You must select at least one item!');

            return;
        }

        $ids = implode(', ', $this->checkboxValues);
        $this->alert('info', 'You have selected IDs: '.$ids);
    }

    public function datasource(): Builder
    {
        return Post::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            // ->addColumn('image')
            // ->addColumn('image_lower', fn (Post $model) => strtolower(e($model->image)))
            ->addColumn('title', fn ($dish) => $dish->title)
            ->addColumn('body')
            ->addColumn('created_at_formatted', fn (Post $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::action('Action')
                ->visibleInExport(false),
            Column::make('No.', 'id')
                ->index()
                ->visibleInExport(false),
            Column::make('Id', 'id')
                ->hidden(true, false)
                ->visibleInExport(false),
            Column::make('Image', 'image')
                ->hidden(true, false),
            Column::make('Title', 'title')
                ->sortable()
                ->searchable()
                ->visibleInExport(true),
            Column::make('Content', 'body')
                ->sortable()
                ->searchable()
                ->visibleInExport(true),

//            Column::make('Created at', 'created_at_formatted', 'created_at')
//                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [
            // Filter::inputText('image')->operators(['contains']),
            Filter::inputText('title')->operators(['contains']),
            Filter::datetimepicker('created_at'),
        ];
    }

    public function toggleFilterscustom()
    {
        $this->is_open_filter = !$this->is_open_filter;
    }

    public function editOnRow($rowId)
    {
        $this->dispatch('editPassed', $rowId);
    }

    public function deleteOnRow($rowId)
    {
        $this->dispatch('deletePassed', $rowId);
    }

    public function actions(): array
    {
        return [
            Button::add('actions')
            ->render(function (Post $row) {
                $btnEdit = '<button data-bs-toggle="modal" data-bs-target="#formModal" class="btn btn-success btn-sm" wire:click="editOnRow('.$row->id.')">Ubah</button>';
                $btnDelete = '<button class="btn btn-danger btn-sm" wire:click="deleteOnRow('.$row->id.')">Hapus</button>';
                $btnActions = '
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">
                '.$btnEdit.'
                '.$btnDelete.'
                </div>
                ';

                return $btnActions;
            }),
        ];
    }
}
