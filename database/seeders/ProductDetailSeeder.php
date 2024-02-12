<?php

namespace Database\Seeders;

use App\Models\product_details;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = file_get_contents(base_path('/database/product_detail.json'));

        $data = json_decode($path, true);

        product_details::insert($data);
    }
}
