<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PortfolioController;
use App\Models\Portfolio;
use App\Models\Visit;
use Illuminate\Support\Facades\Route;

// Public
Route::get('/', function () {
    // Track visitor
    Visit::create([
        'ip_address' => request()->ip(),
        'user_agent' => request()->userAgent(),
        'page' => '/',
        'referrer' => request()->headers->get('referer'),
    ]);

    $projects = Portfolio::where('type', 'project')->orderBy('sort_order')->orderBy('created_at', 'desc')->get();
    $certificates = Portfolio::where('type', 'certificate')->orderBy('sort_order')->orderBy('created_at', 'desc')->get();
    $techstacks = Portfolio::where('type', 'techstack')->orderBy('sort_order')->orderBy('created_at', 'desc')->get();
    $allPortfolios = Portfolio::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
    return view('home', compact('projects', 'certificates', 'techstacks', 'allPortfolios'));
});

// Public Project Detail
Route::get('/project/{portfolio}', [PortfolioController::class, 'publicShow'])->name('project.show');

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard (protected)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/portfolio/create', [PortfolioController::class, 'create'])->name('portfolio.create');
    Route::post('/dashboard/portfolio', [PortfolioController::class, 'store'])->name('portfolio.store');
    Route::get('/dashboard/portfolio/{portfolio}', [PortfolioController::class, 'show'])->name('portfolio.show');
    Route::get('/dashboard/portfolio/{portfolio}/edit', [PortfolioController::class, 'edit'])->name('portfolio.edit');
    Route::put('/dashboard/portfolio/{portfolio}', [PortfolioController::class, 'update'])->name('portfolio.update');
    Route::delete('/dashboard/portfolio/{portfolio}', [PortfolioController::class, 'destroy'])->name('portfolio.destroy');
    Route::post('/dashboard/portfolio/backup', [PortfolioController::class, 'backup'])->name('portfolio.backup');
});
