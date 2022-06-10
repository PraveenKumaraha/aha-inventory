<?php

namespace App\Http\Controllers\Purchase;

use App\ReturnPurchase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReturnPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inventory.Purchase.Return Purchase.index');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReturnPurchase  $returnPurchase
     * @return \Illuminate\Http\Response
     */
    public function show(ReturnPurchase $returnPurchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReturnPurchase  $returnPurchase
     * @return \Illuminate\Http\Response
     */
    public function edit(ReturnPurchase $returnPurchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReturnPurchase  $returnPurchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReturnPurchase $returnPurchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReturnPurchase  $returnPurchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReturnPurchase $returnPurchase)
    {
        //
    }
}
