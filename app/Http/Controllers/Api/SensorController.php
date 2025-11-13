<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SensorController extends Controller
{
    public function index()
    {
        $limit = request()->query('limit', 10);

        $sensors = Sensor::limit($limit)->get();

        return response()->json([
            "data" => $sensors,
        ], 200);
    }

    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            "nama_sensor" => "required",
            "data" => "required",
            "topic" => "required",
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                "errors" => $validatedData->errors(),
            ], 422);
        }

        Sensor::create($validatedData->validated());

        return response()->json([
            "message" => "Berhasil menambahkan data sensor",
        ], 201);
    }
}
