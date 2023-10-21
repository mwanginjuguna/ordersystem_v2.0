<?php

namespace App\Http\Controllers;

use App\Models\ReferencingStyle;
use App\Models\Spacing;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReferencingStyleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // all styles
        return Inertia::render('Admin/StylesAndSpacing', [
            'styles' => ReferencingStyle::all(),
            'spacings' => Spacing::all()
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
        ReferencingStyle::create(
            $request->validate([
                'name' => 'required',
                'rate' => 'required'
            ])
        );
        return redirect()->route('admin.styles')->with('success', 'Added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // delete from db
        ReferencingStyle::findOrFail($id)
            ->delete();
        return redirect()->route('admin.styles')->with('success', 'Removed successfully');
    }
}
