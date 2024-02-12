<?php

namespace App\Http\Controllers;

use App\Models\Kategory;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;


class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : view
    {
        return view('admin.category.index', [
            'category' => Kategory::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategory  $kategory
     * @return \Illuminate\Http\Response
     */
    public function show(Kategory $kategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategory  $kategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategory $kategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kategory  $kategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategory $kategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategory  $kategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategory $kategory)
    {
        //
    }
}
