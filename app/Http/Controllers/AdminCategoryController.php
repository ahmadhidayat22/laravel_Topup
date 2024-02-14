<?php

namespace App\Http\Controllers;

use App\Models\Kategory;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use \Cviebrock\EloquentSluggable\Services\SlugService;


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

        $validate = $request->validate([
            'category_name' => 'required',
            
          ]);
        $slug = $this->checkSlug($validate);
        $kategory = new Kategory();
        $kategory->category_name = $validate['category_name'];
        $kategory->slug = $slug;
        $kategory->save();
       
        // $validate = $request->validate([
        //     'category_name' => 'required',
            
        // ]);
        

        return redirect('/admin/category')->with('success', 'New category has been created');

    }
  
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategory  $kategory
     * @return \Illuminate\Http\Response
     */
    public function show($slug) :view
    { 
        $getKategory = Kategory::where('slug','=', $slug)->first();
        // ddd($getKategory);
        return view('admin.category.edit', [
            'category' => $getKategory
        ]);
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kategory  $kategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Kategory $kategory,Request $request)
    {
        // dd($request);
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
        $validate = $request->validate([
            'category_name' => 'required'
        ]);
        // $validate['category'] = $request->category;
        
        $category = kategory::where('slug', $request->slug)->first();
        // dd($category);
        $slug = $this->checkSlug($validate);
        $category->category_name = $validate['category_name'];
        $category->slug = $slug;

        $category->save($validate);
        return redirect('/admin/category')->with('success', 'The category has been Updated');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategory  $kategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {   

        $isNotEmpety = product::where('fk_category', $id)->first();
        if ($isNotEmpety && $request->isConfirmed == 'false') {
            // jika kategori terdapat produk maka tampilkan warning
            return response()->json(['warning' => 'Terdapat produk pada kategori ini, ingin menghapus semua produk tersebut?']);

        }elseif($isNotEmpety && $request->isConfirm == 'true'){
            // jika kategori yang terdapat produk telah di confirm untuk dihapus semua produk 
            $products = product::where('fk_category', $id)->get();
            $ids = array();
            foreach ($products as $i => $pd){
                $ids[$i] = $pd->id;
            }
            product::destroy($ids);
            Kategory::destroy($id);

            return response()->json(['succes' => 'berhasil dihapus semua produk']);
        }
        else{

            Kategory::destroy($id);

            return response()->json(['succes' => 'berhasil dihapus kategori tanpa produk']);

        }

        // $isEmpty = product::where('fk_category', $id)->first();
        // if($isEmpty){
        //     return redirect('/admin/category')->with('warning', 'The category has product');


        // }
        

        // Kategory::destroy($id);

        // return redirect('/admin/category')->with('success', 'The category has been Deleted');

    }

    function checkSlug($request)
    {
        
        $slug = SlugService::createSlug(Kategory::class, 'slug', $request['category_name']);
        return $slug;
    }
    
}
