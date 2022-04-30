<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePharmacyProcurementRequest;
use App\Http\Requests\UpdatePharmacyProcurementRequest;
use App\Models\PharmacyProcurement;

class PharmacyProcurementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePharmacyProcurementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePharmacyProcurementRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PharmacyProcurement  $pharmacyProcurement
     * @return \Illuminate\Http\Response
     */
    public function show(PharmacyProcurement $pharmacyProcurement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PharmacyProcurement  $pharmacyProcurement
     * @return \Illuminate\Http\Response
     */
    public function edit(PharmacyProcurement $pharmacyProcurement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePharmacyProcurementRequest  $request
     * @param  \App\Models\PharmacyProcurement  $pharmacyProcurement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePharmacyProcurementRequest $request, PharmacyProcurement $pharmacyProcurement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PharmacyProcurement  $pharmacyProcurement
     * @return \Illuminate\Http\Response
     */
    public function destroy(PharmacyProcurement $pharmacyProcurement)
    {
        //
    }
}
