<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyRating extends Model
{
    /**
     * Table used by this model
     *
     * @var string
     */
    protected $table = 'company_rating';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];
}
