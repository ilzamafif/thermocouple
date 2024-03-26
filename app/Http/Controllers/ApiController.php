<?php

namespace App\Http\Controllers;
// ApiController.php
use Pusher\Pusher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function espSensor(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'temperature' => 'required',
            ]);
            
            if ($validator->fails()) {
                return response()->json(["status" => "error", "message" => $validator->errors()], 400);
            }

            $temperature = $request->input('temperature');

            // Panggil Pusher untuk mengirim informasi sensor
            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                [
                    'cluster' => env('PUSHER_APP_CLUSTER'),
                    'useTLS' => true
                ]
            );

            $pusher->trigger('sensor-channel', 'sensor-event', ['data' => $temperature]);

            return response()->json(["status" => "success", "message" => "Data berhasil disimpan"], 200);
        } catch (\Exception $e) {
            return response()->json(["status" => "error", "message" => $e->getMessage()], 500);
        }
    }
}
