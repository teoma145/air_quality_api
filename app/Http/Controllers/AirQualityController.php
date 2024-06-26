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

    public function show($id)
    {
        $airQualityRecord = AirQuality::findOrFail($id);
        return response()->json($airQualityRecord);
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
        'data_di_misurazione' => 'required|date',
        'id_station' => 'required|integer',
        'denominazione' => 'required|string',
        'provincia' => 'required|string',
        'longitudine' => 'required|numeric',
        'latitudine' => 'required|numeric',
        'tipologia_di_area' => 'required|string',
        'tipologia_stazione' => 'required|string',
        'rete' => 'required|string',
        'interesse_rete' => 'required|string',
        'inquinante_misurato' => 'required|string',
        'valore_inquinante_misurato' => 'required|numeric',
        'limite' => 'required|numeric',
        'unità_di_misura' => 'required|string',
        'superamenti' => 'required|integer',
        'indice_qualità' => 'required|integer',
        ]);

    $airQualityRecord = new AirQuality([
        'comune' => $request->input('comune'),
        'classe_qualità' => $request->input('classe_qualità'),
        'data_di_misurazione' => $request->input('data_di_misurazione'),
        'id_station' => $request->input('id_station'),
        'denominazione' => $request->input('denominazione'),
        'provincia' => $request->input('provincia'),
        'longitudine' => $request->input('longitudine'),
        'latitudine' => $request->input('latitudine'),
        'tipologia_di_area' => $request->input('tipologia_di_area'),
        'tipologia_stazione' => $request->input('tipologia_stazione'),
        'rete' => $request->input('rete'),
        'interesse_rete' => $request->input('interesse_rete'),
        'inquinante_misurato' => $request->input('inquinante_misurato'),
        'valore_inquinante_misurato' => $request->input('valore_inquinante_misurato'),
        'limite' => $request->input('limite'),
        'unità_di_misura' => $request->input('unità_di_misura'),
        'superamenti' => $request->input('superamenti'),
        'indice_qualità' => $request->input('indice_qualità'),

    ]);

    $airQualityRecord->save();

    return response()->json(['message' => 'Record created successfully.', 'data' => $airQualityRecord], 201);
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
    public function update(Request $request, $id)
{
    // Valida tutti i campi
    $request->validate([
        'comune' => 'required|string',
        'classe_qualità' => 'required|string',
        'data_di_misurazione' => 'required|date',
        'id_station' => 'required|integer',
        'denominazione' => 'required|string',
        'provincia' => 'required|string',
        'longitudine' => 'required|numeric',
        'latitudine' => 'required|numeric',
        'tipologia_di_area' => 'required|string',
        'tipologia_stazione' => 'required|string',
        'rete' => 'required|string',
        'interesse_rete' => 'required|string',
        'inquinante_misurato' => 'required|string',
        'valore_inquinante_misurato' => 'required|numeric',
        'limite' => 'required|numeric',
        'unità_di_misura' => 'required|string',
        'superamenti' => 'required|integer',
        'indice_qualità' => 'required|integer',
    ]);

    // Trova il record che deve essere aggiornato
    $airQualityRecord = AirQuality::findOrFail($id);

    // Aggiorna tutti i campi
    $airQualityRecord->update($request->all());

    return response()->json(['message' => 'Record updated successfully.', 'data' => $airQualityRecord], 200);   

    }
public function patch(Request $request, $id)
    {
   
    $airQualityRecord = AirQuality::findOrFail($id);

    
    $request->validate([
        'comune' => 'sometimes|required|string',
        'classe_qualità' => 'sometimes|required|string',
        'data_di_misurazione' => 'sometimes|required|date',
        'id_station' => 'sometimes|required|integer',
        'denominazione' => 'sometimes|required|string',
        'provincia' => 'sometimes|required|string',
        'longitudine' => 'sometimes|required|numeric',
        'latitudine' => 'sometimes|required|numeric',
        'tipologia_di_area' => 'sometimes|required|string',
        'tipologia_stazione' => 'sometimes|required|string',
        'rete' => 'sometimes|required|string',
        'interesse_rete' => 'sometimes|required|string',
        'inquinante_misurato' => 'sometimes|required|string',
        'valore_inquinante_misurato' => 'sometimes|required|numeric',
        'limite' => 'sometimes|required|numeric',
        'unità_di_misura' => 'sometimes|required|string',
        'superamenti' => 'sometimes|required|integer',
        'indice_qualità' => 'sometimes|required|integer',
    ]);

    // Aggiorna solo i campi forniti nella richiesta
    $airQualityRecord->update($request->all());

    return response()->json(['message' => 'Record updated successfully.', 'data' => $airQualityRecord], 200);
}
public function search(Request $request)
{
    $query = AirQuality::query();

    if ($request->has('comune')) {
        $query->where('comune', $request->input('comune'));
    }

    if ($request->has('classe_qualità')) {
        $query->where('classe_qualità', $request->input('classe_qualità'));
    }

    if ($request->has('min_latitudine') && $request->has('max_latitudine')) {
        $query->whereBetween('latitudine', [$request->input('min_latitudine'), $request->input('max_latitudine')]);
    }

    if ($request->has('min_longitudine') && $request->has('max_longitudine')) {
        $query->whereBetween('longitudine', [$request->input('min_longitudine'), $request->input('max_longitudine')]);
    }

    if ($request->has('data_di_misurazione')) {
        $query->where('data_di_misurazione', $request->input('data_di_misurazione'));
    }
    if ($request->has('rete')) {
        $query->where('rete', $request->input('rete'));
    }
    if ($request->has('interesse_rete')) {
        $query->where('interesse_rete', $request->input('interesse_rete'));
    }
    if ($request->has('valore_inquinante_misurato')) {
        $query->where('valore_inquinante_misurato', $request->input('valore_inquinante_misurato'));
    }
    if ($request->has('id_station')) {
        $query->where('id_station', $request->input('id_station'));
    }


    // Aggiungi altre condizioni di filtro qui se necessario

    $airQualityRecords = $query->get();

    if ($airQualityRecords->isEmpty()) {
        return response()->json(['message' => 'No records found for the specified criteria.'], 404);
    }

    return response()->json($airQualityRecords, 200);
}
}