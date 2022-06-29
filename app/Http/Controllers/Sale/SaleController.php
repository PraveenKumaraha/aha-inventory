<?php

namespace App\Http\Controllers\Sale;

use App\Http\Controllers\Controller;
use App\Sale;
use Illuminate\Http\Request;
use App\InventoryItem;
use Illuminate\Support\Facades\Validator;
use App\Tax;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Sale.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $pdtproductIds = InventoryItem::select('product_id','product_name', 'id')->get();
        $pdttaxids = Tax::select('tax_name', 'tax_value', 'id')->get();

        return view('sale.create',compact('pdtproductIds','pdttaxids'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [];

        foreach($request->input('product_name') as $key => $value) {
            $rules["cname.{$key}"] = 'required';
            $rules["cnumber.{$key}"] = 'required';
            $rules["gstin.{$key}"] = 'required';
            $rules["date.{$key}"] = 'required';
            $rules["product_name.{$key}"] = 'required';
            $rules["rate.{$key}"] = 'required';
            $rules["qty.{$key}"] = 'required';
            $rules["tax.{$key}"] = 'required';
            $rules["disc.{$key}"] = 'required';
            $rules["total.{$key}"] = 'required';
        }


        $validator = Validator::make($request->all(), $rules);


        if ($validator) {


            foreach($request->input('product_name') as $key => $value) {

                $model=new sale();

                $model->cname = $request->get('cname');
                $model->cnumber = $request->get('cnumber');
                $model->gstin = $request->get('gstin');
                $model->date = $request->get('date');
                $model->product = $request->get('product_name');
                $model->rate = $request->get('rate');
                $model->qty = $request->get('qty');
                $model->tax =$request->get('tax');
                $model->disc =$request->get('disc');
                $model->total =$request->get('total');

                dd($model);

                $model->save();
            }


            return response()->json(['success'=>'done']);
        }
        else{

        return response()->json(['error'=>$validator->errors()->all()]);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
