<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyAddress extends Model
{
    /**
     * Table used by this model
     *
     * @var string
     */
    protected $table = 'company_address';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    public function address(){
        return $this->belongsTo(Address::class);
    }
}
