<div>

    Tasks

    <div class="flex justify-center items-center">
        <label for="name" class="bg-blue-200 h-10 p-2">Name:</label>
        <input wire:model.lazy="name" wire:keydown.enter="add" class="h-10" /><br>
        {{ $name }}
        @error('name'){{ $message }} @enderror

        <label for="img" class="bg-blue-200 h-10 p-2">Img:</label>
        <input type="file" wire:model="img" class="h-10" />

        @if($img)
            <img class="h-40 w-40 border-2" src="{{$img->temporaryUrl() }}" />
        @endif

        <span wire:loading wire:target="img">Uploading...</span>
        @error('img') ** {{ $message }} @enderror


    </div>


    @forelse ($this->getAll() as $task)
        <div class="bg-red-200 p-2 m-2 flex justify-center space-x-2">
            <span>{{ $task->id }}</span>
            <span>{{ $task->name }}</span>
            <span>{{ $task->done }}</span>

            <a href="#" class="ml-2 bg-orange-200" wire:click="del({{$task->id}})">del</a>
        </div>
    @empty
        Sem Regs
    @endforelse

        <h1 wire:click="sorteio">Sortear ganhador</h1>
        <div wire:stream="ganhador" class="bg-blue-800 p-4 text-white m-4">{{ $ganhador->name ?? '' }}</div>


    {{ $this->getAll()->links() }}


</div>
