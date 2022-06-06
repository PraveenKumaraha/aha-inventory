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
        $models = Category::whereNull('deleted_at')->orderby('id','desc')->get();
        return view('Category.index',compact('models'));    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Category();
        $model->name =$request->name;
        $model->status="1";
        $model->save();
        return redirect()
        ->route('category.index')
        ->withStatus('Category Successfully Created.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CategoryController  $categoryController
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryController $categoryController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CategoryController  $categoryController
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Category = Category::where('id',$id)->first();
       
        return view('Category.edit', compact('Category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CategoryController  $categoryController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = Category::where('id',$id)->first();
        $model->name =$request->name;
        $model->update();
        return redirect()
        ->route('category.index')
        ->withStatus('Category Successfully Upated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CategoryController  $categoryController
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model=Category::where('id' ,$id)->first();
        $model->deleted_at=date('Y-m-d H:i:s');

        $model->save();
        return redirect()->route('category.index');
    }
}
