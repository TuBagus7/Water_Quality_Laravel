<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        // $devices = Device::all();
        $devices = Device::orderBy('id', 'desc')->paginate(10);
        return view('device.index', [
            "devices" => $devices,
        ]);
    }

    public function create()
    {
        return view('device.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "serial_number" => "required|min:2",
            "meta_data" => "required",
        ], [
            "serial_number.required" => "Serial number harus diisi!",
            "serial_number.min" => "Minimal 2 karakter!",
            "meta_data.required" => "Meta data harus diisi!",
        ]);

        $device = [
            "serial_number" => $request->input('serial_number'),
            "meta_data" => $request->input('meta_data'),
        ];

        // dd($device);
        Device::create($device);

        return redirect('/devices')->with("success", "Berhasil menambahkan data device!");
    }

    public function edit($id)
    {
        $device = Device::findOrFail($id);
        return view('device.edit', [
            "device" => $device,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "serial_number" => ["required", "min:2"],
            "meta_data" => ["required"],
        ], [
            "serial_number.required" => "Serial number harus diisi!",
            "serial_number.min" => "Minimal 2 karakter!",
            "meta_data.required" => "Meta data harus diisi!",
        ]);

        $device = [
            "serial_number" => $request->input('serial_number'),
            "meta_data" => $request->input('meta_data'),
        ];

        Device::findOrFail($id)->update($device);

        return redirect('/devices')->with('success', 'Berhasil mengubah data device dengan id ' . $id);
    }

    public function delete($id)
    {
        Device::findOrFail($id)->delete();

        return redirect('/devices')->with('success', 'Berhasil menghapus data');
    }
}
