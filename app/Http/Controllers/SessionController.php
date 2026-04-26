<?php

namespace App\Http\Controllers;

use App\Models\session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{


    public function index()
    {
        return view('login.index');
    
    }

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
        return back()->withErrors([
        'loginError' => 'Email atau password salah!'
        ])->withInput();
        
    }



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

 

    public function show(session $session)
    {
        //
    }


    public function edit(session $session)
    {
        //
    }

  

    public function update(Request $request, session $session)
    {
        //
    }

   

    public function destroy(session $session)
    {
        //
    }
}
