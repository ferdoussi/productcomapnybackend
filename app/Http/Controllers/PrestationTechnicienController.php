<?php

namespace App\Http\Controllers;

use App\Models\PrestationTechnicien;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\SendPrestation;
use App\Models\Technicien;
use App\Models\PrestationNotSend;
use App\Models\Prestation;
class PrestationTechnicienController extends Controller
{
    // Add the sendData function
    public function sendData(Request $request)
    {
        try {
            // Parse and normalize the 'date_prestation' input
            $datePrestation = \Carbon\Carbon::parse($request->input('date_prestation'))->format('Y-m-d H:i:s');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid date format'], 400);
        }
    
        // Validate the incoming request data
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
    
        // Include the normalized 'date_prestation' and set default status
        $validated['date_prestation'] = $datePrestation;
        $validated['status'] = 'en cours';
    
        // Fetch the technicien and update their 'disponible' field
        $technicien = Technicien::find($validated['user_id']);
        if (!$technicien) {
            return response()->json(['error' => 'Technicien not found'], 404);
        }
        $technicien->disponible = false;
        $technicien->save();
    
        // Create a new PrestationTechnicien record
        $prestationTechnicien = PrestationTechnicien::create($validated);
    
        // Update or create the PrestationNotSend entry
        $prestationNotSend = PrestationNotSend::updateOrCreate(
            ['vistID' => $validated['vistID']], // Match by vistID
            [
                'title' => $validated['title'],
                'prix' => $validated['prix'],
                'surface' => $validated['surface'],
                'telephone' => $validated['telephone'],
                'adress' => $validated['adress'],
                'description' => $validated['description'],
                'date_prestation' => $validated['date_prestation'],
                'status' => 'planifier', // Set the status to 'planifier'
            ]
        );
    
        // Update the Prestation table
        $prestation = Prestation::find($validated['vistID']);
        if ($prestation) {
            $prestation->status = 'planifier';
            $prestation->save();
        } else {
            return response()->json(['error' => 'Prestation not found'], 404);
        }
    
        // Return a response
        return response()->json([
            'message' => 'Data sent successfully',
            'data' => [
                'prestationTechnicien' => $prestationTechnicien,
                'prestationNotSend' => $prestationNotSend,
            ],
        ], 201);
    }
    
    
    

    public function getData($userId)
    {
        // Find all records by user_id
        $prestationTechniciens = PrestationTechnicien::where('user_id', $userId)->get();
    
        // if ($prestationTechniciens->isEmpty()) {
        //     // If no records are found, return a 404 error
        //     return response()->json([
        //         'message' => 'No records found',
        //     ], 404);
        // }
    
        // Return the data of all found records
        return response()->json([
            'data' => $prestationTechniciens,
        ], 200);
    }
    

    
}
