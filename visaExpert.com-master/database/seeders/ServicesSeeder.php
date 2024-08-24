<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::updateOrCreate([
            'title' => 'Indian Tourist Visa Processing',
            'agent_amount' => 1000,
            'customer_amount' => 1500,
        ]);

        Service::updateOrCreate([
            'title' => 'Indian Medical Visa Processing',
            'agent_amount' => 2000,
            'customer_amount' => 2500,
        ]);

        Service::updateOrCreate([
            'title' => 'Passport Making',
            'agent_amount' => 10000,
            'customer_amount' => 15000,
            'description' => '7 days Passport delivery with Police Verification.',
        ]);

        Service::updateOrCreate([
            'title' => 'Passport Renewal',
            'agent_amount' => 12000,
            'customer_amount' => 18000,
            'description' => '7 days Passport delivery with Police Verification.',
        ]);
    }
}
