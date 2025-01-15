<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrestationTechnicien extends Model
{
    use HasFactory;

    // Define the table name if it doesn't follow Laravel's plural naming convention
    protected $table = 'prestations_techniciens';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'id_prestation';

    // Define which columns can be mass-assigned
    protected $fillable = [
        'title',
        'prix',
        'surface',
        'telephone',
        'adress',
        'description',
        'date_prestation',
        'userName',
        'user_id', // Make sure user_id is mass-assignable
        'vistID', // Add vistID here
    ];

    /**
     * Define the relationship with the Technicien model.
     */
    public function technicien()
    {
        return $this->belongsTo(Technicien::class, 'user_id');
    }
      // العلاقة مع نموذج Prestation
    public function prestation()
    {
        return $this->belongsTo(Prestation::class, 'id'); // Assuming 'vistID' is the foreign key
    }
}
