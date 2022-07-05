<?php

namespace App\Http\Controllers\Master;


use App\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $models = Brand::whereNull('deleted_at')->orderby('id', 'desc')->get();

        return view('Masters.Brand.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Masters.Brand.create');
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
            'brand_name' => 'required|unique:brands|max:255',

        ]);

        $model = new Brand();
        $model->brand_name = $request->brand_name;
        $model->brand_status = "1";
        $model->brand_active = "1";
        $model->save();
        return redirect()
            ->route('brand.index')   
            ->withStatus('Brand successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pass  $pass
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pass  $pass
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $model = Brand::where('id', $id)->first();

        return view('Masters.Brand.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pass  $pass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $model = Brand::where('id', $id)->first();
        $model->brand_name = $request->brand_name;
        $model->save();
        return redirect()
            ->route('brand.index')
            ->withStatus('Brand successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pass  $pass
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $model = Brand::where('id', $id)->first();
        $model->deleted_at = date('Y-m-d H:i:s');

        $model->save();
        return redirect()->route('brand.index');
    }

    public function getBrandSplitedData(Request $request)
    {

        $models = Brand::select('*')->whereNull('deleted_at')->orderby('id', 'desc');
        if ($request->type == "activeData") {
            $models->where('brand_status', 1);
        } else if ($request->type == "inActiveData") {
            $models->where('brand_status', 0);
        }
        $datas = $models->get();

        return response()->json(array('result' => "success", 'data' => $datas));
    }
    public function changeStatus(Request $request)
    {
       
        $brand = Brand::find($request->id)->update(['brand_status' => $request->status]);

        return response()->json(['success'=>'Status changed successfully.']);
    }
}
