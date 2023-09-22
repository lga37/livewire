<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Reactive;

class CrudUsuarios extends Component
{

    use WithPagination;
    use WithFileUploads;

    public $qtd;

    #[Rule('nullable|sometimes|max:1024')]
    public $img;


    public ?User $selected;

    public $users = [];

    // public function updatedImg($img){
    //     dd($img);
    //     $this->validateOnly('img');
    //     #$path = $img->store('uploads','public');
    //     $path = $img->storeAs('uploads','nomeee','public');

    //     #dd($img);
    // }



    #[Computed()]
    function all()
    {
        #return User::all();
        return User::paginate(10);
    }

    #[On('img-upd')]
    public function upd($id)
    {
        $this->validateOnly('img');
        #$path = $img->store('uploads','public');
        #$path = $img->storeAs('uploads','nomeee','public');

        #dd($id);
    }

    public function alert()
    {
        $this->js("alert('oiiii')");
    }

    public function del(User $u)
    {
        $u->delete();

        $this->all();
        #dd($u);
    }

    public function submit($id)
    {

        $validatedData = $this->validateOnly('img');
        $validatedData['img'] = $this->img->store('imgs', 'public');

        dd($this->img);
        #update
        session()->flash('message', 'Image successfully Uploaded.');
    }

    public function sel(User $u)
    {
        $this->selected = $u;
        #dd($u);
    }

    public function incr()
    {
        $this->qtd++;
    }

    public function decr()
    {
        $this->qtd--;
    }


    #[Layout('layouts.app')]
    public function render()
    {
        return <<<'HTML'
        <div class="font-bold text-xl">
            Heloooooooooooooo w
            Minha qtd e : {{ $qtd }}<br>
            <a wire:click="incr" href="#"> aumentar</a> -
            <a wire:click="decr" href="#"> diminuir</a> -<br>
            <hr>
            selected :
                {{ $this->selected->id??'' }}
                {{ $this->selected->name??'' }}
            <hr>

            <a wire:click="alert" href="#"> alert </a> -
            <br><br>

            @if (session()->has('message'))
            <div class="p-3 bg-green-300 text-green-800 rounded shadow-sm">
                {{ session('message') }}
            </div>
            @endif

            @if($img)
                {{$img->getFilename() }} <br>
                {{$img->temporaryUrl() }} <br>
                {{$img->getClientOriginalName() }}
                <img src="{{$img->temporaryUrl() }}" />
            @endif

            <span wire:loading wire:target="img">Uploading...</span>
            @error('img') ** {{ $message }} @enderror


            @foreach($this->all() as $u)
                <div class="bg-red-200 m-2" wire:key="$u->id">

                    <a class="bg-blue-400" href="#" wire:click="sel({{ $u->id }})">sel</a>


                    <form wire:submit="submit({{ $u->id }})" enctype="multipart/form-data">
                        <input type="file" wire:model="img" />
                        <button>send</button>
                    </form>

                    {{ $u->id }} -
                    {{ $u->name }}
                    <a class="bg-red-400" href="#" wire:click="del({{ $u->id }})">del</a>
                </div>
            @endforeach

            -- change="$dispatch('img-upd', { id: {{ $u->id }} })"

            {{ $this->all()->links() }}
        </div>
        HTML;
    }
}
