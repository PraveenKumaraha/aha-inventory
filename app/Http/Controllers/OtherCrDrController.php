<?php

namespace App\Http\Controllers;

use App\OtherCrDr;
use Illuminate\Http\Request;

class OtherCrDrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $models = OtherCrDr::whereNull('deleted_at')->orderby('id', 'desc')->get();

        return view('OtherCr/Dr.index',compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('OtherCr/Dr.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new OtherCrDr();
        $model->transaction = $request->transaction;
        $model->detail = $request->detail;
        $model->amount = $request->amount;
        $model->type = $request->type;
        $model->status ='1';

        $model->save();
        return redirect()
            ->route('otherCrDr.index')   
            ->withStatus('OtherCrDr successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OtherCrDr  $otherCrDr
     * @return \Illuminate\Http\Response
     */
    public function show(OtherCrDr $otherCrDr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OtherCrDr  $otherCrDr
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = OtherCrDr::where('id', $id)->first();

        return view('OtherCr/Dr.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OtherCrDr  $otherCrDr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = OtherCrDr::where('id', $id)->first();
        $model->transaction = $request->transaction;
        $model->detail = $request->detail;
        $model->amount = $request->amount;
        $model->type = $request->type;
        $model->status ='1';

        $model->update();
        return redirect()
            ->route('otherCrDr.index')   
            ->withStatus('OtherCrDr successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OtherCrDr  $otherCrDr
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = OtherCrDr::where('id', $id)->first();
        $model->delete_at = date('Y-m-d H:i:s');

        $model->save();
        return redirect()->route('otherCrDr.index');
    }
    public function getOtherCrDrTypeData(Request $request)
    {
        $models = OtherCrDr::select('*')->whereNull('deleted_at')->orderby('id', 'desc');
        if ($request->type == "activeData") {
            $models->where('status', 1);
        } else if ($request->type == "inActiveData") {
            $models->where('status', 0);
        }
        $datas = $models->get();

        return response()->json(array('result' => "success", 'data' => $datas));
    }
    public function changeStatus(Request $request)
    {
       
        $otherCrDr = OtherCrDr::find($request->id)->update(['status' => $request->status]);

        return response()->json(['success'=>'Status changed successfully.']);
    } 
}
