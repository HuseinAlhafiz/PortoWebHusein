<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Portfolio — Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --bg: #0a0a0f; --surface: rgba(255,255,255,0.03); --border: rgba(255,255,255,0.06);
            --text: #ffffff; --text-dim: rgba(255,255,255,0.5); --text-muted: rgba(255,255,255,0.3);
            --accent: #3b4fdf; --accent-2: #7c3aed;
        }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text); min-height: 100vh; display: flex; align-items: flex-start; justify-content: center; padding: 2rem 1.5rem; }
        .bg-glow { position: fixed; width: 400px; height: 400px; border-radius: 50%; filter: blur(120px); opacity: 0.08; pointer-events: none; }
        .bg-glow-1 { background: #3b4fdf; top: -150px; right: -100px; }
        .bg-glow-2 { background: #7c3aed; bottom: -150px; left: -100px; }

        .form-container { width: 100%; max-width: 600px; position: relative; z-index: 2; }
        .form-header { margin-bottom: 1.5rem; }
        .form-header .back-link { display: inline-flex; align-items: center; gap: 0.3rem; color: var(--text-muted); text-decoration: none; font-size: 0.82rem; font-weight: 500; margin-bottom: 1rem; transition: color 0.3s; }
        .form-header .back-link:hover { color: var(--accent); }
        .form-header .back-link svg { width: 16px; height: 16px; }
        .form-header h1 { font-family: 'Space Grotesk', sans-serif; font-size: 1.4rem; font-weight: 700; }
        .form-header p { font-size: 0.82rem; color: var(--text-dim); margin-top: 0.2rem; }

        .form-card { background: var(--surface); border: 1px solid var(--border); border-radius: 20px; padding: 1.5rem; }
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; font-size: 0.72rem; font-weight: 600; color: var(--text-dim); text-transform: uppercase; letter-spacing: 0.8px; margin-bottom: 0.4rem; }
        .form-input, .form-select, .form-textarea { width: 100%; padding: 0.65rem 0.9rem; background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 10px; color: #fff; font-size: 0.85rem; font-family: 'Inter', sans-serif; outline: none; transition: border-color 0.3s; }
        .form-input:focus, .form-select:focus, .form-textarea:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(59,79,223,0.1); }
        .form-textarea { min-height: 80px; resize: vertical; }
        .form-select option { background: #1a1a2e; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 0.8rem; }

        .file-upload { border: 2px dashed rgba(255,255,255,0.08); border-radius: 10px; padding: 1.2rem; text-align: center; cursor: pointer; transition: border-color 0.3s; }
        .file-upload:hover { border-color: var(--accent); }
        .file-upload svg { width: 28px; height: 28px; color: var(--text-muted); margin-bottom: 0.3rem; }
        .file-upload p { font-size: 0.75rem; color: var(--text-muted); }
        .file-upload input { display: none; }
        .preview-img { max-width: 180px; border-radius: 8px; margin-top: 0.5rem; }

        .dynamic-field { display: flex; gap: 0.5rem; margin-bottom: 0.4rem; align-items: center; }
        .dynamic-field .form-input { flex: 1; }
        .dynamic-btn { width: 32px; height: 32px; border-radius: 8px; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: all 0.2s; }
        .dynamic-btn svg { width: 16px; height: 16px; }
        .dynamic-btn.add { background: rgba(59,79,223,0.15); color: var(--accent); }
        .dynamic-btn.add:hover { background: rgba(59,79,223,0.25); }
        .dynamic-btn.remove { background: rgba(239,68,68,0.1); color: #f87171; }
        .dynamic-btn.remove:hover { background: rgba(239,68,68,0.2); }
        .dynamic-list { margin-bottom: 0.4rem; }

        .checkbox-row { display: flex; align-items: center; gap: 0.5rem; }
        .checkbox-row input[type="checkbox"] { accent-color: var(--accent); width: 15px; height: 15px; }
        .checkbox-row label { font-size: 0.82rem; color: var(--text-dim); text-transform: none; letter-spacing: 0; }

        .form-actions { display: flex; gap: 0.6rem; margin-top: 1.2rem; }
        .btn { display: inline-flex; align-items: center; gap: 0.4rem; padding: 0.6rem 1.2rem; border-radius: 10px; font-size: 0.82rem; font-weight: 600; font-family: 'Inter', sans-serif; cursor: pointer; border: none; text-decoration: none; transition: all 0.2s; }
        .btn-primary { background: linear-gradient(135deg, var(--accent), var(--accent-2)); color: white; }
        .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 8px 25px rgba(59,79,223,0.3); }
        .btn-ghost { background: transparent; color: var(--text-dim); border: 1px solid var(--border); }
        .btn-ghost:hover { border-color: rgba(255,255,255,0.15); color: var(--text); }
        .error-msg { font-size: 0.7rem; color: #f87171; margin-top: 0.2rem; }

        @media (max-width: 600px) { .form-row { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <div class="bg-glow bg-glow-1"></div>
    <div class="bg-glow bg-glow-2"></div>

    <div class="form-container">
        <div class="form-header">
            <a href="{{ route('dashboard') }}" class="back-link">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                Back to Dashboard
            </a>
            <h1>Edit Portfolio</h1>
            <p>{{ $portfolio->title }}</p>
        </div>

        <div class="form-card">
            @if($errors->any())
                <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); color: #f87171; padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem;">
                    <strong style="display: block; margin-bottom: 0.5rem; font-size: 0.9rem;">Please fix the following errors:</strong>
                    <ul style="margin-left: 1.5rem; font-size: 0.82rem;">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('portfolio.update', $portfolio) }}" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="form-row">
                    <div class="form-group">
                        <label>Type</label>
                        <select name="type" class="form-select" required>
                            <option value="project" {{ $portfolio->type == 'project' ? 'selected' : '' }}>📁 Project</option>
                            <option value="certificate" {{ $portfolio->type == 'certificate' ? 'selected' : '' }}>🎓 Certificate</option>
                            <option value="techstack" {{ $portfolio->type == 'techstack' ? 'selected' : '' }}>⚡ Tech Stack</option>
                        </select>
                        @error('type') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category" class="form-select" required>
                            <optgroup label="Project"><option value="Project" {{ $portfolio->category == 'Project' ? 'selected' : '' }}>Project</option><option value="Design" {{ $portfolio->category == 'Design' ? 'selected' : '' }}>Design</option><option value="Editing" {{ $portfolio->category == 'Editing' ? 'selected' : '' }}>Editing</option></optgroup>
                            <optgroup label="Certificate"><option value="Bootcamp" {{ $portfolio->category == 'Bootcamp' ? 'selected' : '' }}>Bootcamp</option><option value="Course" {{ $portfolio->category == 'Course' ? 'selected' : '' }}>Course</option><option value="Certification" {{ $portfolio->category == 'Certification' ? 'selected' : '' }}>Certification</option></optgroup>
                            <optgroup label="Tech Stack"><option value="Tool" {{ $portfolio->category == 'Tool' ? 'selected' : '' }}>Tool</option><option value="Language" {{ $portfolio->category == 'Language' ? 'selected' : '' }}>Language</option><option value="Framework" {{ $portfolio->category == 'Framework' ? 'selected' : '' }}>Framework</option></optgroup>
                        </select>
                        @error('category') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-input" value="{{ old('title', $portfolio->title) }}" required>
                    @error('title') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" class="form-textarea">{{ old('description', $portfolio->description) }}</textarea>
                    @error('description') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <div class="file-upload" onclick="document.getElementById('editImage').click()">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/></svg>
                        <p id="editFileName">{{ $portfolio->image ? 'Change file' : 'Upload file (max 10MB)' }}</p>
                        <input type="file" id="editImage" name="image" accept="image/*,application/pdf">
                    </div>
                    @if($portfolio->image)
                        @if(Str::endsWith($portfolio->image, '.pdf'))
                            <div id="editPreview" style="margin-top: 0.5rem; color: #ef4444; font-size: 0.8rem;">📄 Current file is a PDF Document</div>
                        @else
                            <img src="{{ asset('storage/' . $portfolio->image) }}" class="preview-img" id="editPreview">
                        @endif
                    @else
                        <img class="preview-img" id="editPreview" style="display:none;">
                    @endif
                    @error('image') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Live Demo URL</label>
                        <input type="url" name="link" class="form-input" value="{{ old('link', $portfolio->link) }}" placeholder="https://example.com">
                        @error('link') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label>GitHub URL</label>
                        <input type="url" name="github_link" class="form-input" value="{{ old('github_link', $portfolio->github_link) }}" placeholder="https://github.com/...">
                        @error('github_link') <span class="error-msg">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label>Features</label>
                    <div class="dynamic-list" id="editFeaturesList">
                        @if($portfolio->features)
                            @foreach($portfolio->features as $feat)
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
                        <input type="text" class="form-input" id="editFeatureInput" placeholder="Add feature" list="featureOptions">
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
                        <button type="button" class="dynamic-btn add" onclick="addEditDynamic('features', 'editFeatureInput', 'editFeaturesList')">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        </button>
                    </div>
                </div>

                <div class="form-group">
                    <label>Tech Stack</label>
                    <div class="dynamic-list" id="editTechList">
                        @if($portfolio->tech_stack)
                            @foreach($portfolio->tech_stack as $tech)
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
                        <input type="text" class="form-input" id="editTechInput" placeholder="Add technology" list="techOptions">
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
                        <button type="button" class="dynamic-btn add" onclick="addEditDynamic('tech_stack', 'editTechInput', 'editTechList')">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                        </button>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" class="form-input" value="{{ old('sort_order', $portfolio->sort_order) }}" min="0">
                    </div>
                    <div class="form-group" style="display:flex;align-items:flex-end;">
                        <div class="checkbox-row">
                            <input type="checkbox" id="editFeatured" name="is_featured" value="1" {{ $portfolio->is_featured ? 'checked' : '' }}>
                            <label for="editFeatured">Featured</label>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{ route('dashboard') }}" class="btn btn-ghost">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('editImage').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                document.getElementById('editFileName').textContent = file.name;
                const preview = document.getElementById('editPreview');
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

        function addEditDynamic(name, inputId, listId) {
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

        document.getElementById('editFeatureInput').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') { e.preventDefault(); addEditDynamic('features', 'editFeatureInput', 'editFeaturesList'); }
        });
        document.getElementById('editTechInput').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') { e.preventDefault(); addEditDynamic('tech_stack', 'editTechInput', 'editTechList'); }
        });

        // Ensure any pending text is added before submit
        document.querySelector('form').addEventListener('submit', function() {
            addEditDynamic('features', 'editFeatureInput', 'editFeaturesList');
            addEditDynamic('tech_stack', 'editTechInput', 'editTechList');
        });
    </script>
</body>
</html>
