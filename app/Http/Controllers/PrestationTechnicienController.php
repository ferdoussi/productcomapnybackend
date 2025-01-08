<?php

namespace App\Http\Controllers;

use App\Models\PrestationTechnicien;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PrestationTechnicienController extends Controller
{
    // Add the sendData function
    public function sendData(Request $request)
    {
        // Normalize the date_prestation value to ensure it is in the correct format
        $datePrestation = \Carbon\Carbon::createFromFormat('Y-m-d h:i A', $request->input('date_prestation'))->format('Y-m-d H:i:s');
    
        // Validate the incoming request data (including user_id)
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'surface' => 'required|numeric',
            'telephone' => 'required|string|max:20',
            'adress' => 'required|string|max:255',
            'description' => 'required|string',
            'date_prestation' => 'required|date_format:Y-m-d h:i A', // You can keep this validation, but the normalized date will be saved
            'userName' => 'required|string|max:255',
            'user_id' => 'required|exists:techniciens,id',
        ]);
    
        // Include the normalized date_prestation in the validated data
        $validated['date_prestation'] = $datePrestation;
    
        // Create a new PrestationTechnicien record including user_id
        $prestationTechnicien = PrestationTechnicien::create($validated);
    
        // Return a response
        return response()->json([
            'message' => 'Data sent successfully',
            'data' => $prestationTechnicien,
        ], 201);
    }

    public function getData($id)
    {
        // Find the specific record by its ID
        $prestationTechnicien = PrestationTechnicien::find($id);

        if (!$prestationTechnicien) {
            // If not found, return a 404 error
            return response()->json([
                'message' => 'Record not found',
            ], 404);
        }

        // Return the data of the found record
        return response()->json([
            // 'message' => 'Data retrieved successfully',
            'data' => $prestationTechnicien,
        ], 200);
    }
    
}
