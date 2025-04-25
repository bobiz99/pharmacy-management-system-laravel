<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id', 'description',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function medications()
    {
        return $this->belongsToMany(Medication::class, 'prescribed_medications')
            ->withPivot('quantity', 'instructions')
            ->withTimestamps();
    }
}
