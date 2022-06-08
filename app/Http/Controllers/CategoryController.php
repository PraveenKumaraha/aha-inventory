<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Category::whereNull('deleted_at')->orderby('id', 'desc')->get();
        return view('Masters.Category.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Masters.Category.create');
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

            'category_name' => 'required|unique:categories|max:255',

        ]);
        $model = new Category();
        $model->category_name = $request->category_name;
        $model->category_status = "1";
        $model->category_active = "1";
        $model->save();
        return redirect()
            ->route('category.index')
            ->withStatus('Category successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Category::where('id', $id)->first();

        return view('Masters.Category.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = Category::where('id', $id)->first();
        $model->category_name = $request->category_name;
        $model->save();
        return redirect()
            ->route('category.index')
            ->withStatus('Category successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mod = Category::where('id', $id)->first();
        $mod->deleted_at = date('Y-m-d H:i:s');

        $mod->save();
        return redirect()->route('category.index');
    }
    public function getCategorySplitedData(Request $request)
    {

        $models = Category::select('*')->whereNull('deleted_at')->orderby('id', 'desc');
        if ($request->type == "activeData") {
            $models->where('category_status', 1);
        } else if ($request->type == "inActiveData") {
            $models->where('category_status', 0);
        }
        $datas = $models->get();

        return response()->json(array('result' => "success", 'data' => $datas));
    }
}
