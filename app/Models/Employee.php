<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $employment_status = [
        0 => 'NOT_STARTED',
        1 => 'ACTIVE',
        2 => 'RESIGNED',
        3 => 'RETRENCHED',        
        4 => 'TERMINATED',        
        5 => 'UNKNOWN'
    ];


    // ACCESSORS & MUTATORS -------------------------------------------------------------------------------------------------------------------
    // public function setNameSuffixAttribute($value)
    // {
    //     $this->attributes['name_suffix'] = (is_null($value)) ? '' : $value ;
    // }
}
