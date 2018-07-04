<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Pronostic;

class PronosticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $pronostics = Pronostic::all();
        return view('index_pronostic', compact('pronostics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add_pronostic');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Pronostic::create($request->all());
        return redirect()->route('pronostic.index')->with('ok',__('Le pronostic a bien été enregistré.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'Show id '.$id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Pronostic $pronostic)
    {
        return view('edit_pronostic', compact('pronostic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pronostic $pronostic)
    {
        $pronostic->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pronostic $pronostic)
    {
        $pronostic->delete();

        return redirect()->route('pronostic.index');
    }
}
