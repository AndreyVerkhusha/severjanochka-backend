<?php

namespace App\Models;

class Product extends BaseModel {

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function comments() {
        return $this->hasMany(Comment::class );
    }

    public function ratings() {
        return $this->hasMany(ProductRating::class );
    }

    public function averageRating() {
        $avg = $this->ratings()->avg('rating') ?? 0;
        return round($avg, 1);
    }
}
