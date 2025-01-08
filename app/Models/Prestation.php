<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestation extends Model
{
    use HasFactory;

  
    protected $table = 'prestation';


    protected $fillable = [
        'user_id',
        'title',
        'prix',
        'description',
        'surface',
        'date1',
        'date2',
        'date3',
        'date4',
        'adress',
        'status',
        'telephone'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
