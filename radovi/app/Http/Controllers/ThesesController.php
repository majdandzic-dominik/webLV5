<?php

namespace App\Http\Controllers;

use App\Models\Thesis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThesesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //ovisno o useru odaberi koju listu saljes natrag i naravno user id saljes?
        $user = User::findOrFail(Auth::id());

        //ako admin dohvati sve korisnike
        if ($user->isAdmin) {
            $user_list = User::all()->except(Auth::id());
        } else {
            $user_list = null;
        }

        //ako ucitelj dohvati sve diplomske koje je napravio taj ucitelj
        if ($user->isTeacher) {
            $theses = Thesis::where('created_by_user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        } else {
            $theses = null;
        }

        //ako student dohvati sve teme na koje se prijavio i sve na koje nije
        if ($user->isStudent) {
            $applied_theses = $user->applied_theses()->get();
            $not_applied_theses = Thesis::all();
        } else {
            $applied_theses = null;
            $not_applied_theses = null;
        }
        return view('home', compact('theses', 'user', 'user_list', 'applied_theses', 'not_applied_theses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add_thesis');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title_cro' => 'required|string',
            'title_eng' => 'required|string',
            'description' => 'nullable|string',
            'study_type' => 'nullable|string',
        ]);

        $thesis = new Thesis();
        $thesis->title_cro = $request->input('title_cro');
        $thesis->title_eng = $request->input('title_eng');
        $thesis->description = $request->input('description');
        $thesis->study_type = $request->input('study_type');

        $thesis->created_by_user_id = Auth::user()->id;

        $thesis->save();

        return redirect()->route('thesis.index')->with('success', 'Thesis created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $thesis = Thesis::where('id', $id)->where('created_by_user_id', Auth::user()->id)->first();
        if (!$thesis) {
            abort(404);
        }
        return view('delete_thesis', compact('thesis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $thesis = Thesis::where('id', $id)->where('created_by_user_id', Auth::user()->id)->first();
        if (!$thesis) {
            abort(404);
        }
        return view('edit_thesis', compact('thesis'));
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
        $this->validate($request, [
            'title_cro' => 'required|string',
            'title_eng' => 'required|string',
            'description' => 'nullable|string',
            'study_type' => 'nullable|string',
        ]);

        $thesis = $thesis = Thesis::where('id', $id)->where('created_by_user_id', Auth::user()->id)->first();
        if (!$thesis) {
            abort(404);
        }
        $thesis->title_cro = $request->input('title_cro');
        $thesis->title_eng = $request->input('title_eng');
        $thesis->description = $request->input('description');
        $thesis->study_type = $request->input('study_type');


        $thesis->save();

        return redirect()->route('thesis.index')->with('success', 'Thesis updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $thesis = Thesis::where('id', $id)->where('created_by_user_id', Auth::user()->id)->first();
        if (!$thesis) {
            abort(404);
        }
        $thesis->delete();

        return redirect()->route('thesis.index')->with('success', 'Item delted successfully');
    }




    //user list part ------------------------------------
    public function edit_user($id)
    {
        $user = User::findOrFail($id);
        return view('edit_user', compact('user'));
    }

    public function update_user(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->has('isTeacher')) {
            $user->isTeacher = true;
        } else {
            $user->isTeacher = false;
        }

        if ($request->has('isStudent')) {
            $user->isStudent = true;
        } else {
            $user->isStudent = false;
        }

        $user->save();
        return redirect()->route('thesis.index')->with('success', 'User updated successfully');
    }

    public function make_admin()
    {
        return view('make_admin');
    }

    public function confirm_make_admin()
    {
        $user = User::findOrFail(Auth::id());

        $user->isAdmin = true;

        $user->save();

        return redirect()->route('thesis.index')->with('success', 'User updated successfully');
    }




    //student application part ----------------------------------------
    public function apply_thesis($id)
    {
        $thesis = Thesis::findOrFail($id);
        return view('apply_thesis', compact('thesis'));
    }

    public function confirm_thesis_application($id)
    {
        $thesis = Thesis::findOrFail($id);
        $user = User::findOrFail(Auth::id());

        $thesis->applied_users()->sync($user->id);

        return redirect()->route('thesis.index')->with('success', 'Applied to thesis successfully');
    }

    public function delete_thesis_application($id)
    {
        $thesis = Thesis::findOrFail($id);
        return view('delete_thesis_application', compact('thesis'));
    }

    public function confirm_thesis_deletion($id)
    {
        $thesis = Thesis::findOrFail($id);
        $user = User::findOrFail(Auth::id());

        $thesis->applied_users()->detach($user->id);
        return redirect()->route('thesis.index')->with('success', 'User updated successfully');
    }
}
