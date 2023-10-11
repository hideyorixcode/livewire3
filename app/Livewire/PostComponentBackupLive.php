<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;
use App\Livewire\Forms\PostForm;

class PostComponentBackupLive extends Component
{

    use WithPagination;

    public PostForm $form;

    public $postId;


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
        $this->form->save();
        session()->flash('success', 'Post created successfully.');
        $this->closeModal();
    }

    public function edit($id)
    {
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
            $this->closeModal();
        }
    }

    public function delete($id)
    {
        Post::find($id)->delete();
        session()->flash('success', 'Post deleted successfully.');
        $this->resetForm();
    }



    public function render()
    {
        return view('livewire.post-component', [
            'posts' => Post::paginate(5)
        ]);
    }
}
