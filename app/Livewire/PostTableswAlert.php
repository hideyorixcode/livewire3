<?php

namespace App\Livewire;

use App\Livewire\Forms\PostForm;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use function Laravel\Prompts\alert;

final class PostTableswAlert extends PowerGridComponent
{
    use WithExport;

    public PostForm $form;


    public string $sortField = 'id';

    public string $sortDirection = 'desc';

    public function setUp(): array
    {
        $this->showCheckBox();
//        public PostForm $form;

        return [

            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()
                ->showSearchInput()
                ->showToggleColumns(),
            Footer::make()
                ->showPerPage(25)
                ->showRecordCount(),
//            Responsive::make()
        ];
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
            ->addColumn('image')
            /** Example of custom column using a closure **/
            ->addColumn('image_lower', fn(Post $model) => strtolower(e($model->image)))
            ->addColumn('title')
            ->addColumn('body')
            ->addColumn('created_at_formatted', fn(Post $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {

        return [
            Column::action('Action'),
            Column::make('No.', '')
                ->index(),
            Column::make('Id', 'id')
                ->hidden(true, false),
            Column::make('Image', 'image')
                ->hidden(true, false),
            Column::make('Title', 'title')
                ->sortable()
                ->searchable(),

            Column::make('Content', 'body')
                ->sortable()
                ->searchable(),

//            Column::make('Created at', 'created_at_formatted', 'created_at')
//                ->sortable(),


        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('image')->operators(['contains']),
            Filter::inputText('title')->operators(['contains']),
            Filter::datetimepicker('created_at'),
        ];
    }


    #[\Livewire\Attributes\On('edit_on_row')]
    public function edit_on_row($rowId): void
    {
        $this->js('alert(' . $rowId . ')');

//        alert($rowId);


//        $post = Post::findOrFail($rowId);
//        $this->form->id = $rowId;
//        $this->form->title = $post->title;
//        $this->form->body = $post->body;
//        $this->dispatch('edit', $rowId);
//        $this->updateMode = true;
//        $row = Post::where('id', $rowId)->first();
//        $this->id_post = $id;
//        $this->title = $row->title;
//        $this->image = $row->image;
//        $this->content = $row->content;
//        (new Transaction())->editTrx($rowId);
//
//        $this->js('edit(' . $rowId . ')');
//        $this->dispatch('edit', $rowId);
//        $this->updateMode = true;
//        $row = Post::where('id', $rowId)->first();
//        $transaction = new Transaction();
//        $transaction->updateMode = true;
//        $transaction->title = $row->title;

//        $this->id_post = $rowId;
//        $this->title = $row->title;
//        $this->image = $row->image;
//        $this->content = $row->content;

    }

    #[\Livewire\Attributes\On('editx')]
    public function editx($rowId): void
    {
        $this->dispatch('edit(' . $rowId . ')');
//        $this->js('alert(' . $rowId . ')');
//        $post = Post::findOrFail($rowId);
//        $this->form->title = $post->title;
    }

    public function editOnRow($rowId)
    {
        $this->dispatch('editPassed', $rowId);
    }

    public function confirmDelete($rowId)
    {

        \Livewire\withSweetAlert('Are you sure?', 'This action cannot be undone', function() {
            // Call the Livewire component function upon confirmation
            $this->deleteUser();
        });
//        $this->dispatch('swal:confirm', [
//
//            'type' => 'warning',
//
//            'message' => 'Are you sure?',
//
//            'text' => 'If deleted, you will not be able to recover this imaginary file!',
//
//            'rowId' => $rowId,
//
//        ]);
    }

    public function deleteOnRow($rowId)
    {
        $this->dispatch('deletePassed', $rowId);
    }

    public function actions(\App\Models\Post $row): array
    {
        return [
            Button::add('edit')
                ->render(function (Post $row) {
                    return Blade::render(<<<HTML
                         <button data-bs-toggle="modal" data-bs-target="#formModal" class="btn btn-primary btn-sm" wire:click="editOnRow('$row->id')">Edit</button>
                         HTML
                    );
                }),

            Button::add('delete')
                ->render(function (Post $row) {
                    return Blade::render(<<<HTML
                                         <button class="btn btn-danger btn-sm" wire:click="confirmDelete('$row->id')">Delete</button>
                                         HTML
                    );
                }),


        ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */


}
