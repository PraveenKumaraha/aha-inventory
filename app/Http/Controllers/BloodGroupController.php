<?php

namespace App\Http\Controllers;

use App\BloodGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BloodGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        
        $models = BloodGroup::whereNull('deleted_at')->orderby('id','desc')->get();
       
        return view('BloodGroup.index',compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('BloodGroup.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $model = New BloodGroup();
        $model->name = $request->name;
        $model->save();
        return redirect()
        ->route('bloodGroup.index')
        ->withStatus('BloodGroup successfully created.');
        }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\BloodGroup  $blood_group
     * @return \Illuminate\Http\Response
     */
    public function show(BloodGroup $BloodGroup)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BloodGroup  $blood_group
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)

    {
       
        $BloodGroup = BloodGroup::where('id',$id)->first();
       
        return view('BloodGroup.edit', compact('BloodGroup'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\$BloodGroup  $blood_group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id )
    {
        $model = BloodGroup::where('id',$id)->first();
        $model->name = $request->name;
        $model->save();
        return redirect()
        ->route('bloodGroup.index')
        ->withStatus('BloodGroup successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BloodGroupp  $blood_group
     * @return \Illuminate\Http\Response
     */
    public function destroy(BloodGroup $BloodGroup,$id)
    {
       

        $model = BloodGroup::where('id',$id)->first();
        $model->deleted_at=date('Y-m-d H:i:s');

        $model->save();
        return redirect()->route('bloodGroup.index');
    }
}