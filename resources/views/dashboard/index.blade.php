<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard — Husein Portfolio</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --bg: #0a0a0f;
            --surface: rgba(255,255,255,0.03);
            --surface-hover: rgba(255,255,255,0.06);
            --border: rgba(255,255,255,0.06);
            --border-hover: rgba(59, 79, 223, 0.3);
            --text: #ffffff;
            --text-dim: rgba(255,255,255,0.5);
            --text-muted: rgba(255,255,255,0.3);
            --accent: #3b4fdf;
            --accent-2: #7c3aed;
            --danger: #ef4444;
            --success: #10b981;
            --gradient: linear-gradient(135deg, #3b4fdf, #7c3aed);
            --radius: 16px;
        }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; }
        a { color: inherit; text-decoration: none; }

        /* Layout */
        .layout { display: flex; min-height: 100vh; }
        .sidebar {
            width: 240px; background: rgba(255,255,255,0.02);
            border-right: 1px solid var(--border);
            padding: 1.5rem 1rem; display: flex; flex-direction: column;
            position: fixed; top: 0; bottom: 0; left: 0; z-index: 100;
        }
        .sidebar-logo {
            font-family: 'Space Grotesk', sans-serif; font-size: 1.2rem;
            font-weight: 800; margin-bottom: 2rem; display: flex;
            align-items: center; gap: 4px;
        }
        .sidebar-logo .dot { color: var(--accent); }
        .sidebar-logo .box {
            display: inline-flex; width: 22px; height: 22px;
            background: var(--gradient); border-radius: 5px;
            align-items: center; justify-content: center;
            font-size: 0.6rem; color: white; margin-left: 2px;
        }

        .nav-section {
            font-size: 0.6rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 2px; color: var(--text-muted);
            margin: 1.5rem 0 0.6rem 0.5rem;
        }
        .nav-link {
            display: flex; align-items: center; gap: 0.6rem;
            padding: 0.55rem 0.8rem; border-radius: 9px;
            color: var(--text-dim); font-size: 0.82rem; font-weight: 500;
            transition: all 0.2s; margin-bottom: 2px; cursor: pointer;
            border: none; background: none; width: 100%; text-align: left;
        }
        .nav-link:hover { background: var(--surface-hover); color: var(--text); }
        .nav-link.active { background: rgba(59,79,223,0.12); color: var(--accent); }
        .nav-link svg { width: 17px; height: 17px; flex-shrink: 0; }
        .nav-link .badge {
            margin-left: auto; font-size: 0.65rem; font-weight: 700;
            padding: 0.1rem 0.45rem; border-radius: 10px;
            background: rgba(59,79,223,0.15); color: var(--accent);
        }
        .sidebar-footer { margin-top: auto; padding-top: 1rem; border-top: 1px solid var(--border); }

        /* Main */
        .main { flex: 1; margin-left: 240px; padding: 1.5rem 2rem; }

        /* Topbar */
        .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
        .topbar h1 { font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; font-weight: 700; }
        .topbar-actions { display: flex; gap: 0.6rem; align-items: center; }

        /* Buttons */
        .btn {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.55rem 1rem; border-radius: 10px; font-size: 0.8rem;
            font-weight: 600; font-family: 'Inter', sans-serif; cursor: pointer;
            border: none; transition: all 0.2s; text-decoration: none;
        }
        .btn svg { width: 15px; height: 15px; }
        .btn-primary { background: var(--gradient); color: white; }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 8px 25px rgba(59,79,223,0.3); }
        .btn-ghost { background: var(--surface); color: var(--text-dim); border: 1px solid var(--border); }
        .btn-ghost:hover { background: var(--surface-hover); color: var(--text); border-color: var(--border-hover); }
        .btn-danger { background: rgba(239,68,68,0.1); color: #f87171; border: 1px solid rgba(239,68,68,0.15); }
        .btn-danger:hover { background: rgba(239,68,68,0.18); }
        .btn-sm { padding: 0.4rem 0.7rem; font-size: 0.72rem; }

        /* Alert */
        .alert {
            padding: 0.65rem 1rem; border-radius: 10px; font-size: 0.8rem;
            margin-bottom: 1.2rem; display: flex; align-items: center; gap: 0.5rem;
        }
        .alert-success { background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.2); color: #34d399; }

        /* Tabs */
        .dash-tabs {
            display: flex; gap: 0; margin-bottom: 1.5rem; background: var(--surface);
            border: 1px solid var(--border); border-radius: 11px; padding: 0.2rem;
            max-width: 360px;
        }
        .dash-tab {
            flex: 1; display: flex; align-items: center; justify-content: center;
            gap: 0.4rem; padding: 0.5rem 0.8rem; border-radius: 8px;
            font-size: 0.78rem; font-weight: 600; cursor: pointer;
            color: var(--text-muted); background: transparent; border: none;
            font-family: 'Inter', sans-serif; transition: all 0.3s;
        }
        .dash-tab:hover { color: var(--text-dim); }
        .dash-tab.active { background: rgba(59,79,223,0.12); color: var(--accent); }
        .dash-tab svg { width: 15px; height: 15px; }
        .dash-tab-content { display: none; }
        .dash-tab-content.active { display: block; }

        /* ===== VISIT ANALYTICS ===== */
        .visit-stats-grid { display: grid; grid-template-columns: repeat(5,1fr); gap: 0.8rem; margin-bottom: 1.5rem; }
        .visit-stat-card {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: 12px; padding: 1rem; text-align: center; transition: all 0.3s;
        }
        .visit-stat-card:hover { border-color: var(--border-hover); }
        .vs-value { font-family: 'Space Grotesk', sans-serif; font-size: 1.4rem; font-weight: 800; }
        .vs-label { font-size: 0.62rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.8px; font-weight: 600; margin-top: 0.1rem; }
        .vs-total .vs-value { color: #60a5fa; }
        .vs-today .vs-value { color: #34d399; }
        .vs-unique .vs-value { color: #a78bfa; }
        .vs-week .vs-value { color: #fb923c; }
        .vs-month .vs-value { color: #f472b6; }

        .analytics-row { display: grid; grid-template-columns: 1.5fr 1fr; gap: 1rem; margin-bottom: 1.5rem; }
        .analytics-panel { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); padding: 1.2rem; }
        .analytics-panel h3 { font-family: 'Space Grotesk', sans-serif; font-size: 0.88rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.4rem; }
        .analytics-panel h3 svg { width: 15px; height: 15px; color: var(--accent); }

        .bar-chart { display: flex; flex-direction: column; gap: 0.5rem; }
        .bar-row { display: flex; align-items: center; gap: 0.6rem; }
        .bar-label { font-size: 0.68rem; font-weight: 600; color: var(--text-muted); width: 40px; text-align: right; flex-shrink: 0; }
        .bar-track { flex: 1; height: 24px; background: rgba(255,255,255,0.03); border-radius: 6px; overflow: hidden; }
        .bar-fill { height: 100%; border-radius: 6px; min-width: 2px; background: var(--gradient); display: flex; align-items: center; justify-content: flex-end; padding-right: 7px; transition: width 1s cubic-bezier(0.4,0,0.2,1); }
        .bar-count { font-size: 0.62rem; font-weight: 700; color: white; }
        .bar-count-outside { font-size: 0.62rem; font-weight: 700; color: var(--text-muted); margin-left: 6px; flex-shrink: 0; }

        .device-list { display: flex; flex-direction: column; gap: 0.5rem; }
        .device-item { display: flex; align-items: center; justify-content: space-between; padding: 0.5rem 0.7rem; border-radius: 8px; background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.03); }
        .device-info { display: flex; align-items: center; gap: 0.6rem; }
        .device-icon { width: 28px; height: 28px; border-radius: 7px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .device-icon svg { width: 14px; height: 14px; color: white; }
        .device-icon.desktop { background: linear-gradient(135deg, #3b4fdf, #5b6fef); }
        .device-icon.mobile { background: linear-gradient(135deg, #10b981, #34d399); }
        .device-icon.tablet { background: linear-gradient(135deg, #f97316, #fb923c); }
        .device-icon.browser { background: linear-gradient(135deg, #7c3aed, #a78bfa); }
        .device-name { font-size: 0.78rem; font-weight: 600; }
        .device-count { font-family: 'Space Grotesk', sans-serif; font-size: 0.9rem; font-weight: 700; }
        .device-pct { font-size: 0.62rem; color: var(--text-muted); font-weight: 600; }

        .visitors-table-wrap { background: var(--surface); border: 1px solid var(--border); border-radius: var(--radius); overflow: hidden; }
        .visitors-table-header { padding: 1rem 1.2rem; display: flex; align-items: center; justify-content: space-between; }
        .visitors-table-header h3 { font-family: 'Space Grotesk', sans-serif; font-size: 0.88rem; font-weight: 700; display: flex; align-items: center; gap: 0.4rem; }
        .visitors-table-header h3 svg { width: 15px; height: 15px; color: var(--accent); }
        .count-badge { font-size: 0.62rem; font-weight: 700; padding: 0.15rem 0.5rem; border-radius: 20px; background: rgba(59,79,223,0.12); color: var(--accent); }
        .visitors-table { width: 100%; border-collapse: collapse; }
        .visitors-table th { font-size: 0.62rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted); text-align: left; padding: 0.5rem 1.2rem; border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); background: rgba(255,255,255,0.01); }
        .visitors-table td { font-size: 0.75rem; padding: 0.55rem 1.2rem; border-bottom: 1px solid rgba(255,255,255,0.03); color: var(--text-dim); }
        .visitors-table tr:hover td { background: rgba(255,255,255,0.02); }
        .device-badge { display: inline-flex; font-size: 0.65rem; font-weight: 600; padding: 0.15rem 0.4rem; border-radius: 4px; }
        .device-badge.desktop-b { background: rgba(59,79,223,0.1); color: #60a5fa; }
        .device-badge.mobile-b { background: rgba(16,185,129,0.1); color: #34d399; }
        .device-badge.tablet-b { background: rgba(249,115,22,0.1); color: #fb923c; }
        .browser-badge { font-size: 0.65rem; font-weight: 600; padding: 0.15rem 0.4rem; border-radius: 4px; background: rgba(124,58,237,0.1); color: #a78bfa; }

        /* ===== PORTFOLIO TAB ===== */
        .portfolio-filter {
            display: flex; gap: 0.4rem; margin-bottom: 1.2rem; flex-wrap: wrap;
        }
        .filter-pill {
            padding: 0.35rem 0.9rem; border-radius: 20px; font-size: 0.72rem;
            font-weight: 700; cursor: pointer; background: transparent;
            border: 1px solid var(--border); color: var(--text-muted);
            font-family: 'Inter', sans-serif; transition: all 0.3s;
        }
        .filter-pill:hover { border-color: var(--border-hover); color: var(--text-dim); }
        .filter-pill.active { background: var(--accent); border-color: var(--accent); color: white; }

        /* Portfolio Cards Grid */
        .portfolio-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1rem; }

        .pcard {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: var(--radius); overflow: hidden;
            transition: all 0.3s; cursor: pointer; position: relative;
        }
        .pcard:hover { border-color: var(--border-hover); transform: translateY(-3px); box-shadow: 0 12px 35px rgba(59,79,223,0.08); }
        .pcard-img {
            width: 100%; height: 180px; overflow: hidden;
            background: rgba(255,255,255,0.02); position: relative;
        }
        .pcard-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
        .pcard:hover .pcard-img img { transform: scale(1.05); }
        .pcard-img .placeholder { display: flex; align-items: center; justify-content: center; height: 100%; color: var(--text-muted); }
        .pcard-img .placeholder svg { width: 40px; height: 40px; opacity: 0.2; }
        .pcard-type-badge {
            position: absolute; top: 10px; left: 10px;
            font-size: 0.6rem; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.8px; padding: 0.2rem 0.5rem; border-radius: 5px;
            backdrop-filter: blur(8px);
        }
        .pcard-type-badge.project { background: rgba(96,165,250,0.2); color: #93c5fd; }
        .pcard-type-badge.certificate { background: rgba(167,139,250,0.2); color: #c4b5fd; }
        .pcard-type-badge.techstack { background: rgba(52,211,153,0.2); color: #6ee7b7; }
        .pcard-featured {
            position: absolute; top: 10px; right: 10px;
            font-size: 0.6rem; font-weight: 700; padding: 0.2rem 0.5rem;
            border-radius: 5px; background: rgba(251,191,36,0.2); color: #fcd34d;
        }

        .pcard-body { padding: 1rem; }
        .pcard-body h3 { font-family: 'Space Grotesk', sans-serif; font-size: 0.95rem; font-weight: 700; margin-bottom: 0.3rem; }
        .pcard-body .pcard-desc {
            font-size: 0.75rem; color: var(--text-dim); line-height: 1.5;
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
            margin-bottom: 0.7rem;
        }
        .pcard-tags { display: flex; flex-wrap: wrap; gap: 0.3rem; margin-bottom: 0.8rem; }
        .pcard-tag {
            font-size: 0.62rem; font-weight: 600; padding: 0.15rem 0.5rem;
            border-radius: 4px; background: rgba(59,79,223,0.08); color: var(--accent);
            border: 1px solid rgba(59,79,223,0.1);
        }
        .pcard-actions { display: flex; gap: 0.4rem; border-top: 1px solid var(--border); padding-top: 0.7rem; }
        .pcard-actions .btn-sm { flex: 1; justify-content: center; }

        /* Empty State */
        .empty-state { text-align: center; padding: 3rem; color: var(--text-muted); }
        .empty-state svg { width: 50px; height: 50px; margin-bottom: 0.8rem; opacity: 0.3; }
        .empty-state h3 { font-family: 'Space Grotesk', sans-serif; font-size: 1.1rem; color: var(--text-dim); margin-bottom: 0.4rem; }
        .empty-state p { font-size: 0.82rem; margin-bottom: 1.2rem; }

        /* ===== MODAL ===== */
        .modal-overlay {
            display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.7); backdrop-filter: blur(6px);
            z-index: 1000; align-items: center; justify-content: center; padding: 2rem;
        }
        .modal-overlay.show { display: flex; }
        .modal {
            background: #12121a; border: 1px solid var(--border); border-radius: 20px;
            width: 100%; max-width: 560px; max-height: 90vh; overflow-y: auto;
            animation: modalIn 0.3s ease;
        }
        @keyframes modalIn { from { opacity: 0; transform: translateY(20px) scale(0.97); } to { opacity: 1; transform: none; } }
        .modal-header {
            display: flex; justify-content: space-between; align-items: center;
            padding: 1.2rem 1.5rem; border-bottom: 1px solid var(--border);
        }
        .modal-header h2 { font-family: 'Space Grotesk', sans-serif; font-size: 1.1rem; font-weight: 700; }
        .modal-close {
            width: 30px; height: 30px; border-radius: 8px;
            background: rgba(255,255,255,0.05); border: 1px solid var(--border);
            color: var(--text-muted); cursor: pointer; display: flex;
            align-items: center; justify-content: center; transition: all 0.2s;
        }
        .modal-close:hover { background: rgba(239,68,68,0.1); color: #f87171; border-color: rgba(239,68,68,0.2); }
        .modal-close svg { width: 16px; height: 16px; }
        .modal-body { padding: 1.5rem; }

        /* Form styles */
        .form-group { margin-bottom: 1rem; }
        .form-group label {
            display: block; font-size: 0.72rem; font-weight: 600;
            color: var(--text-dim); text-transform: uppercase;
            letter-spacing: 0.8px; margin-bottom: 0.4rem;
        }
        .form-input,
        .form-select,
        .form-textarea {
            width: 100%; padding: 0.65rem 0.9rem;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 10px; color: #fff;
            font-size: 0.85rem; font-family: 'Inter', sans-serif;
            outline: none; transition: border-color 0.3s;
        }
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            border-color: var(--accent); box-shadow: 0 0 0 3px rgba(59,79,223,0.1);
        }
        .form-textarea { min-height: 80px; resize: vertical; }
        .form-select option { background: #1a1a2e; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 0.8rem; }

        .file-upload {
            border: 2px dashed rgba(255,255,255,0.08); border-radius: 10px;
            padding: 1.2rem; text-align: center; cursor: pointer; transition: border-color 0.3s;
        }
        .file-upload:hover { border-color: var(--accent); }
        .file-upload svg { width: 28px; height: 28px; color: var(--text-muted); margin-bottom: 0.3rem; }
        .file-upload p { font-size: 0.75rem; color: var(--text-muted); }
        .file-upload input { display: none; }
        .preview-img { max-width: 160px; border-radius: 8px; margin-top: 0.4rem; }

        /* Dynamic fields */
        .dynamic-field { display: flex; gap: 0.5rem; margin-bottom: 0.4rem; align-items: center; }
        .dynamic-field .form-input { flex: 1; }
        .dynamic-btn {
            width: 32px; height: 32px; border-radius: 8px; border: none;
            cursor: pointer; display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; transition: all 0.2s;
        }
        .dynamic-btn svg { width: 16px; height: 16px; }
        .dynamic-btn.add { background: rgba(59,79,223,0.15); color: var(--accent); }
        .dynamic-btn.add:hover { background: rgba(59,79,223,0.25); }
        .dynamic-btn.remove { background: rgba(239,68,68,0.1); color: #f87171; }
        .dynamic-btn.remove:hover { background: rgba(239,68,68,0.2); }
        .dynamic-list { margin-bottom: 0.4rem; }

        .checkbox-row { display: flex; align-items: center; gap: 0.5rem; }
        .checkbox-row input[type="checkbox"] { accent-color: var(--accent); width: 15px; height: 15px; }
        .checkbox-row label { font-size: 0.82rem; color: var(--text-dim); text-transform: none; letter-spacing: 0; }

        .modal-footer { display: flex; gap: 0.6rem; padding: 0 1.5rem 1.5rem; justify-content: flex-end; }
        .error-msg { font-size: 0.7rem; color: #f87171; margin-top: 0.2rem; }

        @media (max-width: 1024px) { .visit-stats-grid { grid-template-columns: repeat(3,1fr); } .analytics-row { grid-template-columns: 1fr; } }
        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main { margin-left: 0; padding: 1.2rem; }
            .visit-stats-grid { grid-template-columns: repeat(2,1fr); }
            .portfolio-grid { grid-template-columns: 1fr; }
            .form-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <a href="/" class="sidebar-logo">HUSEIN<span class="dot">.</span><span class="box">H</span></a>

            <span class="nav-section">Menu</span>
            <a href="{{ route('dashboard') }}" class="nav-link active" id="navDashboard">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                Dashboard
            </a>

            <span class="nav-section">Portfolio</span>
            <button class="nav-link" data-filter="all" onclick="filterPortfolio('all', this)">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                All Items
                <span class="badge">{{ $portfolios->count() }}</span>
            </button>
            <button class="nav-link" data-filter="project" onclick="filterPortfolio('project', this)">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
                Projects
                <span class="badge">{{ $portfolios->where('type', 'project')->count() }}</span>
            </button>
            <button class="nav-link" data-filter="certificate" onclick="filterPortfolio('certificate', this)">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                Certificates
                <span class="badge">{{ $portfolios->where('type', 'certificate')->count() }}</span>
            </button>
            <button class="nav-link" data-filter="techstack" onclick="filterPortfolio('techstack', this)">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2Z"/></svg>
                Tech Stack
                <span class="badge">{{ $portfolios->where('type', 'techstack')->count() }}</span>
            </button>

            <span class="nav-section">Links</span>
            <a href="/" class="nav-link" target="_blank">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                View Site
            </a>

            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-link" style="cursor:pointer;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main">
            <div class="topbar">
                <h1>Dashboard</h1>
                <div class="topbar-actions">
                    <form method="POST" action="{{ route('portfolio.backup') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-ghost" title="Simpan data saat ini secara permanen">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                            Save Permanently
                        </button>
                    </form>
                    <button class="btn btn-primary" onclick="openModal()">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Create New
                    </button>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Dashboard Tabs -->
            <div class="dash-tabs">
                <button class="dash-tab active" data-dtab="analytics">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                    Analytics
                </button>
                <button class="dash-tab" data-dtab="portfolio">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    Portfolio
                </button>
            </div>

            <!-- TAB: ANALYTICS -->
            <div class="dash-tab-content active" id="dtab-analytics">
                <div class="visit-stats-grid">
                    <div class="visit-stat-card vs-total"><div class="vs-value">{{ number_format($visitStats['total']) }}</div><div class="vs-label">Total Visits</div></div>
                    <div class="visit-stat-card vs-today"><div class="vs-value">{{ number_format($visitStats['today']) }}</div><div class="vs-label">Today</div></div>
                    <div class="visit-stat-card vs-unique"><div class="vs-value">{{ number_format($visitStats['unique']) }}</div><div class="vs-label">Unique</div></div>
                    <div class="visit-stat-card vs-week"><div class="vs-value">{{ number_format($visitStats['thisWeek']) }}</div><div class="vs-label">This Week</div></div>
                    <div class="visit-stat-card vs-month"><div class="vs-value">{{ number_format($visitStats['thisMonth']) }}</div><div class="vs-label">This Month</div></div>
                </div>
                <div class="analytics-row">
                    <div class="analytics-panel">
                        <h3><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg> Daily Visits — Last 7 Days</h3>
                        <div class="bar-chart">
                            @foreach($dailyVisits as $day)
                                @php $pct = $maxDaily > 0 ? ($day['count'] / $maxDaily) * 100 : 0; @endphp
                                <div class="bar-row">
                                    <span class="bar-label">{{ $day['day'] }}</span>
                                    <div class="bar-track"><div class="bar-fill" style="width:{{ max($pct,2) }}%;">@if($pct > 25)<span class="bar-count">{{ $day['count'] }}</span>@endif</div></div>
                                    @if($pct <= 25)<span class="bar-count-outside">{{ $day['count'] }}</span>@endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="analytics-panel">
                        <h3><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg> Devices & Browsers</h3>
                        <div class="device-list">
                            @php $totalDev = max(array_sum($deviceStats), 1); @endphp
                            <div class="device-item"><div class="device-info"><div class="device-icon desktop"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></div><span class="device-name">Desktop</span></div><div><span class="device-count">{{ $deviceStats['desktop'] }}</span> <span class="device-pct">({{ round($deviceStats['desktop']/$totalDev*100) }}%)</span></div></div>
                            <div class="device-item"><div class="device-info"><div class="device-icon mobile"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg></div><span class="device-name">Mobile</span></div><div><span class="device-count">{{ $deviceStats['mobile'] }}</span> <span class="device-pct">({{ round($deviceStats['mobile']/$totalDev*100) }}%)</span></div></div>
                            <div class="device-item"><div class="device-info"><div class="device-icon tablet"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="2" width="16" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg></div><span class="device-name">Tablet</span></div><div><span class="device-count">{{ $deviceStats['tablet'] }}</span> <span class="device-pct">({{ round($deviceStats['tablet']/$totalDev*100) }}%)</span></div></div>
                            @foreach($browserStats as $browser => $count)
                            <div class="device-item"><div class="device-info"><div class="device-icon browser"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg></div><span class="device-name">{{ $browser }}</span></div><div><span class="device-count">{{ $count }}</span> <span class="device-pct">({{ round($count/$totalDev*100) }}%)</span></div></div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="visitors-table-wrap">
                    <div class="visitors-table-header">
                        <h3><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg> Recent Visitors</h3>
                        <span class="count-badge">Last {{ $recentVisits->count() }}</span>
                    </div>
                    @if($recentVisits->count() > 0)
                    <table class="visitors-table"><thead><tr><th>IP</th><th>Device</th><th>Browser</th><th>Page</th><th>Time</th></tr></thead><tbody>
                        @foreach($recentVisits as $visit)
                        <tr>
                            <td style="font-family:'Space Grotesk',monospace;font-weight:600;font-size:0.72rem;">{{ $visit->ip_address }}</td>
                            <td><span class="device-badge {{ strtolower($visit->device) }}-b">{{ $visit->device }}</span></td>
                            <td><span class="browser-badge">{{ $visit->browser }}</span></td>
                            <td>{{ $visit->page }}</td>
                            <td style="font-size:0.7rem;color:var(--text-muted);">{{ $visit->created_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody></table>
                    @else
                    <div style="padding:2rem;text-align:center;color:var(--text-muted);font-size:0.82rem;">Belum ada kunjungan tercatat.</div>
                    @endif
                </div>
            </div>

            <!-- TAB: PORTFOLIO -->
            <div class="dash-tab-content" id="dtab-portfolio">
                <div class="portfolio-filter">
                    <button class="filter-pill active" onclick="filterCards('all', this)">All</button>
                    <button class="filter-pill" onclick="filterCards('project', this)">📁 Projects</button>
                    <button class="filter-pill" onclick="filterCards('certificate', this)">🎓 Certificates</button>
                    <button class="filter-pill" onclick="filterCards('techstack', this)">⚡ Tech Stack</button>
                </div>

                @if($portfolios->count() > 0)
                <div class="portfolio-grid" id="portfolioGrid">
                    @foreach($portfolios as $item)
                    <div class="pcard" data-type="{{ $item->type }}" onclick="window.location='{{ route('portfolio.show', $item) }}'">
                        <div class="pcard-img">
                            @if($item->image)
                                @if(Str::endsWith(strtolower($item->image), '.pdf'))
                                    <div class="placeholder" style="color: #ef4444;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="opacity: 0.8;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg></div>
                                @else
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}">
                                @endif
                            @else
                                <div class="placeholder"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg></div>
                            @endif
                            <span class="pcard-type-badge {{ $item->type }}">{{ $item->type == 'techstack' ? 'Tech Stack' : ucfirst($item->type) }}</span>
                            @if($item->is_featured)<span class="pcard-featured">★ Featured</span>@endif
                        </div>
                        <div class="pcard-body">
                            <h3>{{ $item->title }}</h3>
                            <p class="pcard-desc">{{ $item->description }}</p>
                            @if($item->tech_stack && count($item->tech_stack) > 0)
                            <div class="pcard-tags">
                                @foreach(array_slice($item->tech_stack, 0, 4) as $tech)
                                    <span class="pcard-tag">{{ $tech }}</span>
                                @endforeach
                                @if(count($item->tech_stack) > 4)
                                    <span class="pcard-tag" style="opacity:0.6;">+{{ count($item->tech_stack) - 4 }}</span>
                                @endif
                            </div>
                            @endif
                            <div class="pcard-actions" onclick="event.stopPropagation();">
                                @if($item->link)
                                <a href="{{ $item->link }}" target="_blank" class="btn btn-ghost btn-sm" title="Live Demo">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                                    Preview
                                </a>
                                @endif
                                <a href="{{ route('portfolio.edit', $item) }}" class="btn btn-ghost btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('portfolio.destroy', $item) }}" onsubmit="return confirm('Hapus?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    <h3>Belum ada portfolio</h3>
                    <p>Mulai tambahkan project, sertifikat, atau tech stack Anda.</p>
                    <button class="btn btn-primary" onclick="openModal()">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        Create First Portfolio
                    </button>
                </div>
                @endif
            </div>
        </main>
    </div>

    <!-- ===== CREATE MODAL ===== -->
    <div class="modal-overlay" id="createModal">
        <div class="modal">
            <div class="modal-header">
                <h2>Add New Portfolio</h2>
                <button class="modal-close" onclick="closeModal()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>
            <form method="POST" action="{{ route('portfolio.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Type</label>
                            <select name="type" class="form-select" required id="modalType">
                                <option value="project">📁 Project</option>
                                <option value="certificate">🎓 Certificate</option>
                                <option value="techstack">⚡ Tech Stack</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category" class="form-select" required id="modalCategory">
                                <option value="" disabled selected>Select</option>
                                <optgroup label="Project"><option value="Project">Project</option><option value="Design">Design</option><option value="Editing">Editing</option></optgroup>
                                <optgroup label="Certificate"><option value="Bootcamp">Bootcamp</option><option value="Course">Course</option><option value="Certification">Certification</option></optgroup>
                                <optgroup label="Tech Stack"><option value="Tool">Tool</option><option value="Language">Language</option><option value="Framework">Framework</option></optgroup>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-input" placeholder="e.g. Redesign Dashboard Dikti" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-textarea" placeholder="Describe this portfolio item..."></textarea>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <div class="file-upload" onclick="document.getElementById('modalImage').click()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                            <p id="modalFileName">Click to upload image or PDF (max 10MB)</p>
                            <input type="file" id="modalImage" name="image" accept="image/*,application/pdf">
                        </div>
                        <img id="modalPreview" class="preview-img" style="display:none;">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Live Demo URL</label>
                            <input type="url" name="link" class="form-input" placeholder="https://example.com">
                        </div>
                        <div class="form-group">
                            <label>GitHub URL</label>
                            <input type="url" name="github_link" class="form-input" placeholder="https://github.com/user/repo">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Features</label>
                        <div class="dynamic-list" id="featuresList"></div>
                        <div class="dynamic-field">
                            <input type="text" class="form-input" id="featureInput" placeholder="Enter a feature">
                            <button type="button" class="dynamic-btn add" onclick="addDynamic('features', 'featureInput', 'featuresList')">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Tech Stack</label>
                        <div class="dynamic-list" id="techList"></div>
                        <div class="dynamic-field">
                            <input type="text" class="form-input" id="techInput" placeholder="Enter a technology">
                            <button type="button" class="dynamic-btn add" onclick="addDynamic('tech_stack', 'techInput', 'techList')">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                            </button>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Sort Order</label>
                            <input type="number" name="sort_order" class="form-input" value="0" min="0">
                        </div>
                        <div class="form-group" style="display:flex;align-items:flex-end;">
                            <div class="checkbox-row">
                                <input type="checkbox" id="modalFeatured" name="is_featured" value="1">
                                <label for="modalFeatured">Featured</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-ghost" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/></svg>
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Dashboard tabs
        document.querySelectorAll('.dash-tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.dash-tab').forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                document.querySelectorAll('.dash-tab-content').forEach(c => c.classList.remove('active'));
                document.getElementById('dtab-' + tab.dataset.dtab).classList.add('active');
            });
        });

        // Portfolio filter (pills in portfolio tab)
        function filterCards(type, btn) {
            document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
            btn.classList.add('active');
            document.querySelectorAll('.pcard').forEach(card => {
                card.style.display = (type === 'all' || card.dataset.type === type) ? '' : 'none';
            });
        }

        // Sidebar portfolio filter — switches to portfolio tab and filters
        function filterPortfolio(type, btn) {
            // Activate portfolio tab
            document.querySelectorAll('.dash-tab').forEach(t => t.classList.remove('active'));
            document.querySelector('[data-dtab="portfolio"]').classList.add('active');
            document.querySelectorAll('.dash-tab-content').forEach(c => c.classList.remove('active'));
            document.getElementById('dtab-portfolio').classList.add('active');

            // Highlight sidebar
            document.querySelectorAll('.sidebar [data-filter]').forEach(n => n.classList.remove('active'));
            btn.classList.add('active');

            // Filter cards
            document.querySelectorAll('.pcard').forEach(card => {
                card.style.display = (type === 'all' || card.dataset.type === type) ? '' : 'none';
            });

            // Update filter pills
            document.querySelectorAll('.filter-pill').forEach(p => {
                p.classList.remove('active');
                if ((type === 'all' && p.textContent.trim() === 'All') ||
                    p.textContent.toLowerCase().includes(type)) {
                    p.classList.add('active');
                }
            });
        }

        // Modal
        function openModal() { document.getElementById('createModal').classList.add('show'); }
        function closeModal() { document.getElementById('createModal').classList.remove('show'); }
        document.getElementById('createModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        // Image preview
        document.getElementById('modalImage').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                document.getElementById('modalFileName').textContent = file.name;
                const preview = document.getElementById('modalPreview');
                if (file.type === 'application/pdf') {
                    preview.style.display = 'none';
                } else {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        preview.src = e.target.result;
                        preview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        // Dynamic fields (features, tech_stack)
        function addDynamic(name, inputId, listId) {
            const input = document.getElementById(inputId);
            const val = input.value.trim();
            if (!val) return;

            const list = document.getElementById(listId);
            const div = document.createElement('div');
            div.className = 'dynamic-field';
            div.innerHTML = `
                <input type="text" name="${name}[]" value="${val}" class="form-input" readonly style="opacity:0.8;">
                <button type="button" class="dynamic-btn remove" onclick="this.parentElement.remove()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>`;
            list.appendChild(div);
            input.value = '';
            input.focus();
        }

        // Allow Enter key to add dynamic items
        document.getElementById('featureInput').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') { e.preventDefault(); addDynamic('features', 'featureInput', 'featuresList'); }
        });
        document.getElementById('techInput').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') { e.preventDefault(); addDynamic('tech_stack', 'techInput', 'techList'); }
        });

        // Open modal if there were validation errors
        @if($errors->any())
            openModal();
        @endif
    </script>
</body>
</html>
