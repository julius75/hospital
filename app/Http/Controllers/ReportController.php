<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
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


    public function getReport(){
        $department = request('department');

        $report = DB::table('reports')
            ->join('patients', 'patients.id', '=', 'reports.patient_id')
            ->select('patients.patient_name','reports.*')
            ->where('reports.department','=',$department)
            ->orderBy('reports.created_at','ASC')
            ->get();
        return response()->json($report);
    }
    public function search(Request $request){
        $search = $request->get('q');
        $department = request('department');

        $report =  DB::table('reports')
            ->join('patients', 'patients.id', '=', 'reports.patient_id')
            ->select('patients.patient_name','reports.*')
            ->where('reports.department','=',$department)
            ->orderBy('reports.created_at','ASC')
            ->where('patients.patient_name','like','%'.$search.'%')
            ->get();
        return response()->json($report);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $report = new Report();
        $report->patient_id = $request->get('patientID');
        $report->department = $request->get('department');
        $report->notes = $request->get('notes');
        $report->medical_practitioner = auth()->user()->name;
        $report->save();


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        //
    }
}
