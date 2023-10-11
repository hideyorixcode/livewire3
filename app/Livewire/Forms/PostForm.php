<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use Livewire\Attributes\Rule;
use Livewire\Form;

class PostForm extends Form
{

    public $id;

    #[Rule('required|min:3')]
    public $title;

    #[Rule('required|min:3')]
    public $body;


}
