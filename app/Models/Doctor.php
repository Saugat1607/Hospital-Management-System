<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable{
    protected $fillable = ['name', 'email', 'password', 'category_id'];
    
    protected $hidden = ['password'];

    public function category(){
        return $this->belongsTo(Category::class);
    
    }
}
