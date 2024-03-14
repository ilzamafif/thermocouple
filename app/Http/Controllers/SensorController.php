<?php

namespace App\Http\Controllers;

use App\Models\Command;
use Illuminate\Http\Request;
use App\Models\Sensor;
use App\Models\SerialNumber;
use Session;
use Illuminate\Support\Facades\Storage;
use Pusher\Pusher;

class SensorController extends Controller
{
    public function index()
    {
        // get 4 data form database latest
        $data = Sensor::orderBy('id', 'desc')->limit(4)->get();
        return view('pages.sensors.index', [
            'data' => $data
        ]);
    }


    public function receiveSensorData(Request $request)
    {
        // Proses data dari sensor

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true
            ]
        );

        $pusher->trigger('sensor-channel', 'sensor-event', $data);

        // Proses selanjutnya
    }

    public function store(Request $request)
    {
        $sensor = new Sensor;
        $sensor->nama = $request->nama;
        $sensor->no = $request->no;
        $sensor->tinggi = floatval($request->tinggi);
        $sensor->berat = floatval($request->berat);
        $sensor->jk = $request->jk;
        $sensor->gizi = $request->gizi;
        $sensor->save();


        return redirect()->back();
    }
    public function post_command(Request $request)
    {
        $command = new Command();
        $command->command = $request->command;
        $command->save();


        return redirect()->back();
    }
}
