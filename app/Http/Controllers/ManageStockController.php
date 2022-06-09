<?php

namespace App\Http\Controllers;

use App\InventoryItem;
use App\ManageStock;
use App\Product;
use Illuminate\Http\Request;
use App\Purchase;


class ManageStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $models = InventoryItem::select('product_name', 'id')->get();




        return view('Masters.Manage Stock.index', compact('models'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
