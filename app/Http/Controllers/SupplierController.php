<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Supplier::whereNull('deleted_at')->orderby('id','desc')->get();

        return view('Supplier.index',compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $model = new Supplier();
        $model->supplier_name=$request->supplier_name;
        $model->supplier_id=$request->supplier_id;
        $model->supplier_email=$request->supplier_email;
        $model->supplier_phone=$request->supplier_phone;
        $model->supplier_adders=$request->supplier_adders;
        $model->save();
        return redirect()
        ->route('supplier.index')
        ->withStatus('Supplier Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Supplier = Supplier::where('id',$id)->first();

        return view('Supplier.edit', compact('Supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $model = Supplier::where('id',$id)->first();
        $model->supplier_name=$request->supplier_name;
        $model->supplier_id=$request->supplier_id;
        $model->supplier_email=$request->supplier_email;
        $model->supplier_phone=$request->supplier_phone;
        $model->supplier_adders=$request->supplier_adders;
        $model->save();
        return redirect()
        ->route('supplier.index')
        ->withStatus('Supplier Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Supplier::where('id',$id)->first();
        $model->deleted_at=date('Y-m-d H:i:s');

        $model->save();
        return redirect()->route('supplier.index');
    }
}
