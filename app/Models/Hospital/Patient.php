<?php

namespace App\Models\Hospital;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id'
    ];

    protected $table = 'patients';

    public function doctors(){
        return $this->belongsToMany(Doctor::class, 'patient_doctors')
            ->withPivot(['id','appointment_time', 'created_at', 'updated_at']);
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
