<div class="row">
    @foreach ($jobs as $job)
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="_jb_list72">
                <div class="jobs-like bookmark">
                    <label class="toggler toggler-danger"><input type="checkbox"><i class="fa fa-heart"></i></label>
                </div>
                <div class="_jb_list72_flex">
                    <div class="_jb_list72_first">
                        <div class="_jb_list72_yhumb small-thumb">
                            @if ($job->featured_image)
                                <a href="{{ route('jobs.show', ['job' => $job->id]) }}">
                                    <img src="{{ asset($job->featured_image) }}" class="img-fluid" alt="Featured Image">
                                </a>
                            @else
                                <a href="{{ route('jobs.show', ['job' => $job->id]) }}">
                                    <img src="https://via.placeholder.com/250x250" class="img-fluid" alt="Placeholder">
                                </a>
                            @endif
                        </div>
                        @if (Auth::check() && Auth::user()->status == 'active')
                        <div class="_jb_list72_cmrate">
                          
                                <a href="{{ route('jobs.show', ['job' => $job->id]) }}">
                                    Send offer
                                </a>
                        </div>
                        @else
                        <!-- Dodajte ovde poruku ako korisnik nema aktivni status -->
                    @endif
                    </div>
                    <div class="_jb_list72_last">
                        <div class="_times_jb">{{ $job->user->id }}</div>
                        <h4 class="_jb_title"><a
                                href="{{ route('jobs.show', ['job' => $job->id]) }}">{{ $job->title }}</a></h4>
                        <div class="_times_jb">{{ $job->location }}</div>
                   
                    </div>
                </div>
                <div class="_jb_list72_foot">
                    <div class="_times_jb">{{ \Carbon\Carbon::parse($job->created_at)->format('Y-m-d') }}</div>
                </div>

            </div>
        </div>
    @endforeach
    @if ($jobs->count() > $perPage * $currentPage)
        <div class="text-center mt-4">
            @if (Auth::check() && Auth::user()->status == 'active')
                <button wire:click="loadMore" class="btn btn-primary">Load More</button>
            @else
                <!-- Dodajte ovde poruku ako korisnik nema aktivni status -->
            @endif
        </div>
    @endif
</div>
