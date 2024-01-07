<?php

namespace App\Http\Controllers;

use App\Models\rayon;
use App\Models\User;
use Illuminate\Http\Request;

class RayonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rayon = rayon::with('User')->get();
        return view("rayon.index", compact('rayon'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rayon = User::where('role', 'ps')->get();
        return view("rayon.create", compact('rayon'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rayon' => 'required',
            'name' => 'required'
        ]);
    
        $user = User::where('name', $request->name)->first();

        Rayon::create([
            'rayon' => $request->rayon,
            'user_id' => $user->id,
        ]);
    
        return redirect()->route('rayon.index')->with('success', 'Berhasil menambahkan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(rayon $rayon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rayon = rayon::find($id);
        $users = User::where('role', 'ps')->get();
        return view('rayon.edit', compact('rayon', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        rayon::where('id', $id)->update([
            'rayon' => $request->rayon,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('rayon.index')->with('success', 'Berhasil mengubah data pengguna !!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        rayon::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }
}