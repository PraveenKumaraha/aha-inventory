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
        $models = Supplier::whereNull('deleted_at')->orderby('supplier_id', 'desc')->get();
        return view('Supplier.index', compact('models'));
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
        $validatedData = $request->validate([

            'supplier_id' => 'required|unique:suppliers|max:255',
            'supplier_contact' =>'required|unique:suppliers|max:255',

        ]);
        $model = new Supplier();
        $model->supplier_id = $request->supplier_id;
        $model->supplier_name = $request->supplier_name;
        $model->supplier_email = $request->supplier_email;
        $model->supplier_contact = $request->supplier_contact;
        $model->supplier_address = $request->supplier_address;
        $model->supplier_status = "1";
        $model->save();
        return redirect()
            ->route('supplier.index')
            ->withStatus('supplier successfully created.');
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
        $model = Supplier::where('id', $id)->first();

        return view('Supplier.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = Supplier::where('id', $id)->first();
        $model->supplier_id = $request->supplier_id;
        $model->supplier_name = $request->supplier_name;
        $model->supplier_email = $request->supplier_email;
        $model->supplier_contact = $request->supplier_contact;
        $model->supplier_address = $request->supplier_address;
        $model->supplier_status = "1";
        $model->save();
        return redirect()
            ->route('supplier.index')
            ->withStatus('supplier successfully created.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mod = Supplier::where('id', $id)->first();
        $mod->deleted_at = date('Y-m-d H:i:s');

        $mod->save();
        return redirect()->route('supplier.index');
    }

    public function getSupplierSplitedData(Request $request)
    {

        $models = Supplier::select('*')->whereNull('deleted_at')->orderby('id', 'desc');
        if ($request->type == "activeData") {
            $models->where('supplier_status', 1);
        } else if ($request->type == "inActiveData") {
            $models->where('supplier_status', 0);
        }
        $datas = $models->get();

        return response()->json(array('result' => "success", 'data' => $datas));
    }
    public function changeStatus(Request $request)
    {
       
        $brand = Supplier::find($request->id)->update(['supplier_status' => $request->status]);

        return response()->json(['success'=>'Status changed successfully.']);
    }
}
