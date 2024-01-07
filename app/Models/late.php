<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Carbon\Carbon;

class late extends Model
{
    use HasFactory;

    /** 
     * @property int|mixed $some_bigint_column 
     */

    //  public function getTodayLateCount()
    // {
    //     return self::whereDate('date_time_late', Carbon::today())->count();
    // }

    protected $fillable = [
        'student_id',
        'date_time_late',
        'information',
        'bukti',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function rayon(){
        return $this->belongsTo(rayon::class); 
    }
    
    public function rombel(){
        return $this->belongsTo(rombel::class);  
    }  
}
