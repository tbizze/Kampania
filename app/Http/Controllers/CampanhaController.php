<?php

namespace App\Http\Controllers;

use App\Models\Campanha;
use App\Http\Requests\StoreCampanhaRequest;
use App\Http\Requests\UpdateCampanhaRequest;
use Illuminate\Http\Request;

class CampanhaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        dd('index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCampanhaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Campanha $campanha)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campanha $campanha)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCampanhaRequest $request, Campanha $campanha)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campanha $campanha)
    {
        //
    }
}
