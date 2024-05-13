
<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Log;

class DeviceController extends Controller
{
    public function createDevice(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ]);

        $device = Device::create([
            'name' => $request->name
        ]);

        return response()->json(['message' => 'Device created successfully', 'device' => $device], 201);
    }

    public function createLog(Request $request)
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

    public function getAllDevices()
    {
        $devices = Device::all();
        return response()->json(['devices' => $devices], 200);
    }

    public function getLogsByDevice($device_id)
    {
        $logs = Log::where('device_id', $device_id)->get();
        return response()->json(['logs' => $logs], 200);
    }
}
?>
// Compare this snippet from app/Models/Device.php:
// <?php
//
// namespace App\Models;
    