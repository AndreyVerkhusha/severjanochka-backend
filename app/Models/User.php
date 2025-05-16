<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin \Eloquent
 */
class User extends Authenticatable implements JWTSubject {
    use HasFactory, SoftDeletes;

    public $guarded = [];

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    public function favorites(): BelongsToMany {
        return $this->belongsToMany(Product::class, 'favorites');
    }

    public function cartItems(): HasMany {
        return $this->hasMany(CartItem::class);
    }

    public function comments(): HasMany {
        return $this->hasMany(Comment::class);
    }

}
