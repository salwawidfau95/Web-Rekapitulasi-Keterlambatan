<?php

namespace App\Http\Controllers;

use App\Models\rombel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class RombelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rombel = Rombel::all();
        return view('rombel.index', compact('rombel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('rombel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rombel'=>'required',
        ]);
        Rombel::create([
            'rombel' =>$request->rombel,
        ]);
        return redirect()->route('rombel.index')->with('success','berhasil menambahkan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(rombel $rombel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        $rombel =  Rombel::where('id', $id)->first();
        return view('rombel.edit',compact('rombel'));
    }

    /**
 * Update the specified resource in storage.
 */
public function update(Request $request, $id)
{
    $request->validate([
        'rombel' => 'required',
    ]);

    $rombel = Rombel::find($id);

    $rombel->update([
        'rombel' => $request->rombel,
    ]);

    return redirect()->route('rombel.index')->with('success', 'Data updated successfully.');
}

public function destroy($id)
{
    rombel::where('id', $id)->delete();
    return redirect()->back()->with('deleted', 'Berhasil menghapus data!');}

}