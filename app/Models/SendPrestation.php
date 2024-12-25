<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SendPrestation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'prix',
        'description',
        'surface',
        'total',
        'date1',
        'date2',
        'date3',
        'date4',
        'address',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
