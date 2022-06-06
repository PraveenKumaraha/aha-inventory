<?php

namespace App\Http\Controllers;

use App\Pass;
use Illuminate\Http\Request;

class PassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mods = Pass::whereNull('deleted_at')->orderby('id','desc')->get();
        return view('Pass.index',compact('mods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('Pass.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mod = New Pass();
        $mod->name = $request->name;
        $mod->status ="1";
        $mod->save();
        return redirect()
        ->route('pass.index')
        ->withStatus('Pass successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pass  $pass
     * @return \Illuminate\Http\Response
     */
    public function show(Pass $pass)
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
        $Pass = Pass::where('id',$id)->first();

        return view('Pass.edit', compact('Pass'));
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
        $mod = Pass::where('id',$id)->first();
        $mod->name = $request->name;
        $mod->save();
        return redirect()
        ->route('pass.index')
        ->withStatus('Pass successfully Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pass  $pass
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mod = Pass::where('id',$id)->first();
        $mod->deleted_at=date('Y-m-d H:i:s');

        $mod->save();
        return redirect()->route('pass.index');
    }
}
