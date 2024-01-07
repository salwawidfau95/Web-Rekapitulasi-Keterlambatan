<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rayon;
use App\Models\student;
use App\Models\late;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserController extends Controller
{
        public function loginAuth(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $request->only(['email', 'password']);
    
        if (Auth::attempt($credentials)) {
            if (Auth::user()->role == 'admin') {
                return redirect('/dashboard');
            } elseif (Auth::user()->role == 'ps') {
                return redirect('/dashboard2'); 
            }
        } else {
            return redirect()->back()->with('failed', 'Email dan password tidak sesuai, silahkan coba lagi!');
        }
        
    }

    public function dashboard2()
    {
        $rayon = Rayon::where('user_id', Auth::user()->id)->pluck('rayon')->first();
        $todayLateCount = Late::whereDate('date_time_late', Carbon::today())->count();
        $rayonIds = Rayon::where('user_id', Auth::user()->id)->pluck('id');

        return view('home.index1', compact('todayLateCount', 'rayon',));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::orderBy('name','ASC')->simplePaginate(5);
        return view('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'role'=>'required',
        ]);
        User::create([
            'name' =>$request->name,
            'email' =>$request->email,
            'role' =>$request->role,
            'password'=> Hash::make(substr($request->name, 0, 3). substr($request->email,0,3)),
        ]);
        return redirect()->route('user.index')->with('success','berhasil menambahkan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
        ]);
    
        $user = User::find($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);
    
        return redirect()->route('user.index')->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }
}
