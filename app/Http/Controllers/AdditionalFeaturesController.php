<?php

namespace App\Http\Controllers;

use App\Models\AdditionalFeatures;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdditionalFeaturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // all features
        return Inertia::render('Admin/Extras', [
            'extras' => AdditionalFeatures::all()
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
        // validate and save
        AdditionalFeatures::create(
            $request->validate([
                'name' => 'required',
                'description' => 'required|max:200',
                'rate'=> 'required'
            ])
        );

        return redirect()->route('admin.extras')->with('success', 'Added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // delete
        AdditionalFeatures::findOrFail($id)
            ->delete();

        return redirect()->route('admin.extras')->with('success', 'Removed successfully');
    }
}
