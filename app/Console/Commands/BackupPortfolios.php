<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Portfolio;
use Illuminate\Support\Facades\File;

class BackupPortfolios extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'portfolio:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup manually inputted portfolios to PortfolioSeeder so they survive migrate:fresh';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $portfolios = Portfolio::where('type', '!=', 'techstack')->get();

        if ($portfolios->isEmpty()) {
            $this->info('No portfolios found to backup. Add some via dashboard first.');
            return;
        }

        $arrayCode = "[\n";
        foreach ($portfolios as $p) {
            $arrayCode .= "            [\n";
            $arrayCode .= "                'type' => " . var_export($p->type, true) . ",\n";
            $arrayCode .= "                'title' => " . var_export($p->title, true) . ",\n";
            $arrayCode .= "                'description' => " . var_export($p->description, true) . ",\n";
            $arrayCode .= "                'category' => " . var_export($p->category, true) . ",\n";
            $arrayCode .= "                'image' => " . var_export($p->image, true) . ",\n";
            $arrayCode .= "                'link' => " . var_export($p->link, true) . ",\n";
            $arrayCode .= "                'github_link' => " . var_export($p->github_link, true) . ",\n";
            $arrayCode .= "                'features' => " . var_export($p->features, true) . ",\n";
            $arrayCode .= "                'tech_stack' => " . var_export($p->tech_stack, true) . ",\n";
            $arrayCode .= "                'is_featured' => " . var_export($p->is_featured, true) . ",\n";
            $arrayCode .= "                'sort_order' => " . var_export($p->sort_order, true) . ",\n";
            $arrayCode .= "            ],\n";
        }
        $arrayCode .= "        ]";

        $seederContent = <<<EOT
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
        \$portfolios = {$arrayCode};

        // Clear existing non-techstack portfolios
        Portfolio::where('type', '!=', 'techstack')->delete();

        foreach (\$portfolios as \$item) {
            Portfolio::create(\$item);
        }
    }
}
EOT;

        File::put(database_path('seeders/PortfolioSeeder.php'), $seederContent);

        $this->info('Successfully backed up ' . $portfolios->count() . ' portfolios to database/seeders/PortfolioSeeder.php!');
        $this->info('Make sure PortfolioSeeder is called in your DatabaseSeeder.php.');
    }
}
