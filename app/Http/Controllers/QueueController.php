<?php

namespace App\Http\Controllers;

use App\Models\Queue;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueueController extends Controller
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

    public function getDepartmentQueue(){
        $department = request('name');
        $patientQueue = DB::table('queues')
            ->join('patients', 'patients.id', '=', 'queues.patient_id')
            ->select('patients.name','patients.contact','queues.*')
            ->where('queues.department','=',$department)
            ->orderBy('queues.created_at','ASC')
            ->get();
        return response()->json($patientQueue);
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
        $arr = json_decode(json_encode($request->getContent('patient_id','dep')),true);
        $patient_id = $arr['patient_id'];
        $dep = $arr['dep'];

        foreach($dep as $k){

            print_r($k);

        }
        foreach($patient_id as $a){

            print_r($a);

        }
        foreach($dep as $k){
            foreach($patient_id as $id){
                $queue = new Queue();
                $queue->patient_id = $id;
                $queue->department = $k['department'];
                $queue->save();


                $visit = new Visit();
                $visit->patient_id =$id;
                $visit->status = "session";
                $visit->save();

            }
        }




    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function show(Queue $queue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function edit(Queue $queue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Queue $queue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Queue $queue)
    {
        //
    }
}
