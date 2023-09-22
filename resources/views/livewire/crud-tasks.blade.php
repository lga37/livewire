<div>

    Tasks

    <div class="flex justify-center">
        <input wire:model="name" wire:keydown.enter="add" />

    </div>

    @forelse ($this->getAll() as $task)
        {{ $task->name }}<br>
    @empty
        vazio
    @endforelse

    

</div>
