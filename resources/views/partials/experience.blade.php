<section class="experience" id="experience" style="background: transparent; padding-top: 2rem;">
    <div class="container">
        <span class="section-label" style="text-transform: capitalize;">Work & Organisational Experience</span>
        <h2 class="section-title">Pengalaman Kerja & Organisasi</h2>

        <div class="cv-container"
            style="background: transparent; box-shadow: none; border: none; padding: 0; max-width: 1000px; margin-top: 2rem;">

            @forelse($experiences as $exp)
            <details class="cv-details" {{ $loop->first ? 'open' : '' }}>
                <summary class="cv-summary">
                    <div class="summary-content">
                         @if($exp->image)
                            @php
                                $isGunadarma = Str::contains($exp->image, 'gunadarma');
                                $logoWidth = $isGunadarma ? '85px' : '65px';
                                $logoHeight = $isGunadarma ? '85px' : '65px';
                                $marginRight = $isGunadarma ? '-15px' : '-5px';
                                $marginLeft = $isGunadarma ? '-10px' : '0px';
                                $marginTop = $isGunadarma ? '-10px' : '0px';
                                $marginBottom = $isGunadarma ? '-10px' : '0px';

                                if (Str::startsWith($exp->image, 'images/')) {
                                    $expImgPath = asset($exp->image);
                                } elseif (Str::contains($exp->image, '/')) {
                                    $expImgPath = asset('storage/' . $exp->image);
                                } else {
                                    $expImgPath = asset('images/' . $exp->image);
                                }
                            @endphp
                            <img src="{{ $expImgPath }}" alt="{{ $exp->title }} Logo" class="exp-logo" style="width: {{ $logoWidth }}; height: {{ $logoHeight }}; margin-right: {{ $marginRight }}; margin-left: {{ $marginLeft }}; margin-top: {{ $marginTop }}; margin-bottom: {{ $marginBottom }};">
                        @else
                            <div class="exp-logo" style="width: 65px; height: 65px; display:flex; align-items:center; justify-content:center; background: var(--bg-hover); border-radius: 8px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="var(--text-lighter)" stroke-width="2"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>
                            </div>
                        @endif
                        <h3 class="cv-title">{{ $exp->title }} <span style="font-weight: 500; color: var(--text-secondary); font-size: 1rem;">- {{ $exp->category }}</span></h3>
                    </div>
                    <div class="chevron">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </div>
                </summary>
                <div class="cv-body">
                    <div class="cv-subtitle" style="display:flex; justify-content:space-between; flex-wrap:wrap; margin-bottom: 0.8rem;">
                        @php
                            $parts = explode('|', $exp->description);
                            $role = trim($parts[0] ?? $exp->description);
                            $date = trim($parts[1] ?? '');
                        @endphp
                        <strong style="color: var(--text-primary);">{{ $role }}</strong>
                        @if($date)
                            <span class="cv-date" style="margin-left:0;">{{ $date }}</span>
                        @endif
                    </div>
                    @if($exp->features && count($exp->features) > 0)
                    <ul class="cv-desc">
                        @foreach($exp->features as $feature)
                        <li>{{ $feature }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </details>
            @empty
                <p style="text-align: center; color: #6b7280;">Belum ada data pengalaman kerja.</p>
            @endforelse

        </div>
    </div>
</section>