<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @mixin \Eloquent
 */
class User extends Authenticatable implements JWTSubject {
    use HasFactory,  SoftDeletes;

    public $guarded = [];

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    public function favorites() {
        return $this->belongsToMany(Product::class, 'favorites');
    }
}
