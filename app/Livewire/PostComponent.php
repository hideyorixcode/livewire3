<?php

namespace App\Livewire;

use App\Models\Post;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;
use App\Livewire\Forms\PostForm;
use function Laravel\Prompts\alert;

class PostComponent extends Component
{

    use WithPagination;
    use LivewireAlert;

    public PostForm $form;

    public $idPostdel;

//    public $loading = false;

    public $postId;

    protected $listeners = ['editPassed' => 'edit', 'deletePassed' => 'delete', 'confirmDelete', 'cancelDelete'];


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
//        $this->loading = true;
        $this->resetForm();
//        $this->loading = false;
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
//        $this->loading = true;
        $this->resetValidation();
        $post = Post::findOrFail($id);
        $this->postId = $id;
        $this->form->id = $id;
        $this->form->title = $post->title;
        $this->form->body = $post->body;
//        $this->loading = false;
    }

    public function update()
    {
        if ($this->postId) {
//            $this->loading = true;
            $this->validate();
            $post = Post::findOrFail($this->postId);
            $dataUpdate = [
                'title' => $this->form->title,
                'body' => $this->form->body,
            ];

            $post->update($dataUpdate);
//            $this->loading = false;
            session()->flash('success', 'Post updated successfully.');
//            $this->closeModal();
            $this->closeModal();
            $this->dispatch('pg:eventRefresh-table1');
        }
    }

    public function delete($id)
    {
        $this->confirm('Are you sure?', [
            'text' => 'You are about to delete something',
            'onConfirmed' => 'confirmDelete',
            'onCancelled' => 'cancelDelete',
        ]);

        $this->idPostdel = $id;

    }

    public function confirmDelete()
    {
        if ($this->idPostdel) {
            $dataPost = Post::findOrFail($this->idPostdel);
            if ($dataPost) {
                $dataPost->delete();
                session()->flash('success', 'Post deleted successfully.');
                $this->resetForm();
                $this->dispatch('pg:eventRefresh-table1');
                $this->alert('success', 'Customer has been deleted..!');
            }

        }
    }

    public function cancelDelete()
    {
        if ($this->idPostdel) {
            $this->reset('idPostdel');
        }
    }


    public function render()
    {
        return view('livewire.post-powergrid', [
//            'posts' => Post::paginate(5),
            'pageTitle' => 'Post'
        ]);
    }
}
