<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    // ========================
    //  API CRUD
    // ========================

    public function index()
    {
        return response()->json(Package::all());
    }

    public function show($id)
    {
        $data = Package::find($id);
        return $data
            ? response()->json($data)
            : response()->json(['message' => 'Package not found'], 404);
    }

    public function store(Request $request)
    {
        $request->validate([
            'package_name' => 'required|string|max:150',
            'description' => 'required|string',
            'location' => 'required|string|max:150',
            'duration' => 'required|string|max:50',
            'price' => 'required|numeric',
            'image' => 'nullable|string'
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $package = Package::create($request->all());
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return response()->json(['message' => 'Package created', 'data' => $package], 201);
    }

    public function update(Request $request, $id)
    {
        $package = Package::find($id);
        if (!$package) {
            return response()->json(['message' => 'Package not found'], 404);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $package->update($request->all());
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return response()->json(['message' => 'Package updated', 'data' => $package]);
    }

    public function destroy($id)
    {
        $package = Package::find($id);
        if (!$package) {
            return response()->json(['message' => 'Package not found'], 404);
        }

        $package->delete();
        return response()->json(['message' => 'Package deleted']);
    }

    // ========================
    //  VIEW CRUD (Blade)
    // ========================

    public function view()
    {
        $data = Package::all();
        return view('packages', compact('data'));
    }

    public function create()
    {
        return view('package_create');
    }

    public function storeFromView(Request $request)
    {
        $request->validate([
            'package_name' => 'required|string|max:150',
            'description' => 'required|string',
            'location' => 'required|string|max:150',
            'duration' => 'required|string|max:50',
            'price' => 'required|numeric',
            'image' => 'nullable|string'
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Package::create($request->all());
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect('/view/packages')->with('success', 'Paket berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $package = Package::findOrFail($id);
        return view('package_edit', compact('package'));
    }

    public function updateFromView(Request $request, $id)
    {
        $package = Package::findOrFail($id);

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $package->update($request->all());
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        return redirect('/view/packages')->with('success', 'Paket berhasil diubah!');
    }

    public function destroyFromView($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();
        return redirect('/view/packages')->with('success', 'Paket berhasil dihapus!');
    }
}
