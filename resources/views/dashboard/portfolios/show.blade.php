<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $portfolio->title }} — Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --bg: #0a0a0f;
            --surface: rgba(255,255,255,0.03);
            --border: rgba(255,255,255,0.06);
            --border-hover: rgba(59,79,223,0.3);
            --text: #ffffff;
            --text-dim: rgba(255,255,255,0.6);
            --text-muted: rgba(255,255,255,0.35);
            --accent: #3b4fdf;
            --accent-2: #7c3aed;
            --gradient: linear-gradient(135deg, #3b4fdf, #7c3aed);
            --radius: 16px;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }
        a { color: inherit; text-decoration: none; }

        /* Background Glows */
        .bg-glow { position: fixed; border-radius: 50%; filter: blur(150px); pointer-events: none; opacity: 0.06; }
        .bg-glow-1 { width: 500px; height: 500px; background: #3b4fdf; top: -200px; right: -100px; }
        .bg-glow-2 { width: 400px; height: 400px; background: #7c3aed; bottom: -200px; left: -100px; }

        .container { max-width: 1100px; margin: 0 auto; padding: 2rem 2rem 4rem; position: relative; z-index: 2; }

        /* Breadcrumb */
        .breadcrumb {
            display: flex; align-items: center; gap: 0.5rem;
            margin-bottom: 2.5rem; flex-wrap: wrap;
        }
        .breadcrumb a {
            font-size: 0.82rem; font-weight: 500; color: var(--text-muted);
            transition: color 0.3s; display: inline-flex; align-items: center; gap: 0.3rem;
        }
        .breadcrumb a:hover { color: var(--accent); }
        .breadcrumb a svg { width: 16px; height: 16px; }
        .breadcrumb .sep { color: var(--text-muted); font-size: 0.75rem; }
        .breadcrumb .current { font-size: 0.82rem; font-weight: 600; color: var(--text-dim); }

        /* Detail Layout */
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: start;
        }

        /* Left Column */
        .detail-left {}
        .detail-type {
            display: inline-flex; align-items: center; gap: 6px;
            font-size: 0.68rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 1.5px; padding: 0.3rem 0.8rem; border-radius: 6px;
            margin-bottom: 1rem;
        }
        .detail-type.project { background: rgba(96,165,250,0.1); color: #60a5fa; }
        .detail-type.certificate { background: rgba(167,139,250,0.1); color: #a78bfa; }
        .detail-type.techstack { background: rgba(52,211,153,0.1); color: #34d399; }

        .detail-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.2rem; font-weight: 800; line-height: 1.2;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #fff 0%, rgba(255,255,255,0.7) 100%);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .detail-category {
            font-size: 0.82rem; font-weight: 600; color: var(--accent);
            margin-bottom: 1.5rem;
        }
        .detail-desc {
            font-size: 0.92rem; line-height: 1.8; color: var(--text-dim);
            margin-bottom: 2rem;
        }

        /* Stats Row */
        .detail-stats {
            display: flex; gap: 1rem; margin-bottom: 1.5rem;
        }
        .detail-stat {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: 12px; padding: 0.8rem 1.2rem;
            display: flex; align-items: center; gap: 0.8rem;
            min-width: 130px;
        }
        .detail-stat-icon {
            width: 36px; height: 36px; border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
        }
        .detail-stat-icon svg { width: 16px; height: 16px; color: white; }
        .detail-stat-icon.purple { background: linear-gradient(135deg, #7c3aed, #9333ea); }
        .detail-stat-icon.teal { background: linear-gradient(135deg, #14b8a6, #10d3b5); }
        .detail-stat-value {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.2rem; font-weight: 800;
        }
        .detail-stat-label {
            font-size: 0.65rem; color: var(--text-muted);
            font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;
        }

        /* Action Buttons */
        .detail-actions {
            display: flex; gap: 0.8rem; margin-bottom: 2rem; flex-wrap: wrap;
        }
        .btn-action {
            display: inline-flex; align-items: center; gap: 0.5rem;
            padding: 0.6rem 1.2rem; border-radius: 10px;
            font-size: 0.82rem; font-weight: 600;
            font-family: 'Inter', sans-serif;
            border: none; cursor: pointer; transition: all 0.3s;
            text-decoration: none;
        }
        .btn-action svg { width: 16px; height: 16px; }
        .btn-action.primary {
            background: var(--gradient); color: white;
        }
        .btn-action.primary:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(59,79,223,0.3); }
        .btn-action.outline {
            background: transparent; color: var(--text-dim);
            border: 1px solid var(--border);
        }
        .btn-action.outline:hover { border-color: var(--accent); color: var(--text); }
        .btn-action.edit {
            background: rgba(251,191,36,0.1); color: #fbbf24;
            border: 1px solid rgba(251,191,36,0.15);
        }
        .btn-action.edit:hover { background: rgba(251,191,36,0.18); }
        .btn-action.danger {
            background: rgba(239,68,68,0.1); color: #f87171;
            border: 1px solid rgba(239,68,68,0.15);
        }
        .btn-action.danger:hover { background: rgba(239,68,68,0.18); }

        /* Tech Stack Pills */
        .detail-section-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.95rem; font-weight: 700;
            margin-bottom: 0.8rem;
            display: flex; align-items: center; gap: 0.5rem;
        }
        .detail-section-title svg { width: 16px; height: 16px; color: var(--accent); }
        .tech-pills {
            display: flex; flex-wrap: wrap; gap: 0.5rem;
            margin-bottom: 2rem;
        }
        .tech-pill {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 0.4rem 0.9rem; border-radius: 20px;
            font-size: 0.78rem; font-weight: 600;
            background: rgba(59,79,223,0.1); color: var(--accent);
            border: 1px solid rgba(59,79,223,0.15);
        }
        .tech-pill::before {
            content: ''; width: 6px; height: 6px; border-radius: 50%;
            background: var(--accent);
        }

        /* Right Column - Image */
        .detail-right {}
        .detail-image-card {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: 20px; overflow: hidden;
            position: relative;
        }
        .detail-image-card::before {
            content: ''; position: absolute; top: 0; left: 0; right: 0;
            height: 3px; background: var(--gradient); z-index: 2;
        }
        .detail-image-card img {
            width: 100%; height: auto; display: block;
        }
        .detail-image-placeholder {
            width: 100%; height: 300px; display: flex;
            align-items: center; justify-content: center;
            color: var(--text-muted);
        }
        .detail-image-placeholder svg { width: 60px; height: 60px; opacity: 0.2; }

        /* Features List */
        .features-card {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: var(--radius); padding: 1.5rem;
            margin-top: 1.5rem;
        }
        .feature-list { list-style: none; }
        .feature-list li {
            display: flex; align-items: flex-start; gap: 0.7rem;
            padding: 0.6rem 0;
            border-bottom: 1px solid rgba(255,255,255,0.03);
            font-size: 0.85rem; color: var(--text-dim); line-height: 1.5;
        }
        .feature-list li:last-child { border-bottom: none; }
        .feature-list li::before {
            content: ''; width: 6px; height: 6px; border-radius: 50%;
            background: var(--accent); flex-shrink: 0; margin-top: 7px;
        }

        /* Meta Info */
        .meta-row {
            display: flex; gap: 1rem; flex-wrap: wrap;
            margin-top: 1.5rem; padding-top: 1.5rem;
            border-top: 1px solid var(--border);
        }
        .meta-item {
            font-size: 0.75rem; color: var(--text-muted);
            display: flex; align-items: center; gap: 0.3rem;
        }
        .meta-item svg { width: 12px; height: 12px; }

        @media (max-width: 768px) {
            .container { padding: 1.5rem; }
            .detail-grid { grid-template-columns: 1fr; gap: 2rem; }
            .detail-right { order: -1; }
            .detail-title { font-size: 1.6rem; }
            .detail-stats { flex-wrap: wrap; }
        }
    </style>
</head>
<body>
    <div class="bg-glow bg-glow-1"></div>
    <div class="bg-glow bg-glow-2"></div>

    <div class="container">
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="{{ route('dashboard') }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                Back
            </a>
            <span class="sep">›</span>
            <a href="{{ route('dashboard') }}">
                {{ ucfirst($portfolio->type == 'techstack' ? 'Tech Stack' : $portfolio->type . 's') }}
            </a>
            <span class="sep">›</span>
            <span class="current">{{ Str::limit($portfolio->title, 40) }}</span>
        </div>

        <!-- Detail Grid -->
        <div class="detail-grid">
            <!-- Left Column -->
            <div class="detail-left">
                <span class="detail-type {{ $portfolio->type }}">
                    @if($portfolio->type == 'project') 📁 Project
                    @elseif($portfolio->type == 'certificate') 🎓 Certificate
                    @else ⚡ Tech Stack
                    @endif
                </span>
                <h1 class="detail-title">{{ $portfolio->title }}</h1>
                <p class="detail-category">{{ $portfolio->category }}</p>

                @if($portfolio->description)
                    <p class="detail-desc">{{ $portfolio->description }}</p>
                @endif

                <!-- Stats -->
                <div class="detail-stats">
                    @if($portfolio->tech_stack && count($portfolio->tech_stack) > 0)
                        <div class="detail-stat">
                            <div class="detail-stat-icon purple">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
                            </div>
                            <div>
                                <div class="detail-stat-value">{{ count($portfolio->tech_stack) }}</div>
                                <div class="detail-stat-label">Technologies</div>
                            </div>
                        </div>
                    @endif
                    @if($portfolio->features && count($portfolio->features) > 0)
                        <div class="detail-stat">
                            <div class="detail-stat-icon teal">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                            </div>
                            <div>
                                <div class="detail-stat-value">{{ count($portfolio->features) }}</div>
                                <div class="detail-stat-label">Features</div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div class="detail-actions">
                    @if($portfolio->link)
                        <a href="{{ $portfolio->link }}" target="_blank" class="btn-action primary">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                            Live Demo
                        </a>
                    @endif
                    @if($portfolio->github_link)
                        <a href="{{ $portfolio->github_link }}" target="_blank" class="btn-action outline">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="16" height="16"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                            GitHub
                        </a>
                    @endif
                    <a href="{{ route('portfolio.edit', $portfolio) }}" class="btn-action edit">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                        Edit
                    </a>
                    <form method="POST" action="{{ route('portfolio.destroy', $portfolio) }}" onsubmit="return confirm('Hapus portfolio ini?')" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-action danger">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                            Delete
                        </button>
                    </form>
                </div>

                <!-- Technologies Used -->
                @if($portfolio->tech_stack && count($portfolio->tech_stack) > 0)
                    <div class="detail-section-title">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
                        Technologies Used
                    </div>
                    <div class="tech-pills">
                        @foreach($portfolio->tech_stack as $tech)
                            <span class="tech-pill">{{ $tech }}</span>
                        @endforeach
                    </div>
                @endif

                <!-- Meta Info -->
                <div class="meta-row">
                    <span class="meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        Created: {{ $portfolio->created_at->format('d M Y') }}
                    </span>
                    @if($portfolio->is_featured)
                        <span class="meta-item" style="color:#fbbf24;">★ Featured</span>
                    @endif
                    <span class="meta-item">Sort: {{ $portfolio->sort_order }}</span>
                </div>
            </div>

            <!-- Right Column -->
            <div class="detail-right">
                <div class="detail-image-card">
                    @if($portfolio->image)
                        <img src="{{ asset('storage/' . $portfolio->image) }}" alt="{{ $portfolio->title }}">
                    @else
                        <div class="detail-image-placeholder">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        </div>
                    @endif
                </div>

                <!-- Features List -->
                @if($portfolio->features && count($portfolio->features) > 0)
                    <div class="features-card">
                        <div class="detail-section-title">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                            Key Features
                        </div>
                        <ul class="feature-list">
                            @foreach($portfolio->features as $feature)
                                <li>{{ $feature }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
