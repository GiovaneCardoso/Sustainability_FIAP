<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    public function rating(){
        return $this->hasMany(CompanyRating::class);
    }

    public function categories(){
        return $this->hasMany(CompanyCategory::class);
    }
}
