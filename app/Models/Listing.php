<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'user_id', 'category_id', 'company', 'email', 'location', 'website', 'tags', 'description', 'logo'];//'category_id', 

    public function scopeFilter($query, array $filters){
        // $tag = $filters['tag'];
        // dd($filters);
        if($filters['tag']){
            $query->where('tags', 'like', "%{$filters['tag']}%");
        }
        if($filters['search']){
            $query->where('tags', 'like', "%{$filters['search']}%")
                ->orWhere('title', 'like', "%{$filters['search']}%")
                ->orwhere('description', 'like', "%{$filters['search']}%");
        }
    }


    // Database relationships
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function tags_list(){
        return $this->belongsToMany(Tag::class);
    }
}
