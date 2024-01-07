<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;

    protected $fillable = [
        'nis',
        'name',
        'rombel_id',
        'rayon_id',
    ];

    public function late()
    {
        return $this->hasMany(late::class, 'student_id');
    }

    public function rayon(){
    return $this->belongsTo(rayon::class); 
    }

    public function rombel(){
    return $this->belongsTo(rombel::class);  
    }  
    
}
