<?php

namespace App\Http\Controllers;

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
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        return view('home');
    }


    public function usersList()
    {
        $users = User::all();

        return response()->json($users);
    }

    public function users()
    {
        return view('test');
    }

    public function updateUser(Request $request)
    {
        $user = User::find($request->id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
    }

    public function deleteUser(Request $request)
    {
        $patient = Patient::where('user_id', $request->id)->first();
        $doctor = Doctor::where('user_id', $request->id)->first();

        if (!empty($patient))
        {
            $patient->delete();
        }
        if(!empty($doctor))
        {
            $doctor->delete();
        }

        $user = User::find($request->id);
        $user->delete();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('hospital/add_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $user = new User($request->all());

        if(isset($user)) {
            $user->save();
        }
        else{
            return back()->withErrors(['msg' => 'Saving error'])->withInput();
        }

        return redirect('home');
    }



    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

}
