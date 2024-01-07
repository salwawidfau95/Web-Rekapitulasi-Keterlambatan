<?php

namespace App\Http\Controllers;

use App\Models\student;
use App\Models\rayon;
use App\Models\rombel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $rayonId){
    $rayon = Rayon::where('user_id', Auth::user()->id)->pluck('id')->first();

    if ($rayon) {
        $students = Student::where('rayon_id', $rayon)->get();

        return view("student.ps.index", compact('students'));
    } else {
        return redirect()->back()->with('error', 'Tidak ada data rayon untuk user ini');
    }

}


    public function data()
    {
        $student = student::all();
        return view("student.admin.index", compact('student'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rombel = Rombel::with('student')->get();
        $rayon = Rayon::with('student')->get();
        // $students = Student::with('rombel', 'rayon')->get();
        return view("student.admin.create", compact('rombel', 'rayon'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'name' => 'required',
            'rombel' => 'required',
            'rayon' => 'required',
        ]);
    
        $rayon = Rayon::where('rayon', $request->rayon)->first();
        $rombel = Rombel::where('rombel', $request->rombel)->first();

        Student::create([
            'nis'=> $request->nis,
            'name'=> $request->name,
            'rombel_id'=> $rombel->id,
            'rayon_id' => $rayon->id,
        ]);
    
        return redirect()->back()->with('success', 'Berhasil menambahkan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(student $student, $id)
    {
        $student = Student::find($id);
        $rayons = Rayon::all(); 
        $rombels = Rombel::all(); 

        return view('student.admin.edit', compact('student', 'rayons', 'rombels'));
    }

    public function update(Request $request, $id)
    {
    $request->validate([
        'nis' => 'required',
        'name' => 'required',
        'rombel_id' => 'required',
        'rayon_id' => 'required',
    ]);

    $student = Student::find($id);

    if (!$student) {
        return redirect()->route('student.admin.index')->with('error', 'Data pengguna tidak ditemukan');
    }

    $student->update([
        'nis' => $request->nis,
        'name' => $request->name,
        'rombel_id' => $request->rombel_id,
        'rayon_id' => $request->rayon_id,
    ]);

    return redirect()->back()->with('success', 'Berhasil mengubah data pengguna !!!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        student::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }
}
