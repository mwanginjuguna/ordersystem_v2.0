<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // all
        return Inertia::render('Admin/Discounts', [
            'discounts' => Discount::all()
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
        // save after validation
        Discount::create(
            $request->validate([
                'code' => 'required',
                'rate' => 'required',
                'days_active' => 'required',
            ])
        );

        return redirect()->route('admin.discounts')->with("success", "Added Successfully");
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
        Discount::findOrFail($id)
            ->delete();

        return redirect()->route('admin.discounts')->with("success", "Removed Successfully");
    }
}
