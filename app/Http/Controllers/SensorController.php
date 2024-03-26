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

    public function store(Request $request)
    {
        $sensor = new Sensor;
        $sensor->temperature = $request->temperature;
        $sensor->save();


        return redirect()->back();
    }
}
