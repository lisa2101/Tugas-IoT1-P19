<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'device_id' => 'required|integer',
            'time' => 'required|date',
            'data' => 'required|string'
        ]);

        $log = Log::create([
            'device_id' => $request->device_id,
            'time' => $request->time,
            'data' => $request->data
        ]);

        return response()->json(['message' => 'Log created successfully', 'log' => $log], 201);
    }
}