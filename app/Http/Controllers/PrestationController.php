<?php

namespace App\Http\Controllers;

use App\Models\Prestation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class PrestationController extends Controller
{
  
    public function index()
    {
        return response()->json(Prestation::all(), 200);
    }

  

    public function store(Request $request)
{
    // Log the incoming request data
    Log::info('Incoming request data:', $request->all());

    // Validate the incoming data
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'title' => 'required|string|max:255',
        'prix' => 'required|numeric',
        'description' => 'nullable|string',
        'surface' => 'required|integer',
        'date1' => 'required|date_format:Y-m-d h:iA', // 12-hour format (AM/PM)
        'date2' => 'nullable|date_format:Y-m-d h:iA',
        'date3' => 'nullable|date_format:Y-m-d h:iA',
        'date4' => 'nullable|date_format:Y-m-d h:iA',
        'adress' => 'required|string|max:255',
        'telephone' => 'required|numeric',
    ]);

    // Log the validated data
    Log::info('Validated data:', $validated);

    // Log the dates before conversion for debugging
    Log::info('Before date conversion:', [
        'date1' => $validated['date1'],
        'date2' => $validated['date2'],
        'date3' => $validated['date3'],
        'date4' => $validated['date4'],
    ]);

    // Convert dates using Carbon to MySQL format (Y-m-d H:i:s)
    foreach (['date1', 'date2', 'date3', 'date4'] as $dateField) {
        if (isset($validated[$dateField])) {
            try {
                Log::info("Converting $dateField:", ['original' => $validated[$dateField]]);
                $validated[$dateField] = Carbon::createFromFormat('Y-m-d h:iA', $validated[$dateField])->format('Y-m-d H:i:s');
                Log::info("Converted $dateField:", ['converted' => $validated[$dateField]]);
            } catch (\Exception $e) {
                // If date conversion fails, log the error and return a response with error message
                Log::error("Error parsing date for $dateField", ['error' => $e->getMessage()]);
                return response()->json(['error' => "Invalid date format for $dateField."], 400);
            }
        }
    }

    // Create the Prestation record with validated and converted data
    $prestation = Prestation::create($validated);

    // Log the created Prestation data
    Log::info('Created Prestation:', $prestation->toArray());

    // Return success response with created prestation data
    return response()->json($prestation, 201);
}


    
    public function show($user_id)
{
    // Find the prestation by user_id, not the primary key (id)
    $prestation = Prestation::where('user_id', $user_id)->get();

    if (!$prestation) {
        return response()->json(['message' => 'Prestation not found'], 404);
    }

    return response()->json($prestation, 200);
}
public function getVist($vistid)
{
    // Find the prestation by vistid (assuming 'vistid' is a valid column)
    $prestation = Prestation::where('id', $vistid)->first();  // Use 'first()' to get a single record

    if (!$prestation) {
        return response()->json(['message' => 'Prestation not found'], 404);
    }

    return response()->json($prestation, 200);
}


    

    public function update(Request $request, $id)
{
    // Log the incoming ID
    Log::info("Updating Prestation with ID: $id");

    // Find the Prestation by ID
    $prestation = Prestation::find($id);

    if (!$prestation) {
        Log::warning("Prestation with ID: $id not found.");
        return response()->json(['message' => 'Prestation not found'], 404);
    }

    // Continue with the update logic here...
}

    
    public function destroy($id)
    {
        $prestation = Prestation::find($id);

        if (!$prestation) {
            return response()->json(['message' => 'Prestation not found'], 404);
        }

        
        $prestation->delete();

        
        return response()->json(['message' => 'Prestation deleted successfully'], 200);
    }
}
