<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Kategory;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;


class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() : view
    {
        $product = product::all();
        return view('admin.products.index' , [
            'product' => $product
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): view
    {
        return view('admin.products.create', [
            'category' => Kategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, product $product)
    {
        $rules = [
            'nama' => 'required|max:255',
            'category' => 'required',
            'deskripsi' => 'required',
            // 'picture' => 'required|image|file|max:1024',
            'developer' => 'required'
           

        ];
        if($request->slug != $product->slug){
            $rules['slug']= 'required|unique:products';
        }

        
        if($request->gambar == ''){
            $rules['gambar'] = 'none';
        }
        
        
        // if($request->file('image')) //cek jika ada image baru
        // {
            //     if($request->oldImage){
                //         Storage::delete($request->oldImage);
                //     }
                //     $validateData['image'] = $request->file('image')->store('post-images');;
                // }
                
        $validateData =$request->validate($rules);
        
        product::create($validateData);

        return redirect('/admin/product')->with('success', 'New product has been created');
        // dd($request);
                // return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        //
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(product::class, 'slug', $request->title);
        
        return response()->json(['slug' => $slug]);
    }
}
