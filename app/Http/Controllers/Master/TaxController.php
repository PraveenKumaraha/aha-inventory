<?php

namespace App\Http\Controllers\Master;

use App\Tax;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $models = Tax::whereNull('deleted_at')->orderby('id', 'desc')->get();

        return view('Masters.Tax.index',compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Masters.Tax.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Tax();
        $model->tax_name=$request->tax_name;
        $model->tax_value=$request->tax_value;
        $model->tax_status='1';
        $model->tax_active='1'; 
        $model->save();
        return redirect()
            ->route('tax.index')
            ->withStatus('Tax successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function show(Tax $tax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Tax::where('id',$id)->first();

        return view('Masters.Tax.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = Tax::where('id', $id)->first();
        $model ->tax_name = $request->tax_name;
        $model->tax_value = $request->tax_value;
        $model->update();
        return redirect()
            ->route('tax.index')
            ->withStatus('Tax successfully Update.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Tax::where('id', $id)->first();
        $model->deleted_at = date('Y-m-d H:i:s');

        $model->save();
        return redirect()->route('tax.index');
    }
    public function getTaxSplitedData(Request $request)
    {
        $models = Tax::select('*')->whereNull('deleted_at')->orderby('id', 'desc');
        if ($request->type == "activeData") {
            $models->where('tax_status', 1);
        } else if ($request->type == "inActiveData") {
            $models->where('tax_status', 0);
        }
        $datas = $models->get();

        return response()->json(array('result' => "success", 'data' => $datas));
    }
    public function changeStatus(Request $request)
    {
        $tax = Tax::find($request->id)->update(['tax_status' => $request->status]);

        return response()->json(['success'=>'Status Changed successfully.']);
    }
}
