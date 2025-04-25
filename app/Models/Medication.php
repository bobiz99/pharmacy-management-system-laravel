<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'description'];

    public function prescriptions()
    {
        return $this->belongsToMany(Prescription::class, 'prescribed_medications')
            ->withPivot('quantity', 'instructions')
            ->withTimestamps();
    }
}
