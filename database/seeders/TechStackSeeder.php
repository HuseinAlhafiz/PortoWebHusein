<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Seeder;

class TechStackSeeder extends Seeder
{
    public function run(): void
    {
        $techStacks = [
            // Design Tools
            ['title' => 'Figma', 'category' => 'Tool', 'image' => 'portfolios/techstack/figma.svg', 'sort_order' => 1],
            ['title' => 'Canva', 'category' => 'Tool', 'image' => 'portfolios/techstack/canva.svg', 'sort_order' => 2],
            ['title' => 'Adobe Photoshop', 'category' => 'Tool', 'image' => 'portfolios/techstack/photoshop.svg', 'sort_order' => 3],

            // Languages
            ['title' => 'HTML', 'category' => 'Language', 'image' => 'portfolios/techstack/html.svg', 'sort_order' => 4],
            ['title' => 'CSS', 'category' => 'Language', 'image' => 'portfolios/techstack/css.svg', 'sort_order' => 5],
            ['title' => 'JavaScript', 'category' => 'Language', 'image' => 'portfolios/techstack/javascript.svg', 'sort_order' => 6],
            ['title' => 'PHP', 'category' => 'Language', 'image' => 'portfolios/techstack/php.svg', 'sort_order' => 7],
            ['title' => 'MySQL', 'category' => 'Language', 'image' => 'portfolios/techstack/mysql.svg', 'sort_order' => 8],

            // Frameworks
            ['title' => 'Laravel', 'category' => 'Framework', 'image' => 'portfolios/techstack/laravel.svg', 'sort_order' => 9],

            // PM & Collaboration Tools
            ['title' => 'Jira', 'category' => 'Tool', 'image' => 'portfolios/techstack/jira.svg', 'sort_order' => 10],
            ['title' => 'Trello', 'category' => 'Tool', 'image' => 'portfolios/techstack/trello.svg', 'sort_order' => 11],
            ['title' => 'Notion', 'category' => 'Tool', 'image' => 'portfolios/techstack/notion.svg', 'sort_order' => 12],
            ['title' => 'Slack', 'category' => 'Tool', 'image' => 'portfolios/techstack/slack.svg', 'sort_order' => 13],

            // Dev Tools
            ['title' => 'VS Code', 'category' => 'Tool', 'image' => 'portfolios/techstack/vscode.svg', 'sort_order' => 14],
            ['title' => 'Git', 'category' => 'Tool', 'image' => 'portfolios/techstack/git.svg', 'sort_order' => 15],
            ['title' => 'GitHub', 'category' => 'Tool', 'image' => 'portfolios/techstack/github.svg', 'sort_order' => 16],
            ['title' => 'Postman', 'category' => 'Tool', 'image' => 'portfolios/techstack/postman.svg', 'sort_order' => 17],
            ['title' => 'GitBook', 'category' => 'Tool', 'image' => 'portfolios/techstack/notion.svg', 'sort_order' => 18],
        ];

        // Clear existing tech stacks
        Portfolio::where('type', 'techstack')->delete();

        foreach ($techStacks as $stack) {
            Portfolio::create([
                'type' => 'techstack',
                'title' => $stack['title'],
                'description' => $stack['title'],
                'category' => $stack['category'],
                'image' => $stack['image'],
                'is_featured' => false,
                'sort_order' => $stack['sort_order'],
            ]);
        }
    }
}
