<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        //
        return Inertia::render('Admin/Currencies', [
            'currencies' => Currency::all()
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
        // validate -> save
        Currency::create(
            $request->validate([
                'name' => 'required',
                'symbol' => 'required',
                'rate' => 'required'
            ])
        );

        return redirect()->route('admin.currencies')->with("success", "Added successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        // delete
        Currency::findOrFail($id)
            ->delete();

        return redirect()->route('admin.currencies')->with("success", "Removed successfully");
    }
}
