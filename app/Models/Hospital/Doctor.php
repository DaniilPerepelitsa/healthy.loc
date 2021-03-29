<?php

namespace App\Models\Hospital;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'specialization'
    ];

    protected $table = 'doctors';

    public function patients(){
        return $this->belongsToMany(Patient::class, 'patient_histories')
            ->withPivot('diagnosis', 'treatment', 'created_at', 'updated_at');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
