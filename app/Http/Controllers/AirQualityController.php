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
    public function filterByComune($comune)
    {
        $airQualityRecords = AirQuality::where('comune', $comune)->get();
        return response()->json($airQualityRecords, 200);
    }
    public function filterByClasseQualita($classe_qualita)
    {
        $airQualityRecords = AirQuality::where('classe_qualità', $classe_qualita)->get();

        if ($airQualityRecords->isEmpty()) {
            return response()->json(['message' => 'No records found for the specified quality class.'], 404);
        }

        return response()->json($airQualityRecords, 200);
    }
    public function filterByCoordinates(Request $request)
    {
        $request->validate([
            'min_latitude' => 'required|numeric',
            'max_latitude' => 'required|numeric',
            'min_longitude' => 'required|numeric',
            'max_longitude' => 'required|numeric',
        ]);

        $minLatitude = $request->input('min_latitude');
        $maxLatitude = $request->input('max_latitude');
        $minLongitude = $request->input('min_longitude');
        $maxLongitude = $request->input('max_longitude');

        $airQualityRecords = AirQuality::whereBetween('latitudine', [$minLatitude, $maxLatitude])
            ->whereBetween('longitudine', [$minLongitude, $maxLongitude])
            ->get();

        if ($airQualityRecords->isEmpty()) {
            return response()->json(['message' => 'No records found for the specified coordinates.'], 404);
        }

        return response()->json($airQualityRecords, 200);
    }
    public function filterByComuneAndClasseQualita($comune, $classe_qualita)
    {   
        $airQualityRecords = AirQuality::where('comune', $comune)
            ->where('classe_qualità', $classe_qualita)
            ->get();

        if ($airQualityRecords->isEmpty()) {
            return response()->json(['message' => 'No records found for the specified comune and quality class.'], 404);
        }

        return response()->json($airQualityRecords, 200);
    }
    public function PostByComuneAndClasseQualita(Request $request)
    {
        $request->validate([
            'comune' => 'required|string',
            'classe_qualità' => 'required|string',
        ]);

        $comune = $request->input('comune');
        $classe_qualita = $request->input('classe_qualità');

        $airQualityRecords = AirQuality::where('comune', $comune)
            ->where('classe_qualità', $classe_qualita)
            ->get();

        if ($airQualityRecords->isEmpty()) {
            return response()->json(['message' => 'No records found for the specified comune and quality class.'], 404);
        }

        return response()->json($airQualityRecords, 200);
    }
    public function deleteById($id)
    {
        $airQualityRecord = AirQuality::find($id);

        if (!$airQualityRecord) {
            return response()->json(['message' => 'Record not found.'], 404);
        }

        $airQualityRecord->delete();

        return response()->json(['message' => 'Record deleted successfully.'], 200);
    }
}
