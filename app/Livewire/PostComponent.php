<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;
use App\Livewire\Forms\PostForm;
use function Laravel\Prompts\alert;

class PostComponent extends Component
{

    use WithPagination;

    public PostForm $form;

    public $postId;

    protected $listeners = ['editPassed' => 'edit', 'deletePassed' => 'delete'];


    private function resetForm()
    {
        $this->resetValidation();
        $this->reset('form.title', 'form.body', 'form.id', 'postId');
    }

    public function closeModal()
    {

        $this->resetForm();
        $this->dispatch('closeModal');
    }

    public function create()
    {
        $this->resetForm();
    }


    public function store()
    {
        $this->validate();
        $dataStore = [
            'title' => $this->form->title,
            'body' => $this->form->body,
        ];
        Post::create($dataStore);
        session()->flash('success', 'Post created successfully.');
        $this->closeModal();
        $this->dispatch('pg:eventRefresh-table1');

//        $this->closeModal();
    }

    public function edit($id)
    {
//        $this->js('alert(' . $id . ')');
//        $this->js(alert($this->id));
        $this->resetValidation();
        $post = Post::findOrFail($id);
        $this->postId = $id;
        $this->form->id = $id;
        $this->form->title = $post->title;
        $this->form->body = $post->body;
    }

    public function update()
    {
        if ($this->postId) {
            $this->validate();
            $post = Post::findOrFail($this->postId);
            $dataUpdate = [
                'title' => $this->form->title,
                'body' => $this->form->body,
            ];

            $post->update($dataUpdate);
            session()->flash('success', 'Post updated successfully.');
//            $this->closeModal();
            $this->closeModal();
            $this->dispatch('pg:eventRefresh-table1');
        }
    }

    public function delete($id)
    {

        Post::find($id)->delete();
        session()->flash('success', 'Post deleted successfully.');
        $this->resetForm();
        $this->dispatch('pg:eventRefresh-table1');
    }


    public function render()
    {
        return view('livewire.post-powergrid', [
            'posts' => Post::paginate(5)
        ]);
    }
}
