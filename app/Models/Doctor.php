<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialization_id',
        'department_id'
    ];

    protected $with = ['user','department', 'specialization'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function specialization() {
        return $this->belongsTo(Specialization::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
