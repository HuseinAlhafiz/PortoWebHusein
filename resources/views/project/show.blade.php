@extends('layouts.app')

@section('title', $portfolio->title . ' — Portfolio Detail')
@section('description', Str::limit($portfolio->description, 150))

@push('styles')
<style>
    /* Public Project Detail Styles */
    .project-detail-hero {
        padding: 8rem 3rem 4rem;
        min-height: 50vh;
        display: flex;
        align-items: center;
        border-bottom: 1px solid var(--border);
        background: radial-gradient(circle at top right, rgba(59,79,223,0.1), transparent 50%),
                    radial-gradient(circle at bottom left, rgba(124,58,237,0.1), transparent 50%);
    }

    .pd-container {
        max-width: 1200px;
        margin: 0 auto;
        width: 100%;
        position: relative;
        z-index: 2;
    }

    .pd-breadcrumb {
        display: flex; align-items: center; gap: 0.5rem;
        margin-bottom: 2rem; flex-wrap: wrap;
    }
    .pd-breadcrumb a {
        font-size: 0.82rem; font-weight: 500; color: var(--text-muted);
        transition: color 0.3s; display: inline-flex; align-items: center; gap: 0.3rem;
    }
    .pd-breadcrumb a:hover { color: var(--accent); }
    .pd-breadcrumb a svg { width: 16px; height: 16px; }
    .pd-breadcrumb .sep { color: var(--text-muted); font-size: 0.75rem; }
    .pd-breadcrumb .current { font-size: 0.82rem; font-weight: 600; color: var(--text-dim); }

    .pd-header {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
    }

    .pd-info { }
    
    .pd-badge {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 0.68rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: 1.5px; padding: 0.3rem 0.8rem; border-radius: 6px;
        margin-bottom: 1rem;
        background: rgba(255,255,255,0.05); color: var(--text-dim);
        border: 1px solid var(--border);
    }
    
    .pd-title {
        font-family: var(--font-display);
        font-size: 3rem; font-weight: 800; line-height: 1.1;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, #fff 0%, rgba(255,255,255,0.7) 100%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .pd-desc {
        font-size: 1rem; line-height: 1.8; color: var(--text-dim);
        margin-bottom: 2.5rem;
    }

    /* Actions */
    .pd-actions {
        display: flex; gap: 1rem; margin-bottom: 3rem; flex-wrap: wrap;
    }
    .btn-pd {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.8rem 1.5rem; border-radius: 12px;
        font-size: 0.88rem; font-weight: 600;
        font-family: var(--font); cursor: pointer; transition: all 0.3s;
        background: rgba(255,255,255,0.02); color: #fff;
        border: 1px solid rgba(255,255,255,0.08);
    }
    .btn-pd svg { width: 18px; height: 18px; color: #ef4444; }
    .btn-pd:hover { border-color: rgba(239, 68, 68, 0.5); background: rgba(239, 68, 68, 0.05); transform: translateY(-2px); }

    /* Meta Cards */
    .pd-meta-grid {
        display: flex; gap: 1rem; margin-top: 2rem;
    }
    .pd-meta {
        background: var(--bg-card); border: 1px solid var(--border);
        border-radius: 12px; padding: 1rem 1.5rem;
        flex: 1;
    }
    .pd-meta h4 { font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-bottom: 0.3rem; }
    .pd-meta p { font-family: var(--font-display); font-size: 1.2rem; font-weight: 700; color: var(--accent); }

    /* Right Preview Image */
    .pd-preview { position: relative; perspective: 1000px; }
    .pd-preview-card {
        background: var(--bg-card); border: 1px solid var(--border);
        border-radius: 24px; padding: 1.5rem;
        transform: rotateY(-5deg) rotateX(5deg);
        transition: transform 0.5s ease;
        box-shadow: -20px 20px 60px rgba(0,0,0,0.5);
    }
    .pd-preview:hover .pd-preview-card { transform: rotateY(0) rotateX(0); }
    .pd-preview-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; background: var(--gradient); border-radius: 24px 24px 0 0; }
    
    .window-controls { display: flex; gap: 6px; margin-bottom: 1.2rem; }
    .window-controls span { width: 10px; height: 10px; border-radius: 50%; }
    .window-controls span:nth-child(1) { background: #ef4444; }
    .window-controls span:nth-child(2) { background: #f59e0b; }
    .window-controls span:nth-child(3) { background: #10b981; }

    .pd-image {
        width: 100%; border-radius: 12px; overflow: hidden;
        border: 1px solid rgba(255,255,255,0.05);
        background: rgba(0,0,0,0.2); aspect-ratio: 16/9;
        display: flex; align-items: center; justify-content: center;
    }
    .pd-image img { width: 100%; height: 100%; object-fit: cover; }
    .pd-image svg { width: 60px; height: 60px; color: var(--text-muted); opacity: 0.3; }

    /* Content Section */
    .pd-content {
        padding: 5rem 3rem; background: var(--bg);
    }
    .pd-content-grid {
        display: grid; grid-template-columns: 2fr 1fr; gap: 4rem;
        max-width: 1200px; margin: 0 auto;
    }

    /* Summary Cards in Content */
    .pd-summary-cards {
        display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;
    }
    .summary-card {
        background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05);
        border-radius: 12px; padding: 1.2rem; display: flex; align-items: center; gap: 1rem;
        transition: all 0.3s;
    }
    .summary-card:hover { border-color: rgba(239, 68, 68, 0.3); background: rgba(255,255,255,0.05); }
    .sc-icon {
        width: 48px; height: 48px; border-radius: 12px;
        background: rgba(239, 68, 68, 0.05); color: #ef4444;
        display: flex; align-items: center; justify-content: center;
    }
    .sc-icon svg { width: 22px; height: 22px; }
    .sc-text {}
    .sc-text h4 { font-size: 1.4rem; font-weight: 700; color: #fff; line-height: 1.2; margin-bottom: 0.2rem; }
    .sc-text span { font-size: 0.75rem; color: var(--text-dim); }

    /* Left: Technologies */
    .pd-section-title {
        font-family: var(--font-display); font-size: 1.2rem; font-weight: 700;
        margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.6rem;
    }
    .pd-section-title svg { width: 22px; height: 22px; color: var(--text-dim); }
    
    .tech-pills {
        display: flex; flex-wrap: wrap; gap: 0.8rem; margin-bottom: 4rem;
    }
    .tech-pill {
        display: inline-flex; align-items: center; gap: 0.5rem;
        background: rgba(239, 68, 68, 0.05); border: 1px solid rgba(239, 68, 68, 0.15);
        padding: 0.5rem 1rem; border-radius: 30px; text-align: center;
        transition: all 0.3s; cursor: default;
    }
    .tech-pill:hover { border-color: rgba(239, 68, 68, 0.4); background: rgba(239, 68, 68, 0.1); transform: translateY(-2px); }
    .tech-pill span { font-size: 0.8rem; font-weight: 600; color: var(--text); }
    .tech-pill svg { width: 14px; height: 14px; color: #ef4444; }

    /* Right: Features */
    .features-box {
        background: var(--bg-card); border: 1px solid var(--border);
        border-radius: 20px; padding: 2rem; position: sticky; top: 100px;
    }
    .features-box .pd-section-title svg { color: #fbbf24; } /* yellow star */
    .feature-list { list-style: none; }
    .feature-list li {
        display: flex; align-items: flex-start; gap: 0.8rem;
        padding: 0.8rem 1rem; border-radius: 10px;
        font-size: 0.88rem; color: var(--text-dim); line-height: 1.6;
        transition: background 0.3s; cursor: default;
    }
    .feature-list li:hover { background: rgba(255,255,255,0.04); color: #fff; }
    .feature-list li::before {
        content: ''; width: 6px; height: 6px; flex-shrink: 0;
        background: #ef4444; border-radius: 50%;
        margin-top: 8px;
    }

    @media (max-width: 992px) {
        .pd-header { grid-template-columns: 1fr; gap: 3rem; }
        .pd-preview-card { transform: none; }
        .pd-content-grid { grid-template-columns: 1fr; }
        .features-box { position: static; }
    }
    @media (max-width: 768px) {
        .project-detail-hero { padding: 6rem 1.5rem 3rem; }
        .pd-title { font-size: 2.2rem; }
        .pd-meta-grid { flex-direction: column; }
        .pd-content { padding: 3rem 1.5rem; }
    }
</style>
@endpush

@section('content')
    @include('partials.navbar')

    <!-- Hero / Header -->
    <section class="project-detail-hero">
        <div class="pd-container">
            <div class="pd-breadcrumb">
                <a href="{{ url('/#portfolio') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                    Back to Portfolio
                </a>
                <span class="sep">›</span>
                <span class="current">{{ $portfolio->category }}</span>
            </div>

            <div class="pd-header">
                <!-- Info -->
                <div class="pd-info reveal visible">
                    <span class="pd-badge">{{ ucfirst($portfolio->type) }}</span>
                    <h1 class="pd-title">{{ $portfolio->title }}</h1>
                    <p class="pd-desc">{{ $portfolio->description ?? 'Tidak ada deskripsi untuk project ini.' }}</p>

                    <div class="pd-meta-grid">
                        <div class="pd-meta">
                            <h4>Date</h4>
                            <p>{{ $portfolio->created_at->format('M Y') }}</p>
                        </div>
                        <div class="pd-meta">
                            <h4>Category</h4>
                            <p>{{ $portfolio->category }}</p>
                        </div>
                    </div>
                </div>

                <!-- Preview -->
                <div class="pd-preview reveal visible" style="transition-delay: 0.2s;">
                    <div class="pd-preview-card">
                        <div class="window-controls"><span></span><span></span><span></span></div>
                        <div class="pd-image">
                            @if($portfolio->image)
                                @if(Str::endsWith(strtolower($portfolio->image), '.pdf'))
                                    <iframe src="{{ asset('storage/' . $portfolio->image) }}" style="width: 100%; height: 600px; border: none; border-radius: 12px; background: white;"></iframe>
                                @else
                                    <img src="{{ asset('storage/' . $portfolio->image) }}" alt="{{ $portfolio->title }}">
                                @endif
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Project Details Content -->
    <section class="pd-content">
        <div class="pd-content-grid">
            <!-- Left Content: Technologies -->
            <div class="reveal visible">
                <!-- Summary Cards -->
                <div class="pd-summary-cards">
                    <div class="summary-card">
                        <div class="sc-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
                        </div>
                        <div class="sc-text">
                            <h4>{{ is_array($portfolio->tech_stack) ? count($portfolio->tech_stack) : 0 }}</h4>
                            <span>Total Teknologi</span>
                        </div>
                    </div>
                    <div class="summary-card">
                        <div class="sc-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></svg>
                        </div>
                        <div class="sc-text">
                            <h4>{{ is_array($portfolio->features) ? count($portfolio->features) : 0 }}</h4>
                            <span>Fitur Utama</span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons moved from hero -->
                <div class="pd-actions">
                    @if($portfolio->link)
                        <a href="{{ $portfolio->link }}" target="_blank" class="btn-pd primary">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            Live Demo
                        </a>
                    @endif
                    @if($portfolio->github_link)
                        <a href="{{ $portfolio->github_link }}" target="_blank" class="btn-pd outline">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                            Github
                        </a>
                    @endif
                </div>

                @if($portfolio->tech_stack && count($portfolio->tech_stack) > 0)
                    <h3 class="pd-section-title">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
                        Technologies Used
                    </h3>
                    <div class="tech-pills">
                        @foreach($portfolio->tech_stack as $tech)
                            <div class="tech-pill">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                                <span>{{ $tech }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
                
                @if(!$portfolio->tech_stack || count($portfolio->tech_stack) === 0)
                    <div style="text-align: center; color: var(--text-muted); padding: 3rem; background: var(--bg-card); border-radius: 12px; border: 1px dotted var(--border);">
                        Tech stack information is not available for this project.
                    </div>
                @endif
            </div>

            <!-- Right Content: Features -->
            <div class="reveal visible" style="transition-delay: 0.2s;">
                <div class="features-box">
                    <h3 class="pd-section-title">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        Key Features
                    </h3>
                    
                    @if($portfolio->features && count($portfolio->features) > 0)
                        <ul class="feature-list">
                            @foreach($portfolio->features as $feature)
                                <li>{{ $feature }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p style="color: var(--text-muted); font-size: 0.85rem;">No feature highlights provided.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @include('partials.footer')
@endsection
