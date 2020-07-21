<?php

use Illuminate\Database\Seeder;

class StoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // pega todas as lojas
        $stores = \App\Store::all();

        // faz um loop
        foreach($stores as $store) {
            $store->products()->save(factory(\App\Product::class)->make());
        }
    }
}
