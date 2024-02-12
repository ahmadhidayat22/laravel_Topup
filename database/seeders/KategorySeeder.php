<?php

namespace Database\Seeders;

use App\Models\Kategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = file_get_contents(base_path('/database/kategori.json'));

        $data = json_decode($path, true);

        Kategory::insert($data);
    }
}
