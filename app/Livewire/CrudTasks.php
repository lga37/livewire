<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CrudTasks extends Component
{

    use WithPagination;
    use WithFileUploads;

    #[Rule('required|min:4|max:55')]
    public $name;

    public $img;

    function add(){
        $validated = $this->validateOnly('name');
        Task::create($validated);
        $this->getAll();
        $this->reset('name');
    }

    function del(Task $task){
        $task->delete();
    }

    #[Computed()]
    function getAll(){
        return Task::paginate(5);
    }


    public ?User $ganhador;

    function sorteio(){
        $users = User::all();
        foreach($users as $u){
            $this->stream('ganhador',$u->name);
            usleep(35000);
            #$this->reset('ganhador');
        }
        $ganhador = User::query()->inRandomOrder()->first();
        $this->ganhador = $ganhador;
        sleep(1);
        $this->js('confetti()');
    }




    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.crud-tasks');
    }
}
