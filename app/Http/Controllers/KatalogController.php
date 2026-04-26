<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        // $user = Auth::user();
        // return view('login.profile', compact('user'));

        $allKatalog = Katalog::all();
        return view('katalog.index', compact('allKatalog'));
        
        
    }
    

    public function create()
    {
        return view ('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Katalog $katalog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Katalog $katalog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Katalog $katalog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Katalog $katalog)
    {
        //
    }
}
