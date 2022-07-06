<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\TransactionType;
use Illuminate\Http\Request;

class TransactionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = TransactionType::where('deleted_at')->orderby('id','desc')->get();

        return view('TransactionType.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('TransactionType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new TransactionType();
        $model->transaction_type_name = $request->transaction_type_name;
        $model->gen_no = $request->gen_no;
        $model->gen_name = $request->gen_name;
        $model->status = '1';
       
        $model->save();
        return redirect()
            ->route('transactionType.index')
            ->withStatus('TransactionType successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TransactionType  $transactionType
     * @return \Illuminate\Http\Response
     */
    public function show(TransactionType $transactionType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TransactionType  $transactionType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = TransactionType::where('id',$id)->first();

        return view('TransactionType.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TransactionType  $transactionType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = TransactionType::where('id', $id)->first();
        $model->transaction_type_name = $request->transaction_type_name;
        $model->gen_no = $request->gen_no;
        $model->gen_name = $request->gen_name;
        
        $model->update();
        return redirect()
            ->route('transactionType.index')
            ->withStatus('TransactionType successfully Upated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TransactionType  $transactionType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $model=TransactionType::where('id',$id)->first();
       $model->deleted_at=date('Y-m-d H:i:s');

       $model->save();
       return redirect()->route('transactionType.index');
    }

    public function getTransactionTypeSplitedData(Request $request)
    {
        $models = TransactionType::select('*')->whereNull('deleted_at')->orderby('id', 'desc');
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
       
        $transactionType = TransactionType::find($request->id)->update(['status' => $request->status]);

        return response()->json(['success'=>'Status changed successfully.']);
    }
}
