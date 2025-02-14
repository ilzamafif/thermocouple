<?php

namespace App\Http\Controllers;

use App\Models\Command;
use Illuminate\Http\Request;
use App\Models\Sensor;
use App\Models\Download;
use App\Models\SerialNumber;
use Illuminate\Support\Facades\Storage;
use Pusher\Pusher;
use Illuminate\Support\Facades\Session;
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
        $sensor->alarm = $request->alarm;
        $sensor->save();


        return redirect()->back();
    }

    public function show() {
        
        return view('pages.sensors.res');
    }
    
    public function storeData(Request $request)
    {
        if (!$request->has('fileContent')) {
            return response()->json(['message' => 'File content is required'], 400);
        }
    
         $d = new Download;
        $d->fileContent = $request->fileContent;
        $d->save();
    
        return response()->json(['message' => $request->fileContent]);
    }


    public function getData()
    {
        $fileContent = Download::orderBy('id', 'desc')->first();

        return response()->json(['fileContent' => $fileContent]);
    }
}
