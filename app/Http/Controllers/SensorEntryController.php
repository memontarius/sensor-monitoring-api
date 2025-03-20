<?php

namespace App\Http\Controllers;

use App\Http\Resources\SensorEntryResource;
use App\Models\Enums\SensorValueKey;
use App\Models\SensorEntry;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SensorEntryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'start' => 'date',
            'end' => 'date',
            'sensors.*' => 'integer',
            'types.*' => [Rule::enum(SensorValueKey::class)]
        ]);

        $sensorIds = $validatedData['sensors'] ?? null;
        $sensorTypes = $validatedData['types'] ?? null;
        $start = $validatedData['start'] ?? Carbon::now()->addDays(-1)->toDateTimeString();
        $end = $validatedData['end'] ?? Carbon::now()->toDateTimeString();

        $query = SensorEntry::where('created_at', '>=', $start)
            ->where('created_at', '<=', $end);

        if ($sensorIds) {
            $query->whereIn('sensor_id', $sensorIds);
        }

        if ($sensorTypes) {
            $query->whereIn('type', $sensorTypes);
        }

        $groupedEntries = $query
            ->get()
            ->groupBy('type')
            ->map(function ($collection) {
            return SensorEntryResource::collection($collection);
        });

        return response()->json($groupedEntries);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'sensor' => 'required|integer',
            'value' => 'required|numeric',
            'type' => 'string'
        ]);

        SensorEntry::create([
            'sensor_id' => $validatedData['sensor'],
            ...$request->only('type', 'value')
        ]);

        return response()->json(['status' => 'success',]);
    }
}
