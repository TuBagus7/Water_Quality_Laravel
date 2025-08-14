<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function index()
    {
        $sensors = Sensor::orderBy('id', 'desc')->paginate(10);

        return view('sensor.index', compact('sensors'));
    }

    public function create()
    {
        return view('sensor.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "nama_sensor" => "required|min:2",
            "data" => "required",
            "topic" => "required",
        ], [
            "nama_sensor.required" => "Nama sensor harus diisi!",
            "nama_sensor.min" => "Minimal 2 karakter!",
            "data.required" => "Data harus diisi!",
            "topic.required" => "Topic harus diisi!",
        ]);

        Sensor::create($validatedData);

        return redirect('/sensors')->with('success', 'Berhasil menambahkan data!');
    }

    public function edit($id)
    {
        $sensor = Sensor::findOrFail($id);

        return view('sensor.edit', compact('sensor'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            "nama_sensor" => "required|min:2",
            "data" => "required",
            "topic" => "required",
        ], [
            "nama_sensor.required" => "Nama sensor harus diisi!",
            "nama_sensor.min" => "Minimal 2 karakter!",
            "data.required" => "Data harus diisi!",
            "topic.required" => "Topic harus diisi!",
        ]);

        Sensor::findOrFail($id)->update($validatedData);

        return redirect('/sensors')->with('success', 'Berhasil mengubah data!');
    }

    public function delete($id)
    {
        Sensor::findOrFail($id)->delete();

        return redirect('/sensors')->with('success', 'Berhasil menghapus data!');
    }
}
