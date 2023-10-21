<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // all subjects
        return Inertia::render('Admin/Subjects', [
            'subjects' => Subject::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // validate and save to db
        Subject::create(
            $request->validate([
                'name' => 'required',
                'rate' => 'required'
            ])
        );
        return redirect()->route('admin.subjects')->with('success', "Subject Added");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // delete
        Subject::findOrFail($id)->delete();
        return redirect()->route('admin.subjects')->with('success', "Subject Deleted");
    }
}
