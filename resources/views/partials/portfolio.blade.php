<section class="portfolio" id="portfolio">
    <div class="container">
        <span class="section-label">Portfolio</span>
        <h2 class="section-title">Project</h2>
        <p class="section-subtitle">Berikut beberapa project yang pernah dikembangkan</p>
        
        <div class="portfolio-grid">
            @foreach($projects->take(6) as $item)
            <div class="portfolio-card">
                 @if($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" class="portfolio-image" alt="{{ $item->title }}">
                 @endif
                 <div class="portfolio-content">
                     <h3>{{ $item->title }}</h3>
                     <!-- Link opsional ke project detail asli -->
                     <a href="{{ route('project.show', $item) }}" class="link-outs">Lihat Disini</a>
                     <p>{{ Str::limit($item->description, 140) }}</p>
                 </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
