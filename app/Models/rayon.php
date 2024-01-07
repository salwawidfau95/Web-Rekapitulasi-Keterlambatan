<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rayon extends Model
{
    use HasFactory;

    protected $table = 'rayons';
    
    protected $fillable = [
        'rayon',
        'user_id',
    ];

    public function User(){
    return $this->belongsTo(User::class);
    }

    public function student()
    {
        return $this->hasMany(Student::class);
    }

    public function late()
    {
        return $this->hasMany(Late::class);
    }

}