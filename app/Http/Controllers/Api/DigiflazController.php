<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;
use App\Models\Kategory;
use App\Models\product;
use App\Models\product_pasca;
use App\Models\product_prepaid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\DB;

class DigiflazController extends Controller
{
    protected $header = null;
    protected $url = null;
    protected $user = null;
    protected $key = null;
    protected $model = null;

    public function __construct()
    {
        $this->header = array(
            'Content-Type:application/json'
        );

        $this->url = env('DIGIFLAZ_URL');

        $this->user = env('DIGIFLAZ_USER');
        $this->key = env('DIGIFLAZ_DEV_KEY');
        $this->model = new product_prepaid();
        
    }
 
    public function get_saldo()
    {
     
        $response = Http::withHeaders([$this->header])->post($this->url . '/cek-saldo', [
            "cmd" => "deposit",
            "username"=> $this->user,
            "sign"=> md5($this->user . $this->key . "depo")
        ]);
        $data = json_decode($response->getBody(), true);

        return response()->json($data['data']);

    }
    public function get_product_prepaid()
    {
        $response = Http::withHeaders([$this->header])->post($this->url . '/price-list', [
            "cmd" => "prepaid",
            "username"=> $this->user,
            "sign"=> md5($this->user . $this->key . "pricelist")
        ]);
        $data = json_decode($response->getBody(), true);

        // $this->model->insert_data($data['data']);
        // return response()->json($data['data']);
        
        $produk = [];
        foreach($data['data'] as $dt){
            $produk[]= [
            'nama_dari_tabel' => product_prepaid::where('product_name' ,$dt['product_name'] )->value('product_name'),
            'nama_dari_digi' => $dt['product_name'],
            'sku_tabel' =>  product_prepaid::where('product_name' ,$dt['product_name'] )->value('product_sku'),
            'sku_digi' => $dt['buyer_sku_code'],
            'status' => (product_prepaid::where('product_name' ,$dt['product_name'] )->value('product_sku') == $dt['buyer_sku_code'] ? 'active' : 'not active')

            ];
        }

        dd($produk);

        // $this->insert_category($data['data']);
        // $this->insert_products($data['data']);
        // $this->insert_product_prepaid($data['data']);

        
    

    }

    public function get_product_pasca()
    {
        $response = Http::withHeaders([$this->header])->post($this->url . '/price-list', [
            "cmd" => "pasca",
            "username"=> $this->user,
            "sign"=> md5($this->user . $this->key . "pricelist")
        ]);
        $data = json_decode($response->getBody(), true);

        // $this->model->insert_data($data['data']);

        // return response()->json($data['data']);
        // dd($data['data']);

        // $Category = [];
       

        // foreach ($data['data'] as $result) {
        //     $Category[] = [
        //         'category_name' => $result['brand'],
               
        //     ];
          
            
        // }
        
        // $Category = array_map("unserialize", array_unique(array_map("serialize", $Category)));

        // Kategory::upsert($Category, [], ['category_name']); 


        $this->insert_category($data['data']);
        $this->insert_products($data['data']);
        $this->insert_product_pasca($data['data']);

      

    }

    public function insert_category($data){
        $Category = [];
        foreach ($data as $result) {
            $Category[] = [
                'category_name' => $result['category'],
               
            ];
        }
        $Category = array_map("unserialize", array_unique(array_map("serialize", $Category)));
        
        Kategory::upsert($Category, [], ['category_name']);
        
    }
    

    public function insert_products($data){
        $product = [];
        foreach ($data as $result) {
            $slug = SlugService::createSlug(product::class, 'slug', $result['brand']);
            $product[] = [
                'nama' => $result['brand'],
                'slug' => $slug,
                'category' => $result['category']
               
            ];
        }
        $product = array_map("unserialize", array_unique(array_map("serialize", $product)));
        product::upsert($product, [], ['nama','slug', 'category']);

    }
   

