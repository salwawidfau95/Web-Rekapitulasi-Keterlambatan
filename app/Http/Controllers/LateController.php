<?php

namespace App\Http\Controllers;

use Excel;
use PDF;
use App\Exports\LateExport;
use App\Models\late;
use App\Models\student;
use App\Models\rayon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
    $rayon = Rayon::where('user_id', Auth::user()->id)->pluck('id')->first();

    if ($rayon) {
        $late = Late::whereHas('student', function ($query) use ($rayon) {
            $query->where('rayon_id', $rayon);
        });

        $search = $request->input('search');
        if ($search) {
            $late->whereHas('student', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }
        $late = $late->with('student')->get();

        return view("late.ps.index", compact('late'));
    } else {
        return redirect()->back()->with('error', 'Tidak ada data rayon untuk user ini');
    }
}

    
    public function data(Request $request)
    {
        $search = $request->input('search');

        $late = Late::with('student');
    
            if ($search) {
            $late->whereHas('student', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }
    
        $late = $late->get();
    
        return view('late.admin.index', compact('late'));
        }   

    public function create()
    {   
        $student = student::all();
        return view('late.admin.create', compact('student')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'date_time_late'=> 'required',
            'information'=> 'required',
            'bukti' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = time().'.'.$request->bukti->extension();
        $request->bukti->move(public_path('uploads'), $image);

        late::create([
        'student_id' => $request->student_id,
        'date_time_late' => $request->date_time_late,
        'information' => $request->information,
        'bukti' => $image,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data keterlambatan!');
    }

    public function rekap(Request $id)
    {
        $rayon = Rayon::where('user_id', Auth::user()->id)->pluck('id')->first();

    if ($rayon) {
        $rekap = Late::selectRaw('lates.student_id as student_id, students.name as student_name, students.nis, COUNT(*) as total_late, MAX(lates.date_time_late) as lates_late_date')
            ->join('students', 'lates.student_id', '=', 'students.id')
            ->where('students.rayon_id', $rayon)
            ->groupBy('student_id', 'students.name', 'students.nis')
            ->get();

        return view('late.ps.rekap', compact('rekap'));
    } else {
        return redirect()->back()->with('error', 'Tidak ada data rayon untuk user ini');
    }
    }

    public function rekap2(Request $id)
    {
        $rekap = Late::selectRaw('lates.student_id as student_id, students.name as student_name, students.nis, COUNT(*) as total_late, MAX(lates.date_time_late) as lates_late_date')
        ->join('students', 'lates.student_id', '=', 'students.id')
        ->groupBy('student_id', 'students.name', 'students.nis')
        ->get();

        $student = Late::with('student')->get();

        return view('late.admin.rekap', compact('rekap'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $id)
    {
        $student1 = student::all();
        // $show = late::where('id', $id)->get();
        $student = student::find($id);
        $late = late::find($id);
        $show = Late::with('student')->get();
        return view('late.ps.show', compact('show','student'));
    }

    public function show2(Request $id)
    {
        $student1 = student::all();
        // $show = late::where('id', $id)->get();
        $student = student::find($id);
        $show = Late::with('student')->get();
        return view('late.admin.show', compact('show','student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = student::find($id);
        $late = late::find($id);
        return view('late.admin.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required',
            'date_time_lite'=> 'required',
            'information'=> 'required',
            'bukti' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = time().'.'.$request->bukti->extension();
        $request->bukti->move(public_path('uploads'), $image);

        $late = Late::find($id);
        $late->update([
        'student_id' => $request->student_id,
        'date_time_lite' => $request->date_time_lite,
        'information' => $request->information,
        'bukti' => $image,
        ]);

        return redirect()->route('late.admin.index')->with('success', 'Berhasil mengubah data keterlambatan !!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        late::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }

        // public function exportExcel(){
        //     $role = auth()->user()->role;
    
        //     if ($role === 'admin') {
        //         return Excel::download(new LateExport, 'keterlambatan.xlsx');
        //     } else {
        //         $userIdLogin = Auth::id();
        //         $rayonIdLogin = rayon::where('user_id', $userIdLogin)->value('id');
    
        //         return Excel::download(new LateExport($userIdLogin, $rayonIdLogin), 'keterlambatan.xlsx');
        //     }
        // }

        public function exportExcel()
        {
            $late = 'data_keterlambatan'.'.xlsx';
            return Excel::download(new LateExport, $late);
        }
    
    
    public function downloadPDF($id) {
        $late = Late::find($id); 
    
        $late = [
            'late' => $late
        ];
    
        $pdf = PDF::loadView('late.ps.download', $late);
    
        return $pdf->download('Data_Keterlambatan.pdf');
    }
    
    public function download2($id) {
        $late = Late::find($id); 
    
        $late = [
            'late' => $late
        ];
    
        $pdf = PDF::loadView('late.admin.download', $late);
    
        return $pdf->download('Data_Keterlambatan.pdf');
    }
    
}