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

    
    // public function store(Request $request)
    // {
    
    //     $validated = $request->validate([
    //         'user_id' => 'required|exists:users,id',
    //         'title' => 'required|string|max:255',
    //         'prix' => 'required|numeric',
    //         'description' => 'nullable|string',
    //         'surface' => 'required|integer',
    //         'date1' => 'required|date_format:Y-m-d h:iA', 
    //         'date2' => 'nullable|date_format:Y-m-d h:iA', 
    //         'date3' => 'nullable|date_format:Y-m-d h:iA', 
    //         'date4' => 'nullable|date_format:Y-m-d h:iA',
    //         'adress' => 'required|string|max:255',
    //     ]);

    //     // Convert dates using Carbon to MySQL format (Y-m-d H:i:s)
    //     $validated['date1'] = Carbon::createFromFormat('Y-m-d h:iA', $validated['date1'])->format('Y-m-d H:i:s');
    //     $validated['date2'] = $validated['date2'] ? Carbon::createFromFormat('Y-m-d h:iA', $validated['date2'])->format('Y-m-d H:i:s') : null;
    //     $validated['date3'] = $validated['date3'] ? Carbon::createFromFormat('Y-m-d h:iA', $validated['date3'])->format('Y-m-d H:i:s') : null;
    //     $validated['date4'] = $validated['date4'] ? Carbon::createFromFormat('Y-m-d h:iA', $validated['date4'])->format('Y-m-d H:i:s') : null;

      
    //     $prestation = Prestation::create($validated);

        
    //     return response()->json($prestation, 201);
    // }


    public function store(Request $request)
    {
        // Log the incoming request data
        Log::info('Incoming request data:', $request->all());

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'description' => 'nullable|string',
            'surface' => 'required|integer',
            'date1' => 'required|date_format:Y-m-d h:iA', 
            'date2' => 'nullable|date_format:Y-m-d h:iA', 
            'date3' => 'nullable|date_format:Y-m-d h:iA', 
            'date4' => 'nullable|date_format:Y-m-d h:iA',
            'adress' => 'required|string|max:255',
        ]);

        // Log the validated data
        Log::info('Validated data:', $validated);

        // Log the dates before conversion
        Log::info('Before date conversion:', [
            'date1' => $validated['date1'],
            'date2' => $validated['date2'],
            'date3' => $validated['date3'],
            'date4' => $validated['date4'],
        ]);

        // Convert dates using Carbon to MySQL format (Y-m-d H:i:s)
        if (isset($validated['date1'])) {
            Log::info('Converting date1:', ['original' => $validated['date1']]);
            $validated['date1'] = Carbon::createFromFormat('Y-m-d h:iA', $validated['date1'])->format('Y-m-d H:i:s');
            Log::info('Converted date1:', ['converted' => $validated['date1']]);
        }
        
        if (isset($validated['date2'])) {
            Log::info('Converting date2:', ['original' => $validated['date2']]);
            $validated['date2'] = Carbon::createFromFormat('Y-m-d h:iA', $validated['date2'])->format('Y-m-d H:i:s');
            Log::info('Converted date2:', ['converted' => $validated['date2']]);
        }

        if (isset($validated['date3'])) {
            Log::info('Converting date3:', ['original' => $validated['date3']]);
            $validated['date3'] = Carbon::createFromFormat('Y-m-d h:iA', $validated['date3'])->format('Y-m-d H:i:s');
            Log::info('Converted date3:', ['converted' => $validated['date3']]);
        }

        if (isset($validated['date4'])) {
            Log::info('Converting date4:', ['original' => $validated['date4']]);
            $validated['date4'] = Carbon::createFromFormat('Y-m-d h:iA', $validated['date4'])->format('Y-m-d H:i:s');
            Log::info('Converted date4:', ['converted' => $validated['date4']]);
        }

        // Create the Prestation record
        $prestation = Prestation::create($validated);

        // Log the created Prestation data
        Log::info('Created Prestation:', $prestation->toArray());

        return response()->json($prestation, 201);
    }


    
    public function show($id)
    {
        $prestation = Prestation::find($id);

        if (!$prestation) {
            return response()->json(['message' => 'Prestation not found'], 404);
        }

        return response()->json($prestation, 200);
    }

    
    public function update(Request $request, $id)
    {
        $prestation = Prestation::find($id);

        if (!$prestation) {
            return response()->json(['message' => 'Prestation not found'], 404);
        }

      
        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'title' => 'sometimes|string|max:255',
            'prix' => 'sometimes|numeric',
            'description' => 'nullable|string',
            'surface' => 'sometimes|integer',
            'date1' => 'required|date_format:Y-m-d h:iA', 
            'date2' => 'nullable|date_format:Y-m-d h:iA', 
            'date3' => 'nullable|date_format:Y-m-d h:iA', 
            'date4' => 'nullable|date_format:Y-m-d h:iA', 
            'adress' => 'sometimes|string|max:255',
        ]);

      // Convert dates using Carbon to MySQL format (Y-m-d H:i:s)
        $validated['date1'] = Carbon::createFromFormat('Y-m-d h:iA', $validated['date1'])->format('Y-m-d H:i:s');
        $validated['date2'] = $validated['date2'] ? Carbon::createFromFormat('Y-m-d h:iA', $validated['date2'])->format('Y-m-d H:i:s') : null;
        $validated['date3'] = $validated['date3'] ? Carbon::createFromFormat('Y-m-d h:iA', $validated['date3'])->format('Y-m-d H:i:s') : null;
        $validated['date4'] = $validated['date4'] ? Carbon::createFromFormat('Y-m-d h:iA', $validated['date4'])->format('Y-m-d H:i:s') : null;

        
        $prestation->update($validated);

      
        return response()->json($prestation, 200);
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
