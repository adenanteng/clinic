<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVisitBillingRequest;
use App\Http\Requests\UpdateVisitBillingRequest;
use App\Models\VisitBilling;

class VisitBillingController extends Controller
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
     * @param  \App\Http\Requests\StoreVisitBillingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVisitBillingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VisitBilling  $visitBilling
     * @return \Illuminate\Http\Response
     */
    public function show(VisitBilling $visitBilling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VisitBilling  $visitBilling
     * @return \Illuminate\Http\Response
     */
    public function edit(VisitBilling $visitBilling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVisitBillingRequest  $request
     * @param  \App\Models\VisitBilling  $visitBilling
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVisitBillingRequest $request, VisitBilling $visitBilling)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VisitBilling  $visitBilling
     * @return \Illuminate\Http\Response
     */
    public function destroy(VisitBilling $visitBilling)
    {
        //
    }
}
