<?php

namespace App\Http\Controllers;

use App\Models\PrestationNotSend;
use Illuminate\Http\Request;
use Carbon\Carbon;  // Import Carbon

class PrestationNotSendController extends Controller
{
    /**
     * Store a newly created prestation_notSend in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'description' => 'required|string',
            'surface' => 'required|numeric',
            'total' => 'required|numeric',
            'date1' => 'required|date_format:Y-m-d h:i A', // Ensure correct input format
            'date2' => 'required|date_format:Y-m-d h:i A',
            'date3' => 'required|date_format:Y-m-d h:i A',
            'date4' => 'required|date_format:Y-m-d h:i A',
            'adress' => 'required|string',
            'telephone' => 'required|string',
            'status' => 'required|string',
            'vistID' => 'required|numeric',
        ]);

        // Convert the date fields to the correct format using Carbon
        $validated['date1'] = Carbon::createFromFormat('Y-m-d h:i A', $validated['date1'])->format('Y-m-d H:i:s');
        $validated['date2'] = Carbon::createFromFormat('Y-m-d h:i A', $validated['date2'])->format('Y-m-d H:i:s');
        $validated['date3'] = Carbon::createFromFormat('Y-m-d h:i A', $validated['date3'])->format('Y-m-d H:i:s');
        $validated['date4'] = Carbon::createFromFormat('Y-m-d h:i A', $validated['date4'])->format('Y-m-d H:i:s');

        // Create a new PrestationNotSend record in the database
        $prestationNotSend = PrestationNotSend::create([
            'user_id' => $validated['user_id'],
            'title' => $validated['title'],
            'prix' => $validated['prix'],
            'description' => $validated['description'],
            'surface' => $validated['surface'],
            'total' => $validated['total'],
            'date1' => $validated['date1'], // Save as valid datetime format
            'date2' => $validated['date2'], // Save as valid datetime format
            'date3' => $validated['date3'], // Save as valid datetime format
            'date4' => $validated['date4'], // Save as valid datetime format
            'adress' => $validated['adress'],
            'telephone' => $validated['telephone'],
            'status' => $validated['status'],
            'vistID' => $validated['vistID'],
        ]);

        // Return a success response with the created data
        return response()->json([
            'message' => 'PrestationNotSend created successfully',
            'data' => $prestationNotSend
        ], 201); // 201 status code indicates resource creation
    }
    public function show($user_id)
    {
        // Find the prestations by user_id
        $prestation = PrestationNotSend::where('user_id', $user_id)->get();
        
        // Check if the collection is empty
        if ($prestation->isEmpty()) {
            return response()->json(['message' => 'Prestation not found'], 404);
        }
        
        // Return the found prestation(s)
        return response()->json($prestation, 200);
    }
    

}
