<?php

namespace App\Http\Controllers;
use App\Models\AirQuality;
use Illuminate\Http\Request;

class AirQualityController extends Controller
{
    public function index()
    {
        $airQualityRecords = AirQuality::all();
        return response()->json($airQualityRecords, 200);
    }
}
