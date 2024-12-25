<?php

namespace App\Http\Controllers;

use App\Models\SendPrestation;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SendPrestationController extends Controller
{
    public function index()
    {
        $sendPrestations = SendPrestation::paginate(15); 
        return response()->json($sendPrestations);
    }

    public function show($id)
    {
        $sendPrestation = SendPrestation::findOrFail($id);
        $user = User::find($sendPrestation->user_id);
        $userName = $user ? $user->name : 'غير موجود';

        $sendPrestation->userName = $userName;

        return response()->json($sendPrestation);
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'title' => 'required|string|max:255',
        'prix' => 'required|numeric',
        'description' => 'required|string',
        'surface' => 'required|numeric',
        'total' => 'required|numeric',
        'date1' => 'required|date_format:Y-m-d h:i A',
        'address' => 'required|string',
        'date2' => 'nullable|date_format:Y-m-d h:i A',
        'date3' => 'nullable|date_format:Y-m-d h:i A',
        'date4' => 'nullable|date_format:Y-m-d h:i A',
    ]);

    foreach (['date1', 'date2', 'date3', 'date4'] as $dateField) {
        if (!empty($validated[$dateField])) {
            $validated[$dateField] = Carbon::createFromFormat('Y-m-d h:i A', $validated[$dateField])->format('Y-m-d H:i:s');
        }
    }

    $sendPrestation = SendPrestation::create($validated);

    return response()->json(['success' => true, 'data' => $sendPrestation], 201);
}


    public function update(Request $request, $id)
    {
        $sendPrestation = SendPrestation::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'description' => 'required|string',
            'surface' => 'required|numeric',
            'total' => 'required|numeric',
            'date1' => 'required|date_format:Y-m-d h:i A',
            'address' => 'required|string',
            'date2' => 'nullable|date_format:Y-m-d h:i A',
            'date3' => 'nullable|date_format:Y-m-d h:i A',
            'date4' => 'nullable|date_format:Y-m-d h:i A',
        ]);

        $validated['date1'] = Carbon::createFromFormat('Y-m-d h:i A', $validated['date1'])->format('Y-m-d H:i:s');
        $validated['date2'] = $validated['date2'] ? Carbon::createFromFormat('Y-m-d h:i A', $validated['date2'])->format('Y-m-d H:i:s') : null;
        $validated['date3'] = $validated['date3'] ? Carbon::createFromFormat('Y-m-d h:i A', $validated['date3'])->format('Y-m-d H:i:s') : null;
        $validated['date4'] = $validated['date4'] ? Carbon::createFromFormat('Y-m-d h:i A', $validated['date4'])->format('Y-m-d H:i:s') : null;

        $sendPrestation->update($validated);

        return response()->json($sendPrestation);
    }

    public function destroy($id)
    {
        $sendPrestation = SendPrestation::findOrFail($id);
        $sendPrestation->delete();

        return response()->json(null, 204);
    }
}

