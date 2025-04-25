<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescribedMedication extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_id', 'medication_id', 'quantity', 'instructions',
    ];

    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }

    public function medication()
    {
        return $this->belongsTo(Medication::class);
    }
}
