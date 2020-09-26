<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Sales;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::factory(10)->create();

        $sales = Sales::create([
            'amount' => $products->sum('sale_price'),
            'profit' => $products->sum('sale_price') - $products->sum('price')
        ]);

        $sales->products()->sync($products->pluck('id'));

    }
}
