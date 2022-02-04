<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Appointment;
use App\Patient;
use App\User;

class AppointmentsApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments=Appointment::all();
        $patient=User::all()->where('role','patient');
        return response()->json(['appointments'=>$appointments,'patients'=>$patient]);
    }

    public function view($id){
         $appointment=Appointment::find($id);
        $Patient=User::where('role','patient')->where('id',$appointment->user_id)->first();
        $info=Patient::where('user_id',$appointment->user_id)->first();
        return response()->json(['appointment'=>$appointment,"patient"=>$Patient,'info'=>$info]);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
