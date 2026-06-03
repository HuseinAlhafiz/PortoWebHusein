<section class="blog" id="blog">
    <div class="container">
        <span class="section-label" style="text-transform: capitalize;">Blog</span>
        <h2 class="section-title">Publikasi / Blog</h2>
        <p class="section-subtitle">Beberapa artikel dan case study yang saya publikasikan di Medium dan platform lainnya</p>
        
        <div class="blog-grid">
            @forelse($blogs as $blog)
                @if($blog->link)
                    <a href="{{ $blog->link }}" target="_blank" style="text-decoration: none; color: inherit; display: block;">
                @else
                    <div style="text-decoration: none; color: inherit; display: block;">
                @endif
                
                <div class="blog-card">
                     @if($blog->image)
                         <img src="{{ asset('storage/' . $blog->image) }}" class="blog-image" alt="{{ $blog->title }}">
                     @else
                         <img src="https://images.unsplash.com/photo-1542831371-29b0f74f9713?auto=format&fit=crop&w=600&q=80" class="blog-image" alt="{{ $blog->title }}">
                     @endif
                     <div class="blog-content">
                         <h3>{{ $blog->title }}</h3>
                         <p style="margin-bottom: 0.5rem;">{{ $blog->description }}</p>
                         @if($blog->link)
                             <span style="font-weight: 600; font-size: 0.9rem; text-decoration: underline; color: var(--primary, #007aff);">Baca selengkapnya &rarr;</span>
                         @endif
                     </div>
                </div>
                
                @if($blog->link)
                    </a>
                @else
                    </div>
                @endif
            @empty
                <p style="color: var(--text-muted); text-align: center; grid-column: 1 / -1;">Belum ada publikasi atau blog yang ditambahkan.</p>
            @endforelse
        </div>
    </div>
</section>
