<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models =Unit::whereNull('deleted_at')->orderby('id','desc')->get();

        return view('Masters.Unit.index',compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Masters.Unit.create');
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
            'name' => 'required|unique:units|max:255',
        ]);

        $model = new Unit();
        $model->name=$request->name;
        $model->status="1";
        $model->unit_active = "1";
        $model->save();
        return redirect()
        ->route('unit.index')
        ->withStatus('Unit Successfully Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Unit::where('id',$id)->first();

        return view('Masters.Unit.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $model= Unit::where('id',$id)->first();
        $model->name=$request->name;
        $model->update();
        return redirect()
        ->route('unit.index')
        ->withStatus('Unit Successfully Upated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model=Unit::where('id',$id)->first();
        $model->deleted_at=date('Y-m-d H:i:s');

        $model->save();
        return redirect()->route('unit.index');
    }

    public function getUnitSplitedData(Request $request)
    {

        $models = Unit::select('*')->whereNull('deleted_at')->orderby('id', 'desc');
        if ($request->type == "activeData") {
            $models->where('status', 1);
        } else if ($request->type == "inActiveData") {
            $models->where('status', 0);
        }
        $datas = $models->get();

        return response()->json(array('result' => "success", 'data' => $datas));
    }
}
