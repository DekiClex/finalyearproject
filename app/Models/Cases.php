<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
    protected $table = 'Case';

    protected $primaryKey = 'CaseID';

    public function patients()
    {
        return $this->belongsTo(Patients::class, 'PatientID', 'PatientID');
    }
}
