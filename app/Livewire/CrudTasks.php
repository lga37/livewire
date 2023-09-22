<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

class CrudTasks extends Component
{

    #[Rule('required|min:2|max:55')]
    public $name;

    public $img;

    function add(){
        $validated = $this->validateOnly('name');
        Task::create($validated);
        $this->getAll();
    }

    #[Computed()]
    function getAll(){
        return Task::all()->reverse();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.crud-tasks');
    }
}
