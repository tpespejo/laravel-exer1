<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
       // Factory::factory(App\Models\Product::class, 10)->create();
        \App\Models\Product::factory()->count(10)->create(); 
        \App\Models\Product::factory(30)->create();
        
    }
}
