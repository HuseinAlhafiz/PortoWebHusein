<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Visit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        $stats = [
            'total' => Portfolio::count(),
            'featured' => Portfolio::where('is_featured', true)->count(),
            'categories' => Portfolio::distinct('category')->count('category'),
        ];

        // Visit analytics
        $visitStats = [
            'total' => Visit::count(),
            'today' => Visit::whereDate('created_at', today())->count(),
            'unique' => Visit::distinct('ip_address')->count('ip_address'),
            'thisWeek' => Visit::where('created_at', '>=', now()->startOfWeek())->count(),
            'thisMonth' => Visit::where('created_at', '>=', now()->startOfMonth())->count(),
        ];

        // Daily visits chart (last 7 days)
        $dailyVisits = [];
        $maxDaily = 1;
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $count = Visit::whereDate('created_at', $date)->count();
            $dailyVisits[] = [
                'day' => $date->format('D'),
                'date' => $date->format('d M'),
                'count' => $count,
            ];
            if ($count > $maxDaily)
                $maxDaily = $count;
        }

        // Device stats
        $allVisits = Visit::all();
        $deviceStats = [
            'desktop' => $allVisits->filter(fn($v) => $v->device === 'Desktop')->count(),
            'mobile' => $allVisits->filter(fn($v) => $v->device === 'Mobile')->count(),
            'tablet' => $allVisits->filter(fn($v) => $v->device === 'Tablet')->count(),
        ];

        // Browser stats
        $browserStats = $allVisits->groupBy(fn($v) => $v->browser)->map->count()->sortDesc()->take(5);

        // Recent visitors
        $recentVisits = Visit::orderBy('created_at', 'desc')->limit(15)->get();

        return view('dashboard.index', compact(
            'portfolios',
            'stats',
            'visitStats',
            'dailyVisits',
            'maxDaily',
            'deviceStats',
            'browserStats',
            'recentVisits'
        ));
    }
}