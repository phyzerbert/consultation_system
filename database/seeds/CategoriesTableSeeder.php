<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => "Statutory Bank Branch Audit"]);
        Category::create(['name' => "Statutory Audit Corporate"]);
        Category::create(['name' => "Statutory Audit Co-op Banks "]);
        Category::create(['name' => "Tax Audit Corporate"]);
        Category::create(['name' => "Tax Audit Banks"]);
        Category::create(['name' => "Tax Audit Co-op Banks"]);
        Category::create(['name' => "Tax Audit Individual"]);
        Category::create(['name' => "Internal Audit Banks"]);
        Category::create(['name' => "Concurrent Audit Banks"]);
        Category::create(['name' => "Internal Corporate Audit"]);
        Category::create(['name' => "Revenue Audit"]);
        Category::create(['name' => "Stock Audit"]);
        Category::create(['name' => "Forensic Audit"]);
        Category::create(['name' => "Income Tax Matters  "]);
        Category::create(['name' => "GST"]);
        Category::create(['name' => "NBFC"]);
        Category::create(['name' => "TDS on Foreign Remittances"]);
    }
}
