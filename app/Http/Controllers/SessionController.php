<?php

namespace App\Http\Controllers;

use App\Models\session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        return view('login.index');
    
    }

    /**
     * Show the form for creating a new resource.   
     */
    public function loginProses(Request $request)
    {
        $credentials = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('beranda.index');
        }
        return back();
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    /**
     * Display the specified resource.
     */
    public function show(session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(session $session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, session $session)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(session $session)
    {
        //
    }
}
