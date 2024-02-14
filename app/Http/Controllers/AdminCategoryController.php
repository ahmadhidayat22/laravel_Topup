<?php

namespace App\Http\Controllers;

use App\Models\Kategory;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;

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
    public function create() : view
    {
        return view('admin.category.create' , [
            'category' => Kategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Kategory $category)
    {
        // masih eror bagian slug gak ke insert
        $validate = $request->validate([
            'category_name' => 'required',
          ]);
          
          $kategory = new Kategory();
          $kategory->category_name = $validate['category_name'];
          $kategory->slug = Str::slug($request->category_name);

        //   dd($kategory->slug);
        
          $kategory->save();

       
        // $validate = $request->validate([
        //     'category_name' => 'required',
            
        // ]);
        // if($validate){
            
        //     // $validate['slug'] = Str::slug($request->category_name);
            
        //     Kategory::create([
        //         'category_name' => $request->category_name,
        //         'slug' => Str::slug($request->category_name)
        //     ]);
        // }

        // ddd($validate);
        
        
        // dd($request);


        return redirect('/admin/category')->with('success', 'New category has been created');

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
