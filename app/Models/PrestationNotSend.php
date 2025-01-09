<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestationNotSend extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'prestation_notSend';

    // Define the primary key (optional, since Laravel uses 'id' by default)
    protected $primaryKey = 'id';

    // Define the attributes that are mass assignable
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
        'adress',
        'telephone',
        'status',
        'vistID'
    ];

    

    // Define the relationships (if any). For example, if 'user_id' is a foreign key:
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // If 'vistID' is a foreign key, you can define a relationship as well
    public function vist()
    {
        return $this->belongsTo(Vist::class, 'id');
    }
}
