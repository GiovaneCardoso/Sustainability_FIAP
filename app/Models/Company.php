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

    protected $appends = ['total_visitants', 'total_ratings'];

    public function rating(){
        return $this->hasMany(CompanyRating::class);
    }

    public function categories(){
        return $this->hasMany(CompanyCategory::class);
    }

    public function company_addresses(){
        return $this->hasMany(CompanyAddress::class);
    }

    public function visitants(){
        return $this->hasMany(CompanyVisitant::class);
    }

    public function getTotalVisitantsAttribute(){
        return $this->visitants()->count();
    }
    public function getTotalRatingsAttribute(){
        return $this->rating()->count();
    }
}
