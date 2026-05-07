<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $portfolios = [
        ];

        // Clear existing non-techstack portfolios
        Portfolio::where('type', '!=', 'techstack')->delete();

        foreach ($portfolios as $item) {
            Portfolio::create($item);
        }
    }
}
