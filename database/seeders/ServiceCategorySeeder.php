<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class ServiceCategorySeeder extends Seeder
{
    public function run()
    {
        // Ovdje možete specificirati broj kategorija koje želite generisati
        ServiceCategory::factory(10)->create();
    }
}
