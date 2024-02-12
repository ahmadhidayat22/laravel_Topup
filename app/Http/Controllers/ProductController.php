<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Kategory;
use App\Models\product_details;
use App\Models\product_pasca;
use App\Models\product_prepaid;
use \Cviebrock\EloquentSluggable\Services\SlugService;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;

class ProductController extends Controller
{
    public function test()
    {
        $test =  product_prepaid::where('id', 4)->value('product_name');
        // $test = $test;
        // $product = [];
        // foreach ($test as $ts){
        //     $name = Str::lower($ts->product_name);
        //     $brand = Str::lower($ts->product_provider);
        //     preg_match('/'.$brand.'/',$name, $matches);

        //     $product[]=[
        //         'name' => $name,
        //         'pattern'=>$brand,
        //         'jumlah' => $matches
                
        //     ];
           
        // }
        // foreach($test as $tst){
        //     echo $tst['product_name'];

        // }
        echo $test;
        // dd($test);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): view
    {
        return view('/home' , [
            "product" => product::all(),
            'category' => kategory::all(),
        
        ]);
        // $product = [];
        // $users = DB::table('product_prepaids')
        //                     ->select('product_category',DB::raw('MAX(id_category) AS nama_kategori'), DB::raw('MAX(product_provider) AS kategori_name ') )
        //                     ->groupBy('product_category')
        //                     ->get();

        // $product_prepaid = DB::table('Kategories')
                            
        //                     ->join('product_prepaids' , 'Kategories.id' , '=', 'product_prepaids.id_category')
        //                    ->select( DB::raw('MAX(id_category) AS id_kategori'),DB::raw('MAX(product_category) AS kategori'), DB::raw('MAX(product_provider) AS nama_produk ') , )
        //                    ->groupBy('product_provider')
                            
        //                     ->get();
       
        // // $gabungan = DB::table('Kategories')
                    
        // //             ->joinSub($users, 'product_prepaids', function (JoinClause $join) {
        // //                 $join->on('Kategories.id' , '=', 'product_prepaids.id_category');
        // //             })
        // //             ->select()
        // //             ->get();
       

        // $product_pasca = DB::table('Kategories')
        //                     ->join('product_pascas' , 'Kategories.id' , '=', 'product_pascas.id_category')
        //                     ->select( DB::raw('MAX(id_category) AS id_kategori'),DB::raw('MAX(product_category) AS kategori'), DB::raw('MAX(product_provider) AS nama_produk ') , )
        //                     ->groupBy('product_category')
                             
        //                     ->get();
        
        
                            
        // foreach($product_prepaid as $pp){
            
        //    $product[] = $pp;
        // }
        // foreach($product_pasca as $pp){
        //     $product[] = $pp;
        // }
        
        // // $product = $product_pasca::raw('select distinct * from '); 
        // // $product = array_map("unserialize", array_unique(array_map("serialize", $product)));
        // // for($i = 0; $i < count($product); $i++){
        // //    ddd($product[$i]);
        // // }
        // // $items= count($product);
        // ddd( $product_pasca );

       

    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($data)
    {
        dd($data);
   

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($request) : view
    {
        $products = DB::table('products')
                            
                            ->where('slug', '=', $request)
                            ->get();
        $id = $products[0]->id;
        $product_detail = product_details::where('id_product', $id)->get();
       
        $data = product::all();
        
        // dd($products);

        // product_pasca::where('id_product',  $id)->get() ;
        // if($product_detail->isEmpty() ){
        //     $product_detail = product_pasca::where('id_product',  $id)
        //                     ->get();
        //     // echo 'kosong';
        // }
                    
       
        
        return view('/product',[
            'product' => $products,
            'product_detail' => $product_detail
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function get_produk(Request $request){
       try{
        $produk = product::where('category', 'like', '%' .$request->parameter. '%')->get();
        $data= [];
        foreach($produk as $prd){
            $data[]= [
                'nama' =>$prd->nama,
                'slug' =>$prd->slug,
                'provider' =>$prd->developer,
            ];
        }

        return response()->json($data);
    }catch (\Exception $th){
        return response()->json([
            'success' => false,
            'message' => 'Data Fetch Failed',
            'data'    => []
        ]);
    }
      
        
    }
}
