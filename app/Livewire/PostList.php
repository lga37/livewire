<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination;

    #[Url()]
    public $sort = 'desc';

    #[Url()]
    public $search='';

    #[Url()]
    public $category='';

    public function setSort($sort){
        $this->sort = $sort == 'desc' ? 'desc' : 'asc';
        $this->search = '';
        #$this->resetPage();
    }

    #[On('search')]
    public function updateSearch($search){
        $this->search = $search;
        $this->resetPage();
    }

    #[Computed()]
    public function posts(){
        return Post::published()->orderBy('published_at',$this->sort)
        ->when(Category::where('slug',$this->category)->first(),function($q){
            $q->withCategory($this->category);
        })
        ->where('title', 'like', "%{$this->search}%")
        ->paginate(3);
    }

    #[Computed()]
    public function activeCategory(){
        return Category::where('slug',$this->category)->first();
    }


    public function clearFilters(){
        $this->reset('search','category');
        $this->resetPage();
    }


    public function render()
    {
        return view('livewire.post-list');
    }
}
