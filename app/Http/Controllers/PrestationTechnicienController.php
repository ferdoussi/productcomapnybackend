<?php

namespace App\Http\Controllers;

use App\Models\PrestationTechnicien;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\SendPrestation;
use App\Models\Technicien;
class PrestationTechnicienController extends Controller
{
    // Add the sendData function
    public function sendData(Request $request)
    {
         
      try {
        $datePrestation = \Carbon\Carbon::parse($request->input('date_prestation'))->format('Y-m-d H:i:s');
    } catch (\Exception $e) {
        return response()->json(['error' => 'Invalid date format'], 400);
    }
    
        // Validate the incoming request data (including vistID)
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'surface' => 'required|numeric',
            'telephone' => 'required|string|max:20',
            'adress' => 'required|string|max:255',
            'description' => 'required|string',
            'date_prestation' => 'required|date_format:Y-m-d H:i:s',
            'userName' => 'required|string|max:255',
            'user_id' => 'required|exists:techniciens,id',
            'vistID' => 'nullable|exists:prestation,id', // Ensure vistID references the prestation table
        ]);
    
        // Include the normalized date_prestation in the validated data
        $validated['date_prestation'] = $datePrestation;
    
        // Add the status of 'en cours' to the validated data
        $validated['status'] = 'en cours';  // Set the status to 'en cours'
    
        // Fetch the technicien and update their 'disponible' field if needed
        $technicien = Technicien::find($validated['user_id']);
        if ($technicien) {
            $technicien->disponible = false;
            $technicien->save();
        } else {
            return response()->json(['error' => 'Technicien not found'], 404);
        }
    
        // Create a new PrestationTechnicien record including vistID
        $prestationTechnicien = PrestationTechnicien::create($validated);
    
        // Update PrestationNotSend table
        $prestationNotSend = SendPrestation::where('vistID', $validated['vistID'])->first();
        if ($prestationNotSend) {
            $prestationNotSend->status = 'planifier';  // Change the status to 'planifier'
            $prestationNotSend->save();
        } else {
            // Handle case where PrestationNotSend is not found
            return response()->json(['error' => 'PrestationNotSend not found'], 404);
        }
    
        // Return a response
        return response()->json([
            'message' => 'Data sent successfully',
            'data' => $prestationTechnicien,
        ], 201);
    }
    
    

    public function getData($userId)
    {
        // Find all records by user_id
        $prestationTechniciens = PrestationTechnicien::where('user_id', $userId)->get();
    
        if ($prestationTechniciens->isEmpty()) {
            // If no records are found, return a 404 error
            return response()->json([
                'message' => 'No records found',
            ], 404);
        }
    
        // Return the data of all found records
        return response()->json([
            'data' => $prestationTechniciens,
        ], 200);
    }
    

    
}
