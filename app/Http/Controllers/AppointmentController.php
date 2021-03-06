<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\User;
use App\Appointment;
use App\Setting;
use \Response;
use Cookie;
use View;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Redirect;
class AppointmentController extends Controller
{

	public function __construct(){
        $this->middleware('auth');
    }
    //  the create function returns the appointment's create page with the list of patients

    public function index($id){

        $appointment=Appointment::all()->where('id',$id);
        $Patient=User::all()->where('role','patient')->where('id',$appointment[0]->user_id);


        return view('appointment.view',['patient'=>$Patient,'appointment'=>$appointment[0]]);

    }


    public function create(Request $request){

        $patients = User::where('role','patient')->get();

        $selected=$_COOKIE['selected'] ?? '';
        \Cookie::queue(\Cookie::forget('selected'));
        if($selected){
            return view('appointment.create', ['patients' => $patients,"selected"=>$selected]);        
        }
        
	    return view('appointment.create', ['patients' => $patients]);
    }

    public function redi(Request $request,$res){
        setcookie('selected',$res);
       return redirect()->route('appointment.create');
    }

    // ???
    public function checkslots($date){

    	return $this->getTimeSlot($date);
    }

    // ??? 
    public function available_slot($date,$start,$end){

    	$check = Appointment::where('date',$date)->where('time_start', $start)->where('time_end', $end)->count();
    	if($check == 0){
        	return 'available';
    	}else{
        	return 'unavailable';
    	}
    }

    //???
    public function getTimeSlot($date) {

    $day = date("l", strtotime($date));
  	$day_from =  strtolower($day.'_from');
  	$day_to =  strtolower($day.'_to');

    $start = Setting::get_option($day_from);
    $end = Setting::get_option($day_to);
    $interval = Setting::get_option('appointment_interval');

    $start = new DateTime($start);
    $end = new DateTime($end);
    $start_time = $start->format('H:i'); // Get time Format in Hour and minutes
    $end_time = $end->format('H:i');

    $i=0;
    $time = [];	
    while(strtotime($start_time) <= strtotime($end_time)){
        $start = $start_time;
        $end = date('H:i',strtotime('+'.$interval.' minutes',strtotime($start_time)));
        $start_time = date('H:i',strtotime('+'.$interval.' minutes',strtotime($start_time)));
        $i++;
        if(strtotime($start_time) <= strtotime($end_time)){
            $time[$i]['start'] = $start;
            $time[$i]['end'] = $end;
            $time[$i]['available'] = $this->available_slot($date ,$start,$end);
        }
    }

    return $time;
	
	}


    // Storing the  the Appointment
	public function store(Request $request){

		$validatedData = $request->validate([
        	'patient' => ['required','exists:users,id'],
            'rdv_time_date' => ['required'],
            'rdv_time_start' => ['required'],
            'rdv_time_end' => ['required'],

    	]);

    	$appointment = new Appointment();
		$appointment->user_id = $request->patient;
		$appointment->date = $request->rdv_time_date;
		$appointment->time_start = $request->rdv_time_start;
		$appointment->time_end = $request->rdv_time_end;
		$appointment->visited = 0;
		$appointment->save();

		return Redirect::back()->with('success', 'Appointment Created Successfully!');

	}

    //Edit the Appointment
    public function store_edit(Request $request){

        $validatedData = $request->validate([
            'appointment_id' => ['required','exists:appointments,id'],
            'Appointment_Date'=>['required'],
            'Appointment_Start'=>['required'],
            'Appointment_End'=>['required']
        ]);

        $appointment = Appointment::findOrFail($request->appointment_id);
        $appointment->date = $request->Appointment_Date;
        $appointment->time_start = $request->Appointment_Start;
        $appointment->time_end = $request->Appointment_End;
        $appointment->save();

        return Redirect::back()->with('success', 'Appointment Updated Successfully!');
    }



    public function Status_edit(Request $request){
       $validatedData = $request->validate([
            'rdv_id' => ['required','exists:appointments,id'],
            'rdv_status' => ['required','numeric'],
        ]);

        $appointment = Appointment::findOrFail($request->rdv_id);
        $appointment->visited = $request->rdv_status;
        $appointment->save();

        return Redirect::back()->with('success', 'Appointment Updated Successfully!');
    }

	public function all(Request $request){
		$appointments = Appointment::all();

		return view('appointment.all', ['appointments' => $appointments]);
	}

    public function AppointmentApi(Request $request){
        $appointments=Appointment::all();

        session()->put("data",$appointments);
    }


    public function destroy(Request $request){
        $id=$request->all()['appointment_id'];
        Appointment::destroy($id);
        return Redirect::route('appointment.all')->with('success', 'Appointment Deleted Successfully!');

    }


}
