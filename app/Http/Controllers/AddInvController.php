<?php

namespace App\Http\Controllers;

use App\AddInv;
use App\InventoryItem;
use Illuminate\Http\Request;

class AddInvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pdtproductIds = InventoryItem::select('product_name', 'id')->get();
        return view('AddInv.index', compact('pdtproductIds'));
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
     * @param  \App\AddInv  $addInv
     * @return \Illuminate\Http\Response
     */
    public function show(AddInv $addInv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AddInv  $addInv
     * @return \Illuminate\Http\Response
     */
    public function edit(AddInv $addInv)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AddInv  $addInv
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AddInv $addInv)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AddInv  $addInv
     * @return \Illuminate\Http\Response
     */
    public function destroy(AddInv $addInv)
    {
        //
    }
}
