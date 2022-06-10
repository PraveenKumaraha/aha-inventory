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

        $models = InventoryItem::select('inventory_items.*', 'manage_stocks.stock', 'categories.category_name as categoryName', 'brands.brand_name as brandName', 'units.name as unitName')
            ->leftjoin('manage_stocks', 'manage_stocks.item_id', '=', 'inventory_items.id')
            ->leftjoin('units', 'units.id', '=', 'inventory_items.unit_id')
            ->leftjoin('brands', 'brands.id', '=', 'inventory_items.brand_id')
            ->leftjoin('categories', 'categories.id', '=', 'inventory_items.category_id')
            ->get();




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
    public function getManageStockSplitedData(Request $request)
    {
        $type = $request->type;

        $models = InventoryItem::select('inventory_items.*', 'manage_stocks.stock', 'categories.category_name as categoryName', 'brands.brand_name as brandName', 'units.name as unitName')
            ->leftjoin('manage_stocks', 'manage_stocks.item_id', '=', 'inventory_items.id')
            ->leftjoin('units', 'units.id', '=', 'inventory_items.unit_id')
            ->leftjoin('brands', 'brands.id', '=', 'inventory_items.brand_id')
            ->leftjoin('categories', 'categories.id', '=', 'inventory_items.category_id');
        if ($type == "activeData") {
            $models->where('inventory_items.status', 1);
        } elseif ($type == "inActiveData") {
            $models->where('inventory_items.status', 1);
        } elseif ($type == "Availability") {
            $models->whereColumn('inventory_items.limit', '<=', 'manage_stocks.stock');       
        } elseif ($type == "Demand") {
            $models->where('inventory_items.limit', '>=', 'manage_stocks.stock');
        }

        $datas = $models->get();
        dd($datas);
    }
}
