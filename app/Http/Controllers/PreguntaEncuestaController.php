<?php

namespace App\Http\Controllers;

use App\Models\PreguntaEncuesta;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePreguntaEncuestaRequest;
use App\Http\Requests\UpdatePreguntaEncuestaRequest;

class PreguntaEncuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePreguntaEncuestaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePreguntaEncuestaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PreguntaEncuesta  $preguntaEncuesta
     * @return \Illuminate\Http\Response
     */
    public function show(PreguntaEncuesta $preguntaEncuesta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PreguntaEncuesta  $preguntaEncuesta
     * @return \Illuminate\Http\Response
     */
    public function edit(PreguntaEncuesta $preguntaEncuesta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePreguntaEncuestaRequest  $request
     * @param  \App\Models\PreguntaEncuesta  $preguntaEncuesta
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePreguntaEncuestaRequest $request, PreguntaEncuesta $preguntaEncuesta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PreguntaEncuesta  $preguntaEncuesta
     * @return \Illuminate\Http\Response
     */
    public function destroy(PreguntaEncuesta $preguntaEncuesta)
    {
        //
    }
}
