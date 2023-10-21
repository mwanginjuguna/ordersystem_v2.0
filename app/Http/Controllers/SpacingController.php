<?php

namespace App\Http\Controllers;

use App\Models\ReferencingStyle;
use App\Models\Spacing;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SpacingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // all line spacings
        return Inertia::render('Admin/StylesAndSpacing', [
            'spacings'=> Spacing::all(),
            'styles' => ReferencingStyle::all()
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
        Spacing::create($request->validate([
            'name' => 'required',
            'rate' => 'required'
        ]));

        return redirect()->route('admin.spacings')->with("success", 'saved successesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // delete resource
        Spacing::findOrFail($id)
            ->delete();
        return redirect()->route('admin.spacings')->with("success", 'Removed successesfully');
    }
}
