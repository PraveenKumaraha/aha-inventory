<?php

namespace App\Http\Controllers\Master;

use App\ItemReturnType;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ItemReturnTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = ItemReturnType::whereNull('deleted_at')->orderby('id', 'desc')->get();

        return view('Masters.ItemReturnType.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Masters.ItemReturnType.create');
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
            'name' => 'required|unique:item_return_types|max:255',

        ]);


        $model = new ItemReturnType();
        $model->name = $request->name;
        $model->status = "1";
        $model->active = "1";

        
        $model->save();
        return redirect()
            ->route('itemReturnType.index')
            ->withStatus('Item Return Type successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItemReturnType  $itemReturnType
     * @return \Illuminate\Http\Response
     */
    public function show(ItemReturnType $itemReturnType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemReturnType  $itemReturnType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = ItemReturnType::where('id', $id)->first();

        return view('Masters.ItemReturnType.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemReturnType  $itemReturnType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = ItemReturnType::where('id', $id) ->first();
        $model->name = $request->name;
        $model->update();

        return redirect()
            ->route('itemReturnType.index')
            ->withStatus('Item Return Type successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItemReturnType  $itemReturnType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = ItemReturnType::where('id', $id)->first();
        $model->deleted_at = date('Y-m-d H:i:s');

        $model->save();
        return redirect()->route('itemReturnType.index');
    }
    public function getItemReturnTypeData(Request $request)
    {
        $models = ItemReturnType::select('*')->whereNull('deleted_at')->orderby('id', 'desc');
        if ($request->type == "activeData") {
            $models->where('status', 1);
        }else if ($request->type == 'inActiveData') {
            $models->where('status', 0);
        }
        $datas = $models->get();

        return response()->json(array('result' => "success", 'data' => $datas));
    }
}

