<?php

namespace App\Http\Controllers;

use App\Models\ClockedIn;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClockedInRequest;
use App\Http\Requests\UpdateClockedInRequest;

class ClockedInController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreClockedInRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ClockedIn $clockedIn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClockedIn $clockedIn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClockedInRequest $request, ClockedIn $clockedIn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClockedIn $clockedIn)
    {
        //
    }
}
