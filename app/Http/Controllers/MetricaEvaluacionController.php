<?php

namespace App\Http\Controllers;

use App\Models\MetricaEvaluacion;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMetricaEvaluacionRequest;
use App\Http\Requests\UpdateMetricaEvaluacionRequest;

class MetricaEvaluacionController extends Controller
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
     * @param  \App\Http\Requests\StoreMetricaEvaluacionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMetricaEvaluacionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MetricaEvaluacion  $metricaEvaluacion
     * @return \Illuminate\Http\Response
     */
    public function show(MetricaEvaluacion $metricaEvaluacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MetricaEvaluacion  $metricaEvaluacion
     * @return \Illuminate\Http\Response
     */
    public function edit(MetricaEvaluacion $metricaEvaluacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMetricaEvaluacionRequest  $request
     * @param  \App\Models\MetricaEvaluacion  $metricaEvaluacion
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMetricaEvaluacionRequest $request, MetricaEvaluacion $metricaEvaluacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MetricaEvaluacion  $metricaEvaluacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(MetricaEvaluacion $metricaEvaluacion)
    {
        //
    }
}
