<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'tags',
        'company',
        'location',
        'email',
        'website',
        'description',
    ];

    public function scopeFilterTag($query,array $filters){

        // if($filters['tag'] ?? false){
            if($filters['tag']){
            $query->where('tags','like','%'.request('tag').'%');
        }
    }
}
