<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    protected $table = 'Patients';

    protected $primaryKey = 'PatientID';

    public function cases()
    {
        return $this->hasMany(Cases::class);
    }
}
