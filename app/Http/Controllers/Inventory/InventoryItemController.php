<?php

namespace App\Http\Controllers\Inventory;

use App\Category;
use App\Brand;
use App\Product;
use App\Http\Controllers\Controller;
use App\InventoryItem;
use App\Unit;
use Illuminate\Http\Request;

class InventoryItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inventory.InventoryItem.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pdtBrands = Brand::select('brand_name', 'id')->get();
        $pdtCategorys = Category::select('name','id')->get();
        $pdtUnits = Unit::select('name', 'id')->where('status', 1)->get();

        return view('inventory.InventoryItem.create',compact('pdtBrands','pdtCategorys','pdtUnits'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $model = new InventoryItem();
        $model->product_name = $request->input('product_name');
        $model->product_id = $request->input('product_id');
        $model->brand_id = $request->input('brand_id');
        $model->category_id = $request->input('category_id');
        $model->unit_id = $request->input('unit_id');
        $model->a_price = $request->input('a_price');
        $model->s_price = $request->input('s_price');
        $model->gst = $request->input('gst');
        $model->limt = $request->input('limt');
        $model->status = "1";

        $model->save();
        return redirect()
            ->route('inventoryItem.index')
            ->withStatus('Product Successfully Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StockProduct  $stockProduct
     * @return \Illuminate\Http\Response
     */
    public function show( )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StockProduct  $stockProduct
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StockProduct  $stockProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StockProduct  $stockProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy( )
    {
        //
    }
}
