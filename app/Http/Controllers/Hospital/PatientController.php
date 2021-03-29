<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Hospital\Doctor;
use App\Models\Hospital\Patient;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PatientController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $users = User::get();
        return view('hospital/add_patient', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $patient = Patient::find($request->patient);
        if(isset($patient))
        {
            return back()->withErrors(['msg' => 'This patient already exists!'])->withInput();
        }
        else{
            $patient = new Patient(['user_id' => $request->patient]);
            $patient->save();
            return redirect('home');
        }
    }


    public function makeAppointment(){
        $doctors = Doctor::all();
        $users = User::all();

        return response()->json(['doctors' => $doctors, 'users' => $users]);
    }


    public function saveAppointment(Request $request){

        $patient = Patient::where('user_id', $request->patient)->first();

        if(empty($patient)){
            $patient = new Patient(['user_id' => $request->patient]);
            $patient->save();
        }
        $appointment_time = $request->date . ' ' . $request->time;
        $patient->doctors()->attach($request->doctor['id'], ['appointment_time' => $appointment_time]);

    }


    public function makeAppointmentView(){
        return view('hospital/make_appointment');
    }

}
