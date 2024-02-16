<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use App\Models\product_details;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        
        $code = $this->generateUniqueCode(product::select('id')->where('slug',$request->slug)->first());
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
        $product_detail->product_sku = $code;

        $product_detail->save();
        
        return redirect('/admin/product')->with('success', 'New variant has been created');


    }
    function generateUniqueCode($prefix){
        // ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $charactersNumber = strlen($characters);
        $codeLength = 5;
        $prefixId= $prefix->id;
        $firstChar = $characters[$prefixId % $charactersNumber ];
        
        $code = '';
      
        $c = DB::table('skucode_generate')->select('code');
        // $timestamp = Carbon::now()->timestamp;
            
        while (strlen($code) < $codeLength) {
            $position = rand(0, $charactersNumber - 1);
            
            $character = $characters[$position];
            $code = $code.$character;
        }  
        // foreach($c->get() as $q){
        //     if($q->code == $code){
        //         return  'sama' ;
        //     }
        // }
        // DB::table('skucode_generate')->insert([
        //     'code'          => $code ,
        //     'date_generate' => Carbon::now()->format('Y-m-d'),
        //     'created_at'    => Carbon::now(),
        //     'updated_at'    => Carbon::now()
        // ]);
          
        return $firstChar . $code ;

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
    public function update(Request $request)
    {

        $idProduct = $request->id;
        $validateData= $request->validate([
            'product_denom' => 'required',
            'product_type' => 'required',
            'product_buyer_price' => 'required'
        ]);
        $number = $request->product_buyer_price;
        $split = explode('.',$number);
        $numRes = implode('', $split);

        $product = product_details::where('id' , $idProduct)->first();
        $product->product_denom = $validateData['product_denom'];
        $product->product_type = $validateData['product_type'];
        $product->product_buyer_price =  $numRes ;
        $product->save();

        // dd($request);
        
        // return response()->json($product);
        return response()->json(['message' => 'a variant has been updated']);
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
