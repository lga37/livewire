<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'published_at' => 'datetime',

    ];


    public function scopePublished($q){
        $q->where('published_at','<=',Carbon::now());
    }

    public function scopeFeatured($q){
        $q->where('featured',true);
    }

    public function scopeWithCategory($q, string $category){
        $q->whereHas('categories',function($q) use ($category){
            $q->where('slug',$category);
        });
    }

    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    // public function authors(){
    //     return $this->belongsToMany(User::class,'user_id');
    // }

    // public function category(){
    //     return $this->belongsTo(Category::class);
    // }




    public function getReadingTime(){
        $mins = round(str_word_count($this->body) / 250);
        return $mins < 1? 1 : $mins;
    }

    public function getExcerpt(){
        return Str::limit(strip_tags($this->body));
    }

    public function getThumbnailImage(){
        $isUrl = str_contains($this->image,'http');
        return $isUrl? $this->image : Storage::disk('public')->url($this->image);
    }

    public function likes(){
        return $this->belongsToMany(User::class,'post_like')->withTimestamps();
    }

}
