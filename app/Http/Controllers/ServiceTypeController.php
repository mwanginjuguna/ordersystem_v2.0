<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // all services
        return Inertia::render('Admin/Services', [
            'services' => ServiceType::all()
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
        ServiceType::create(
            $request->validate([
                'name' => 'required',
                'rate' => 'required'
            ])
        );

        return redirect()->route('admin.services')->with('success', 'Service Type Added.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // delete record
        ServiceType::findOrFail($id)->delete();
        return redirect()->route('admin.services')->with('success', 'Service Type Removed.');
    }
}
