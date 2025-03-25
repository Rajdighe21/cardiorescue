<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('admin.attendance.index');
    }



    public function receiveLogs(Request $request)
    {
        
       Log::info('Webhook Received'); // Should appear first
       Log::info('Webhook Data: ' . json_encode($request->all())); // Actual data

        // return response()->json([
        //     'message' => 'Data received successfully',
        //     'received_data' => $request->all(),
        // ]);
        
        // Validate request data
        $data = $request->json()->all();

        if (!is_array($data)) {
            return response()->json(['error' => 'Invalid data format'], 400);
        }

        // Insert data into the database
        foreach ($data as $log) {
            Attendance::create([
                'employee_code'    => $log['EmployeeCode'],
                'log_date'         => Carbon::parse($log['LogDate']),
                'device_name'      => $log['DeviceName'],
                'serial_number'    => $log['SerialNumber'],
                'direction'        => $log['Direction'],
                'device_direction' => $log['DeviceDirection'],
                'work_code'        => $log['WorkCode'] ?? null,
                'verification_type' => $log['VerificationType'],
                'gps'              => $log['GPS'] ?? null,
            ]);
        }

        return response('Data received successfully', 200);
    }
}
