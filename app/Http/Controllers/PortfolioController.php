<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        return view('dashboard.portfolios.index', compact('portfolios'));
    }

    public function backup()
    {
        \Illuminate\Support\Facades\Artisan::call('portfolio:backup');
        return redirect()->route('dashboard')->with('success', 'Data portofolio berhasil dibackup ke Seeder!');
    }

    public function create()
    {
        return view('dashboard.portfolios.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:project,certificate,techstack,blog,experience,education',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:100',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,pdf|max:10240',
            'link' => 'nullable|url|max:255',
            'github_link' => 'nullable|url|max:255',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string|max:255',
            'tech_stack' => 'nullable|array',
            'tech_stack.*' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
            'created_at' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('portfolios', 'public');
        }

        if (!$request->filled('created_at')) {
            unset($validated['created_at']);
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = $request->input('sort_order', 0);

        // Clean empty values from arrays
        if (isset($validated['features'])) {
            $validated['features'] = array_values(array_filter($validated['features']));
        }
        if (isset($validated['tech_stack'])) {
            $validated['tech_stack'] = array_values(array_filter($validated['tech_stack']));
        }

        Portfolio::create($validated);

        return redirect()->route('dashboard')->with('success', 'Portfolio berhasil ditambahkan!');
    }

    public function show(Portfolio $portfolio)
    {
        return view('dashboard.portfolios.show', compact('portfolio'));
    }

    public function publicShow(Portfolio $portfolio)
    {
        return view('project.show', compact('portfolio'));
    }

    public function edit(Portfolio $portfolio)
    {
        return view('dashboard.portfolios.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'type' => 'required|in:project,certificate,techstack,blog,experience,education',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:100',
            'image' => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,pdf|max:10240',
            'link' => 'nullable|url|max:255',
            'github_link' => 'nullable|url|max:255',
            'features' => 'nullable|array',
            'features.*' => 'nullable|string|max:255',
            'tech_stack' => 'nullable|array',
            'tech_stack.*' => 'nullable|string|max:255',
            'is_featured' => 'boolean',
            'sort_order' => 'integer',
            'created_at' => 'nullable|date',
        ]);

        if ($request->hasFile('image')) {
            if ($portfolio->image) {
                Storage::disk('public')->delete($portfolio->image);
            }
            $validated['image'] = $request->file('image')->store('portfolios', 'public');
        }

        if (!$request->filled('created_at')) {
            unset($validated['created_at']);
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['sort_order'] = $request->input('sort_order', 0);

        // Clean empty values from arrays
        if (isset($validated['features'])) {
            $validated['features'] = array_values(array_filter($validated['features']));
        }
        if (isset($validated['tech_stack'])) {
            $validated['tech_stack'] = array_values(array_filter($validated['tech_stack']));
        }

        $portfolio->update($validated);

        return redirect()->route('dashboard')->with('success', 'Portfolio berhasil diperbarui!');
    }

    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->image) {
            Storage::disk('public')->delete($portfolio->image);
        }
        $portfolio->delete();

        return redirect()->route('dashboard')->with('success', 'Portfolio berhasil dihapus!');
    }
}
