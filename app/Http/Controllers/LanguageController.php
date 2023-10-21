<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // all languages
        return Inertia::render('Admin/Languages', [
            'languages' => Language::all()
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
        Language::create(
            $request->validate([
                'name' => 'required'
            ])
        );

        return redirect()->route('admin.languages')->with("success", "Added Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        // delete record
        Language::findOrFail($id)->delete();
        return redirect()->route('admin.languages')->with("success", "Removed Successfully");
    }
}
