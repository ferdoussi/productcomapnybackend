<?php

namespace App\Http\Controllers;

use App\Models\Technicien;
use Illuminate\Http\Request;

class TechnicienController extends Controller
{
  
    public function getAllTechniciens()
    {
        $techniciens = Technicien::all(); // Retrieve all records from the 'techniciens' table
        return response()->json($techniciens); // Return the results as JSON
    }
}
