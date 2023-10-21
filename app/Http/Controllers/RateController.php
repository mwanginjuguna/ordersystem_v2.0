<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // all rates/pricing
        return Inertia::render('Admin/Pricing', [
            'rates' => Rate::all()
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
        Rate::create(
            $request->validate([
                'name' => 'required',
                'hours' => 'required',
                'amount' => 'required'
            ])
        );

        return redirect()->route('admin.pricings')->with("success", "Added successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        // delete record
        Rate::findOrFail($id)
            ->delete();

        return redirect()->route('admin.pricings')->with("success", "Removed successfully");
    }
}
