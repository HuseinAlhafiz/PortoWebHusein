<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Portfolio — Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --bg: #0a0a0f;
            --surface: rgba(255,255,255,0.03);
            --border: rgba(255,255,255,0.06);
            --text: #ffffff;
            --text-dim: rgba(255,255,255,0.5);
            --text-muted: rgba(255,255,255,0.3);
            --accent: #3b4fdf;
            --accent-2: #7c3aed;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 3rem 1.5rem;
        }
        .bg-glow { position: fixed; width: 400px; height: 400px; border-radius: 50%; filter: blur(120px); opacity: 0.1; pointer-events: none; }
        .bg-glow-1 { background: #3b4fdf; top: -150px; right: -100px; }
        .bg-glow-2 { background: #7c3aed; bottom: -150px; left: -100px; }

        .form-container {
            width: 100%; max-width: 600px;
            position: relative; z-index: 2;
        }
        .form-header {
            margin-bottom: 2rem;
        }
        .form-header .back-link {
            display: inline-flex; align-items: center; gap: 0.3rem;
            color: var(--text-muted); text-decoration: none;
            font-size: 0.82rem; font-weight: 500;
            margin-bottom: 1rem; transition: color 0.3s;
        }
        .form-header .back-link:hover { color: var(--accent); }
        .form-header .back-link svg { width: 16px; height: 16px; }
        .form-header h1 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.6rem; font-weight: 700;
        }
        .form-header p { font-size: 0.85rem; color: var(--text-dim); margin-top: 0.3rem; }

        .form-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 2rem;
        }
        .form-group { margin-bottom: 1.3rem; }
        .form-group label {
            display: block; font-size: 0.78rem; font-weight: 600;
            color: var(--text-dim); text-transform: uppercase;
            letter-spacing: 0.8px; margin-bottom: 0.5rem;
        }
        .form-group input[type="text"],
        .form-group input[type="url"],
        .form-group input[type="number"],
        .form-group textarea,
        .form-group select {
            width: 100%; padding: 0.8rem 1rem;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px; color: #fff;
            font-size: 0.88rem; font-family: 'Inter', sans-serif;
            outline: none; transition: border-color 0.3s;
        }
        .form-group input:focus, .form-group textarea:focus, .form-group select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(59,79,223,0.12);
        }
        .form-group textarea { min-height: 100px; resize: vertical; }
        .form-group select option { background: #1a1a2e; }

        .form-group .file-upload {
            border: 2px dashed rgba(255,255,255,0.08);
            border-radius: 12px; padding: 2rem; text-align: center;
            cursor: pointer; transition: border-color 0.3s;
        }
        .form-group .file-upload:hover { border-color: var(--accent); }
        .form-group .file-upload svg { width: 36px; height: 36px; color: var(--text-muted); margin-bottom: 0.5rem; }
        .form-group .file-upload p { font-size: 0.82rem; color: var(--text-muted); }
        .form-group .file-upload input { display: none; }

        .checkbox-row {
            display: flex; align-items: center; gap: 0.6rem;
        }
        .checkbox-row input[type="checkbox"] { accent-color: var(--accent); width: 16px; height: 16px; }
        .checkbox-row label { font-size: 0.85rem; color: var(--text-dim); text-transform: none; letter-spacing: 0; }

        .dynamic-field { display: flex; gap: 0.5rem; margin-bottom: 0.4rem; align-items: center; }
        .dynamic-field input { flex: 1; }
        .dynamic-btn { width: 36px; height: 36px; border-radius: 10px; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: all 0.2s; }
        .dynamic-btn svg { width: 18px; height: 18px; }
        .dynamic-btn.add { background: rgba(59,79,223,0.15); color: var(--accent); }
        .dynamic-btn.add:hover { background: rgba(59,79,223,0.25); }
        .dynamic-btn.remove { background: rgba(239,68,68,0.1); color: #f87171; }
        .dynamic-btn.remove:hover { background: rgba(239,68,68,0.2); }
        .dynamic-list { margin-bottom: 0.4rem; }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }

        .form-actions {
            display: flex; gap: 0.8rem; margin-top: 1.5rem;
        }
        .btn {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.7rem 1.5rem; border-radius: 12px;
            font-size: 0.85rem; font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer; border: none; text-decoration: none;
            transition: all 0.2s ease;
        }
        .btn-primary { background: linear-gradient(135deg, var(--accent), var(--accent-2)); color: white; }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 8px 25px rgba(59,79,223,0.3); }
        .btn-ghost { background: transparent; color: var(--text-dim); border: 1px solid var(--border); }
        .btn-ghost:hover { border-color: rgba(255,255,255,0.15); color: var(--text); }

        .error-msg {
            font-size: 0.75rem; color: #f87171; margin-top: 0.3rem;
        }

        .preview-img { max-width: 200px; border-radius: 10px; margin-top: 0.5rem; }

        @media (max-width: 600px) { .form-row { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <div class="bg-glow bg-glow-1"></div>
    <div class="bg-glow bg-glow-2"></div>

    <div class="form-container">
        <div class="form-header">
            <a href="{{ route('dashboard') }}" class="back-link">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
                Back to Dashboard
            </a>
            <h1>Add Portfolio</h1>
            <p>Tambahkan karya design, project, atau dokumentasi Anda</p>
        </div>

        <div class="form-card">
            <form method="POST" action="{{ route('portfolio.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="type">Type</label>
                    <select id="type" name="type" required>
                        <option value="project" {{ old('type') == 'project' ? 'selected' : '' }}>📁 Project</option>
                        <option value="certificate" {{ old('type') == 'certificate' ? 'selected' : '' }}>🎓 Certificate</option>
                        <option value="techstack" {{ old('type') == 'techstack' ? 'selected' : '' }}>⚡ Tech Stack</option>
                    </select>
                    @error('type') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="Contoh: Redesign Dashboard Dikti" required>
                    @error('title') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Jelaskan project atau design ini...">{{ old('description') }}</textarea>
                    @error('description') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select id="category" name="category" required>
                            <option value="" disabled selected>Pilih kategori</option>
                            <!-- Project categories -->
                            <optgroup label="Project" class="cat-project">
                                <option value="Project" {{ old('category') == 'Project' ? 'selected' : '' }}>Project</option>
                                <option value="Design" {{ old('category') == 'Design' ? 'selected' : '' }}>Design</option>
                                <option value="Editing" {{ old('category') == 'Editing' ? 'selected' : '' }}>Editing</option>
                            </optgroup>
                            <!-- Certificate categories -->
                            <optgroup label="Certificate" class="cat-certificate">
                                <option value="Bootcamp" {{ old('category') == 'Bootcamp' ? 'selected' : '' }}>Bootcamp</option>
                                <option value="Course" {{ old('category') == 'Course' ? 'selected' : '' }}>Course</option>
                                <option value="Certification" {{ old('category') == 'Certification' ? 'selected' : '' }}>Certification</option>
                            </optgroup>
                            <!-- Tech Stack categories -->
                            <optgroup label="Tech Stack" class="cat-techstack">
                                <option value="Tool" {{ old('category') == 'Tool' ? 'selected' : '' }}>Tool</option>
                                <option value="Language" {{ old('category') == 'Language' ? 'selected' : '' }}>Language</option>
                                <option value="Framework" {{ old('category') == 'Framework' ? 'selected' : '' }}>Framework</option>
                            </optgroup>
                        </select>
                        @error('category') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="sort_order">Sort Order</label>
                        <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                    </div>
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <div class="file-upload" onclick="document.getElementById('imageInput').click()">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        <p id="fileName">Click to upload image or PDF (max 10MB)</p>
                        <input type="file" id="imageInput" name="image" accept="image/*,application/pdf">
                    </div>
                    <img id="imagePreview" class="preview-img" style="display:none;">
                    @error('image') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="link">External Link (optional)</label>
                    <input type="url" id="link" name="link" value="{{ old('link') }}" placeholder="https://figma.com/...">
                    @error('link') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Features</label>
                    <div class="dynamic-list" id="createFeaturesList">
                        @if(old('features'))
                            @foreach(old('features') as $feat)
                                <div class="dynamic-field">
                                    <input type="text" name="features[]" value="{{ $feat }}" class="form-input">
                                    <button type="button" class="dynamic-btn remove" onclick="this.parentElement.remove()">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="dynamic-field">
                        <input type="text" class="form-input" id="createFeatureInput" placeholder="Add feature" list="featureOptions">
                        <datalist id="featureOptions">
                            <option value="User Authentication & Authorization">
                            <option value="Responsive UI/UX Design">
                            <option value="CRUD Operations">
                            <option value="API Integration">
                            <option value="Admin Dashboard">
                            <option value="Data Visualization / Charts">
                            <option value="Payment Gateway Integration">
                            <option value="Real-time Notifications">
                        </datalist>
                        <button type="button" class="dynamic-btn add" onclick="addCreateDynamic('features', 'createFeatureInput', 'createFeaturesList')">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label>Tech Stack</label>
                    <div class="dynamic-list" id="createTechList">
                        @if(old('tech_stack'))
                            @foreach(old('tech_stack') as $tech)
                                <div class="dynamic-field">
                                    <input type="text" name="tech_stack[]" value="{{ $tech }}" class="form-input">
                                    <button type="button" class="dynamic-btn remove" onclick="this.parentElement.remove()">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="dynamic-field">
                        <input type="text" class="form-input" id="createTechInput" placeholder="Add technology" list="techOptions">
                        <datalist id="techOptions">
                            <option value="Laravel">
                            <option value="PHP">
                            <option value="React">
                            <option value="Vue.js">
                            <option value="Livewire">
                            <option value="Alpine.js">
                            <option value="Tailwind CSS">
                            <option value="Bootstrap">
                            <option value="MySQL">
                            <option value="PostgreSQL">
                            <option value="Figma">
                            <option value="Next.js">
                            <option value="Node.js">
                            <option value="Express">
                        </datalist>
                        <button type="button" class="dynamic-btn add" onclick="addCreateDynamic('tech_stack', 'createTechInput', 'createTechList')">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <div class="checkbox-row">
                        <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                        <label for="is_featured">Tampilkan di halaman utama (featured)</label>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save Portfolio</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-ghost">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('imageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                document.getElementById('fileName').textContent = file.name;
                const preview = document.getElementById('imagePreview');
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

        function addCreateDynamic(name, inputId, listId) {
            const input = document.getElementById(inputId);
            const val = input.value.trim();
            if (!val) return;
            const list = document.getElementById(listId);
            const div = document.createElement('div');
            div.className = 'dynamic-field';
            div.innerHTML = `<input type="text" name="${name}[]" value="${val}" class="form-input">
                <button type="button" class="dynamic-btn remove" onclick="this.parentElement.remove()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>`;
            list.appendChild(div);
            input.value = '';
            input.focus();
        }

        document.getElementById('createFeatureInput').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') { e.preventDefault(); addCreateDynamic('features', 'createFeatureInput', 'createFeaturesList'); }
        });
        document.getElementById('createTechInput').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') { e.preventDefault(); addCreateDynamic('tech_stack', 'createTechInput', 'createTechList'); }
        });

        // Ensure any pending text is added before submit
        document.querySelector('form').addEventListener('submit', function() {
            addCreateDynamic('features', 'createFeatureInput', 'createFeaturesList');
            addCreateDynamic('tech_stack', 'createTechInput', 'createTechList');
        });
    </script>
</body>
</html>
