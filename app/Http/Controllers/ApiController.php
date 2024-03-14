<?php

namespace App\Http\Controllers;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Pusher\Pusher;

class ApiController extends Controller
{
    public function index()
    {
        return "Halaman Utama";
    }

    public function espSensor(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'time' => '',
                'humidity' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(["status" => "error", "message" => $validator->errors()], 400);
            }

            $humidity = $request->input('humidity');

            // Simpan data ke database
            $sensorData = [
                'humidity' => $humidity,
            ];

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

            $pusher->trigger('sensor-channel', 'sensor-event', ['data' => $sensorData]);

            return response()->json(["status" => "success", "message" => "data berhasil disimpan"], 200);
        } catch (\Exception $e) {
            return response()->json(["status" => "error", "message" => $e->getMessage()], 500);
        }
    }
}
