<div id="posts" class=" px-3 lg:px-7 py-6">
    <div class="flex justify-between items-center border-b border-gray-100">
        <div class="text-gray-600">

            @if ($this->activeCategory || $search)
                <button
                wire:click="clearFilters()"
                class="gray-500 text-xl mr-3">X</button>
            @endif

            @if ($this->activeCategory)

                <x-badge wire:navigate href="{{ route('posts.index', ['category' => $this->activeCategory->title]) }}"
                    {{-- href="{{ request()->fullUrlWithQuery() }}" --}} :textColor="$this->activeCategory->text_color"
                    :bgColor="$this->activeCategory->bg_color">{{ $this->activeCategory->title }}</x-badge>
            @endif
            @if ($search)
                Containing: <span class="font-semibold"> {{ $search }} </span>
            @endif

        </div>
        <div id="filter-selector" class="flex items-center space-x-4 font-light ">
            <button wire:click="setSort('desc')"
                class="{{ $sort == 'desc' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500' }} py-4">Latest</button>
            <button wire:click="setSort('asc')"
                class="{{ $sort == 'asc' ? 'text-gray-900 border-b border-gray-700' : 'text-gray-500' }} py-4">Oldest</button>


        </div>
    </div>
    <div class="py-4">
        @foreach ($this->posts as $post)
            <x-posts.post-item :post="$post" />
        @endforeach
    </div>

    <div class="my-3">
        {{ $this->posts->onEachSide(1)->links() }}
    </div>
</div>