    public function insert_product_prepaid($data){
        
        $insertData = [];
            foreach ($data as $result) {
                $id_category = Kategory::where('category_name' ,$result['category'])->first();
                $id_product = product::where('nama' ,$result['brand'])->first();
               
                $insertData[] = [
                        'product_sku' => $result['buyer_sku_code'],
                        'product_name' => $result['product_name'],
                        'id_category' => $id_category->id,
                        'id_product' => $id_product->id,
                        'product_category' => $result['category'],
                        'product_desc' => $result['desc'],
                        'product_provider' => $result['brand'],
                        'product_type' =>  $result['type'],
                        'product_seller' => $result['seller_name'],
                        'product_seller_price' => $result['price'],
                        'product_buyer_price' => 0,
                        'product_unlimited_stock' => $result['unlimited_stock'] ? 'Ya' : 'Tidak',
                        'product_stock' => $result['stock'],
                        'product_multi' => $result['multi'] ? 'Ya' : 'Tidak',
                    ];
            }
                product_prepaid::upsert($insertData, ['product_sku'], [
                    'product_name',
                    'product_desc',
                    'product_category',
                    'product_provider',
                    'product_type',
                    'product_seller',
                    'product_seller_price',
                    'product_buyer_price',
                    'product_unlimited_stock',
                    'product_stock',
                    'product_multi'
                ]);
    }
    public function insert_product_pasca($data){
        
        $insertData = [];
            foreach ($data as $result) {
                $id_category = Kategory::where('category_name' ,$result['category'])->first();
                $id_product = product::where('nama' ,$result['brand'])->first();
                $insertData[] = [
                    'product_sku' => $result['buyer_sku_code'],
                    'product_name' => $result['product_name'],
                    'id_category' => $id_category->id,
                    'id_product' => $id_product->id,
                    'product_desc' => $result['desc'],
                    'product_category' => $result['category'],
                    'product_provider' => $result['brand'],
                    'product_seller' => $result['seller_name'],
                    'product_transaction_admin' => $result['admin'],
                    'product_transaction_fee' => $result['commission'],
                    'product_buyer_status' => $result['buyer_product_status'] ? 'ON' : 'OFF',
                    'product_seller_status' => $result['seller_product_status'] ? 'ON' : 'OFF',
                    ];
            }
                product_pasca::upsert($insertData, ['product_sku'], [
                    'product_name',
                    'product_desc',
                    'product_category',
                    'product_provider',
                    'product_seller',
                    'product_transaction_admin',
                    'product_transaction_fee',
                    'product_buyer_status',
                    'product_seller_status'
                ]);
    }
    
    // public function insert_products($data)
    // {

    //     $insertData= [];
    //     foreach ($data as $result) {
    //         $id = Kategory::where('category_name' ,$result['brand'])->first();
    //         $slug = SlugService::createSlug(product::class, 'slug', $result['brand']);
            
            
    //         $insertData[] = [
    //                 'nama' => $result['brand'],
    //                 'slug' => $slug,
    //             ];
    //     }
        
        


    //     $product = [];
    //     $product_prepaid = DB::table('product_prepaid')
                                    
    //                                 ->select(DB::raw('MAX(product_category) AS kategori'), DB::raw('MAX(product_provider) AS nama_produk ') , )
    //                                 ->groupBy('product_provider')
    //                                 ->get();

    //     $product_pasca = DB::table('Kategories')
                        
    //                         ->select(DB::raw('MAX(product_category) AS kategori'), DB::raw('MAX(product_provider) AS nama_produk ') , )
    //                         ->groupBy('product_category')
    //                         ->get();

    //     foreach($product_prepaid as $pp){
            
    //        $product[] = $pp;
    //     }
    //     foreach($product_pasca as $pp){
    //         $product[] = $pp;
    //     }

    //     for($i = 0; $i < count($product); $i++){
    //         $slug = SlugService::createSlug(product::class, 'slug', $product[$i]->nama_produk);
           
    //         echo $slug;
            
            
    //         $insertData[] = [
    //             'nama' => $product[$i]->nama_produk,
    //             'slug' => $slug,
    //             'category' => $product[$i]->kategori,
    //         ];
    //     }
    //     // foreach($product as $prd){
            
    //     //     $insertData[] = [
    //     //         'nama' => array_column($prd, 'category_name'),
    //     //         'category' => array_column($prd, 'category_name'),
                
    //     //     ];
        
    //     // }
    //     // $insertData = array_map("unserialize", array_unique(array_map("serialize", $insertData)));
    //     product::upsert($insertData, [], ['nama','slug','category']);

    // }

    

}
