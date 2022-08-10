<?php

namespace App\Models;

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



    // ACCESSORS ------------------------------------------------------------------------------------------------------------------
    public function getEmploymentStatusAttribute($value) {
        return (isset($this->employment_status[$value])) ? $this->employment_status[$value] : $this->employment_status[5];
    }


    // MUTATORS -------------------------------------------------------------------------------------------------------------------
    public function setNameSuffixAttribute($value)
    {
        $this->attributes['name_suffix'] = (is_null($value)) ? '' : $value ;
    }

    public function setEmploymentStatusAttribute($value)
    {
        $status = 0;

        if (is_integer($value) && isset($this->employment_status[$value])) {
            $status = $value;
        } 
        else if (is_string($value) && in_array($value, $this->employment_status)) {
            $status = array_search($value, $this->employment_status);
        }
        
        $this->attributes['employment_status'] = $status;
    }
}
