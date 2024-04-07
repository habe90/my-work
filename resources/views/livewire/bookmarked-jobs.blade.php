<div>
    @forelse($bookmarkedJobs as $bookmark) 

        <div class="_list_jobs_wraps mng_list shadow_0 border">
            <div class="_list_jobs_f1ex first">
                <div class="_list_110">
                    <div class="_list_110_thumb">
                        <!-- Ispravljena ruta za detaljan prikaz posla -->
                        <a href="{{ route('jobs.show', $bookmark->job->id) }}"><img src="{{ $bookmark->job->featured_image ?: 'https://via.placeholder.com/250x250' }}" class="img-fluid" alt="{{ $bookmark->job->title }}"></a>
                    </div>
                    <div class="_list_110_caption">
                        <h4 class="_jb_title"><a href="{{ route('jobs.show', $bookmark->job->id) }}">{{ $bookmark->job->title }}</a></h4>
                        <ul class="_grouping_list">
                            <!-- Ostali podaci o poslu -->
                            {{-- <li><span><i class="ti-briefcase"></i>{{ $bookmark->job->service_category_id }}</span></li> --}}
                            <li><span><i class="ti-location-pin"></i>{{ $bookmark->job->location }}</span></li>
                            <li><span><i class="ti-timer"></i>{{ $bookmark->job->created_at->diffForHumans() }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="_list_jobs_f1ex">
                <!-- Link za uklanjanje posla iz bookmarkova -->
                <a href="#" class="_jb_apply">Entfernen</a>
            </div>
        </div>
    @empty
        <!-- Prikaži poruku ako nema sačuvanih poslova -->
        <p>{{ __('cruds.bookmark.no_bookmarked_jobs') }}</p>
    @endforelse
</div>
