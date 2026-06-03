<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Portfolio;

$experiences = [
    [
        'type' => 'experience',
        'title' => 'BPMP (Balai Penjaminan Mutu Pendidikan)',
        'description' => 'Pranata Komputer Intern - Magang Kemenaker Batch II | Nov 2025 - May 2026',
        'category' => 'Work',
        'features' => [
            'Managed internal project workflows at BPMP, including task coordination, timeline monitoring, documentation, and stakeholder collaboration to ensure projects aligned with objectives.',
            'Performed data analysis using Microsoft Excel and Google Colab (Python) by cleaning, transforming, and analyzing datasets to produce structured reports and actionable insights for evaluation and decision-making.'
        ],
        'image' => 'kemdikbud.png',
        'sort_order' => 1
    ],
    [
        'type' => 'experience',
        'title' => 'Kemdikbudristek',
        'description' => 'Project Management Officer IT (Contract) | Jul 2024 - Feb 2025',
        'category' => 'Work',
        'features' => [
            'Coordinated 12+ fullstack features across 3 national programs: PDP, PDPV, and PIRT-UM.',
            'Designed 15+ UI screens and landing pages in Figma, aligned with established design system.',
            'Executed black-box testing with 30+ manual test cases to ensure production readiness.'
        ],
        'image' => 'kemdikbud.png',
        'sort_order' => 2
    ],
    [
        'type' => 'experience',
        'title' => 'Kemdikbudristek',
        'description' => 'Technical Writer Intern - MSIB Batch 6 | Jan 2024 - Jul 2024',
        'category' => 'Work',
        'features' => [
            'Created 10+ structured documentation sections in GitBook, including setup guides, feature overviews, QA reports, and project notes.',
            'Collaborated with UI/UX, fullstack development, and QA teams to ensure clarity and consistency across all documentation.',
            'Delivered weekly progress reports and presented final documentation during the stakeholder demo session at the end of the program.'
        ],
        'image' => 'kemdikbud.png',
        'sort_order' => 3
    ],
    [
        'type' => 'experience',
        'title' => 'FIKTI Comparative Study',
        'description' => 'Project Officer | Dec 2022 - Apr 2023',
        'category' => 'Organization',
        'features' => [
            'Led 4 divisions (19 members) and executed 3 events attended by 100+ participants.',
            'Initiated intercampus collaboration with BEM UPNVJ within 2 months.'
        ],
        'image' => 'gunadarma.png',
        'sort_order' => 4
    ],
    [
        'type' => 'experience',
        'title' => 'BEM FIKTI Gunadarma',
        'description' => 'Public Relations Staff | Oct 2022 - Oct 2023',
        'category' => 'Organization',
        'features' => [
            'Managed social media with 173K+ impressions and increased engagement by 35%.',
            'Reduced crisis response time by 50% through improved coordination and response strategy.'
        ],
        'image' => 'gunadarma.png',
        'sort_order' => 5
    ]
];

$educations = [
    [
        'type' => 'education',
        'title' => 'SMAN 2 Depok',
        'description' => 'SMA',
        'category' => 'School',
        'image' => 'sman2depok.png',
        'sort_order' => 1
    ],
    [
        'type' => 'education',
        'title' => 'Universitas Gunadarma',
        'description' => 'S1 Sistem Informasi',
        'category' => 'Degree',
        'image' => 'gunadarma.png',
        'sort_order' => 2
    ],
    [
        'type' => 'education',
        'title' => 'Kemdikbudristek',
        'description' => 'MSIB',
        'category' => 'Degree',
        'image' => 'kemdikbud.png',
        'sort_order' => 3
    ],
    [
        'type' => 'education',
        'title' => 'Mknows Consulting',
        'description' => 'Bootcamp',
        'category' => 'School',
        'image' => 'bootcamp-logo.png',
        'sort_order' => 4
    ]
];

foreach (array_merge($experiences, $educations) as $item) {
    if (Portfolio::where('title', $item['title'])->where('type', $item['type'])->count() == 0) {
        Portfolio::create($item);
        echo "Created: {$item['title']}\n";
    } else {
        echo "Skipped: {$item['title']} (already exists)\n";
    }
}
