<?php

namespace App\Http\Controllers\Hospital;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Hospital\Doctor;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;

class DoctorController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $specializations = [
            'Allergy and immunology',
            'Anesthesiology',
            'Dermatology',
            'Diagnostic radiology',
            'Emergency medicine',
            'Family medicine',
            'Internal medicine',
            'Medical genetics',
            'Neurology',
            'Nuclear medicine',
            'Obstetrics and gynecology',
            'Ophthalmology',
            'Pathology',
            'Pediatrics',
            'Physical medicine and rehabilitation',
            'Preventive medicine',
            'Psychiatry',
            'Radiation oncology',
            'Surgery',
            'Urology'
        ];

        return view('hospital/add_doctor', ['specializations' => $specializations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(UserRequest $request)
    {
        $user = new User($request->all());
        $user->save();


        if(isset($user)) {
            $id = User::where('email', $request->email)->first();
            $doctor = new Doctor(['user_id' => $id->id, 'specialization' => $request->specialization]);
            $doctor->save();
        }
        else{
            return back()->withErrors(['msg' => 'Saving error'])->withInput();
        }

        return redirect('home');
    }

}
