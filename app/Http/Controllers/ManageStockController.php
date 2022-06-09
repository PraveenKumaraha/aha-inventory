<?php

namespace App\Http\Controllers;

use App\ManageStock;
use Illuminate\Http\Request;

class ManageStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Masters.Manage Stock.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Masters.Manage Stock.create');
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
     * @param  \App\ManageStock  $manageStock
     * @return \Illuminate\Http\Response
     */
    public function show(ManageStock $manageStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ManageStock  $manageStock
     * @return \Illuminate\Http\Response
     */
    public function edit(ManageStock $manageStock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ManageStock  $manageStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageStock $manageStock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ManageStock  $manageStock
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManageStock $manageStock)
    {
        //
    }
}
