<?php

namespace App\Http\Controllers;

use App\InventoryItem;
use App\Purchase;
use App\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Purchase::select('purchases.*', 'suppliers.supplier_id as supplierId')
        ->leftjoin('suppliers', 'suppliers.id','=','purchases.supplier_id')
        ->whereNull('purchases.deleted_at')->orderby('purchases.id', 'desc')
        ->get();

        return view('Purchase.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pdtproductIds = InventoryItem::select('product_id', 'id')->get();
        $pdtsupplierIds = Supplier::select('supplier_id','id')->get();

        return view('Purchase.create', compact('pdtproductIds','pdtsupplierIds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Purchase();
        $model->supplier_id = $request->supplier_id;
        $model->item_id = $request->item_id;
        $model->quantity = $request->quantity;
        $model->barcode = $request->barcode;
        $model->status = "1";

        $model->save();
        return redirect()
          ->route('purchase.index')
          ->withStatus('Purchase Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $model = Purchase::where('id', $id)->first();
        $pdtproductIds = InventoryItem::select('product_id', 'id')->where('status', 1)->get();
        $pdtsupplierIds = Supplier::select('supplier_id','id')->where('supplier_status', 1)->get();

        return view('Purchase.edit', compact('model','pdtproductIds', 'pdtsupplierIds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = Purchase::where('id', $id)->first();
        $model->supplier_id = $request->supplier_id;
        $model->item_id = $request->item_id;
        $model->quantity = $request->quantity;
        $model->barcode = $request->barcode;
        $model->status = "1";

        $model->save();
        return redirect()
          ->route('purchase.index')
          ->withStatus('Purchase Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Purchase::where('id', $id)->first();
        $model->deleted_at = date('Y-m-d H:i:s');

        $model->save();
        return redirect()->route('purchase.index');

    }
}
