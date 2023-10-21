<?php

namespace App\Http\Controllers;

use App\Models\WriterCategory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WriterCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // get all
        return Inertia::render('Admin/Writers', [
            'writerCategories' => WriterCategory::all()
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
        WriterCategory::create(
            $request->validate([
                'name' => 'required',
                'rate' => 'required',
                'description' => 'required'
            ])
        );

        return redirect()->route('admin.writer_categories')->with('success', 'Added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        // delete
        WriterCategory::findOrFail($id)
            ->delete();

        return redirect()->route('admin.writer_categories')->with('success', 'Removed successfully');
    }
}
