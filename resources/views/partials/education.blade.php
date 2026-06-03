<section class="education" id="education" style="background: var(--bg-alt); padding: 5rem 0;">
    <div class="container" style="text-align: center;">
        <span class="section-label" style="text-transform: capitalize; color: var(--accent); font-weight: 600;">Pendidikan & Bootcamp</span>
        <h2 class="section-title" style="color: var(--text-inverse); margin-top: 0.5rem;">Riwayat Pendidikan & Bootcamp</h2>
        <p class="section-subtitle" style="color: var(--text-lighter); font-size: 1.05rem; margin-bottom: 3.5rem;">Pernah dan sedang belajar pada program dan universitas berikut</p>
        
        <div class="logo-row" style="display: flex; align-items: center; justify-content: center; gap: 4rem; flex-wrap: wrap;">
            @forelse($educations as $edu)
                @if($edu->image)
                    @php
                        $imgPath = Str::startsWith($edu->image, 'images/') ? asset($edu->image) : asset('storage/' . $edu->image);
                        $isGunadarma = Str::contains($edu->image, 'gunadarma');
                        $logoHeight = $isGunadarma ? '120px' : '85px';
                    @endphp
                    <img src="{{ $imgPath }}" alt="{{ $edu->title }} Logo" title="{{ $edu->title }} - {{ $edu->description }}" style="height: {{ $logoHeight }}; width: auto; object-fit: contain; filter: grayscale(100%); opacity: 0.5; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); cursor: pointer;" onmouseover="this.style.filter='grayscale(0)'; this.style.opacity='1'; this.style.transform='scale(1.05)'" onmouseout="this.style.filter='grayscale(100%)'; this.style.opacity='0.5'; this.style.transform='scale(1)'">
                @endif
            @empty
                <p style="color: #9ca3af;">Belum ada data pendidikan.</p>
            @endforelse
        </div>
    </div>
</section>
