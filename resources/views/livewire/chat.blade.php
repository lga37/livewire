<div>

    <div class="flex justify-center items-center space-x-2">
        <label for="ask" class="bg-blue-200 rounded p-2 text-blue-800">Ask</label>
        <input wire:model="msg" id="ask" type="text" class="border-2 border-blue-300">
        <button wire:click="ask" class="bg-blue-600 rounded p-2 text-white">ASK</button>
    </div>

    <div class="bg-yellow-200 rounded border-2 border-yellow-400">
        {{ $resp }}
    </div>

</div>
