<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use App\Models\product_details;
use Illuminate\Contracts\View\View;


class AdminProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {
        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        $rules = $request->validate([
        'product_denom' => 'required',
        'product_type' => 'required',
        'product_buyer_price' => 'required',
        ]);
        $number = $request->product_buyer_price;
        $split = explode('.',$number);
        $numRes = implode('', $split);
        
        $product = product::where('slug',$request->slug)->first();

        $product_detail = new product_details;
        $product_detail->id_product = $product->id;
        $product_detail->product_name = $product->nama;
        $product_detail->product_denom = $rules['product_denom'];
        $product_detail->product_type = $rules['product_type'];
        $product_detail->product_seller_price = 0;
        $product_detail->product_buyer_price =  $numRes;
        $product_detail->product_status_seller = 'off';
        $product_detail->product_status_buyer = 'off';


        $product_detail->save();
        
        return redirect('/admin/product')->with('success', 'New variant has been created');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product_details  $product_details
     * @return \Illuminate\Http\Response
     */
    public function show(product_details $product_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product_details  $product_details
     * @return \Illuminate\Http\Response
     */
    public function edit(product_details $product_details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product_details  $product_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product_details $product_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product_details  $product_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(product_details $product_details)
    {
        //
    }
}
