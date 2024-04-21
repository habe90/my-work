@extends('frontend.layouts.front')
@section('content')
<style>
    ._job_detail_single ul li:before{
    content: none;
}

</style>
    <!-- ============================ Page Title Start================================== -->
    <div class="page-title search-form dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">

                    <div class="_jb_details01">

                        <div class="_jb_details01_flex">
                            <div class="_jb_details01_authors">
                                <img src="{{ $job->featured_image }}" class="img-fluid" alt="" />
                            </div>
                            <div class="_jb_details01_authors_caption">
                                <h4 class="jbs_title">{{ $job->title }}<img src="assets/img/verify.svg" class="ml-1"
                                        width="12" alt=""></h4>
                                <ul class="jbx_info_list">
                                    <li><span><i class="ti-briefcase"></i>
                                            {{ $job->category ? $job->category->name : 'No category' }}</span></li>
                                    <li><span><i
                                                class="ti-location-pin"></i>{{ $job->category ? $job->user->address : 'No address set' }}</span>
                                    </li>
                                    <li><span><i class="ti-timer"></i>{{ $job->created_at->format('jS F Y') }}</span></li>
                                </ul>
                                <ul class="jbx_info_list">
                                    <li>
                                        <div class="jb_types {{ $job->status == 'active' ? 'fulltime' : ($job->status == 'pending' ? 'urgent' : '') }}">
                                            {{ $job->status }}
                                        </div>
                                    </li>
                                </ul>
                                
                            </div>
                        </div>

                        @php
                            $isBookmarked = $job->isBookmarkedByUser(auth()->id());
                            $isOwner = $job->user_id == auth()->id(); // Provjera da li je trenutni korisnik vlasnik oglasa
                        @endphp

                        @if (!$isOwner)
                            <!-- Ako korisnik nije vlasnik oglasa, prikaži opciju za dodavanje u bookmark-e -->
                            <div class="_jb_details01_last">
                                <ul class="_flex_btn">
                                    <li>
                                        <button type="button" id="bookmark-btn"
                                            class="_saveed_jb {{ $isBookmarked ? 'bookmarked' : '' }}"
                                            data-job-id="{{ $job->id }}"
                                            data-bookmarked="{{ $isBookmarked ? 'true' : 'false' }}">
                                            <i class="fa fa-heart {{ $isBookmarked ? 'fas' : 'far' }}"></i>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- ============================ Page Title End ================================== -->

    <!-- ============================ Main Section Start ================================== -->
    <section class="gray-light">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="_job_detail_box">

                        <div class="_wrap_box_slice">
                            <div class="_job_detail_single">
                                <h4 class="mb-0">{{ __('global.project_info') }}</h4>
                                <div class="row">
                                    @if ($job->additional_details)
                                        @php
                                            // Pretvorite JSON string u niz
                                            $additionalDetails = json_decode($job->additional_details, true);
                                        @endphp
                                        @if ($additionalDetails)
                                            @foreach ($additionalDetails as $detailKey => $detailValue)
                                                @if ($detailKey != 'service_type') 
                                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                                        <div class="_eltio_caption">
                                                            <div class="_eltio_caption_icon">
                                                                @php
                                                                    $iconMap = [
                                                                        'kvadratura' => 'ti-ruler',
                                                                        'broj_vata' => 'ti-bolt',
                                                                        'm2' => 'ti-bolt',
                                                                        'deadline' => 'ti-alarm-clock',
                                                                        'location' => 'ti-pin',
                                                                        'material' => 'ti-package',
                                                                        // Dodajte ostale ikone ovdje
                                                                    ];
                                                                    $icon = $iconMap[$detailKey] ?? 'ti-info-alt';
                                                                @endphp
                                                                <i class="{{ $icon }}"></i>
                                                            </div>
                                                            <div class="_eltio_caption_body">
                                                                @if (is_array($detailValue))
                                                                    @foreach ($detailValue as $subKey => $subValue)
                                                                        <h4>{{ ucfirst(str_replace('_', ' ', $subKey)) }}</h4>
                                                                        <span>{{ str_replace('_', ' ', $subValue) }}</span> 
                                                                    @endforeach
                                                                @else
                                                                    <h4>{{ ucfirst(str_replace('_', ' ', $detailKey)) }}</h4>
                                                                    <span>{{ str_replace('_', ' ', $detailValue) }}</span>
                                                                @endif
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                            @if (isset($additionalDetails['service_type']))
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="_eltio_caption">
                                                        <div class="_eltio_caption_icon">
                                                            <i class="ti-list" style="top: -30px;
                                                                position: relative;"></i>
                                                        </div>
                                                        <div class="_eltio_caption_body">
                                                            <h4>{{ __('global.service_type') }}</h4>
                                                            <ul>
                                                                @foreach ($additionalDetails['service_type'] as $service)
                                                                    <li>{{ $service }}</li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="_wrap_box_slice">
                            <div class="_job_detail_single">
                                <h4>{{ __('global.job_desc') }}</h4>
                                <p>{!! $job->description !!}</p>
                            </div>

                            {{-- <div class="_job_detail_single flexeo">
                                <div class="_job_detail_single_flex">
                                    <ul class="shares_jobs">
                                        <li>{{ __('global.share_link') }}</li>
                                        <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}"
                                                target="_blank" class="share fb"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="https://twitter.com/share?url={{ urlencode(Request::fullUrl()) }}&text={{ urlencode('Pogledajte ovaj posao na našoj stranici: ' . $job->title) }}"
                                                target="_blank" class="share tw"><i class="fa fa-twitter"></i></a></li>
                                      
                                    </ul>
                                </div>
                            </div> --}}
                        </div>

                        <div class="_wrap_box_slice">,
                            @if ($job->bids->isNotEmpty())
                                <div class="_job_detail_single">
                                    <h4>{{ __('panel.project_offers') }} ({{ $job->bids->count() }})</h4>
                                    <div class="_proposal_bids_list">
                                        @foreach ($bids as $bid)
                                            <div class="_proposal_bids_single">
                                                <div class="_proposal_bids_flex">
                                                    <div class="_proposal_bids_thumb">
                                                        <!-- Umjesto placeholdera ubacite stvarnu sliku korisnika -->
                                                        <img src="{{ $bid->user->image }}" class="img-fluid circle"
                                                            alt="{{ $bid->user->name }}" />
                                                    </div>
                                                    <div class="_proposal_bids_caption">
                                                        <h4><a href="#">{{ $bid->user->name }}<img
                                                                    src="assets/img/verify.svg" class="ml-1"
                                                                    width="12" alt=""></a></h4>
                                                        <div class="_locat124"><i
                                                                class="ti-location-pin mr-1"></i>{{ $bid->user->address }}
                                                        </div>
                                                        <div class="_freelance_review_10">
                                                            <!-- Prikaz zvjezdica i broja recenzija -->
                                                            <span
                                                                class="_overall_rate high">{{ $bid->user->rating }}</span>
                                                            @for ($i = 0; $i < 5; $i++)
                                                                @if ($i < $bid->user->rating)
                                                                    <i class="fa fa-star filled"></i>
                                                                @else
                                                                    <i class="fa fa-star"></i>
                                                                @endif
                                                            @endfor
                                                            <a href="#" class="over_reviews_count">
                                                                ({{ $bid->user->reviews_count }} {{ __('panel.reviews') }} )
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="_proposal_bids_right">
                                                    <div class="_freelancer_rate">
                                                        <h4>{{ $bid->amount }} €</h4>
                                                        <span>{{ $bid->created_at->diffForHumans() }}</span>
                                                        <span
                                                            class="badge badge-warning text-white">{{ $bid->status }}</span>
                                                            @if (auth()->id() === $bid->user_id && $bid->edit_count < 3)
                                                            @livewire('edit-bid', ['bid' => $bid])
                                                        @endif
                                                        
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                </div>
                                {{-- {{ $bids->links() }} --}}
                            @else
                                <div class="_job_detail_single">
                                    <h4>{{ __('global.project_offers') }} (0)</h4>
                                    <p>{{ __('global.no_offer') }}.</p>
                                </div>
                            @endif
                        </div>
                        @if (!$userHasMadeBid && auth()->user()->id !== $job->user_id)
                            <div class="_wrap_box_slice">
                                <div class="_job_detail_single">
                                    <h4>{{ __('global.send_proposal') }}</h4>
                                    <form class="proposal-form" method="POST" action="{{ route('proposals.store') }}">
                                        @csrf
                                        <input type="hidden" name="job_id" value="{{ $job->id }}">
                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                        <div class="row">

                                            <div class="col-lg-6 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Your Price</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">€</span>
                                                        </div>
                                                        <input type="text" name="amount" class="form-control">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="form-group">
                                                    <label>Cover Letter</label>
                                                    <textarea class="form-control" name="comment" rows="3"></textarea>
                                                </div>
                                            </div>

                                        </div>



                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="_terms_policy">
                                                    <div class="_mercurt10">
                                                        <input id="tm" class="checkbox-custom" name="terms"
                                                            type="checkbox">
                                                        <label for="tm" class="checkbox-custom-label"></label>
                                                    </div>
                                                    <div>{{ __('forms.agree_terms') }} <a
                                                            href="{{ __('global.terms_and_conditions_link') }}">{{ __('global.terms_and_conditions') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <button type="submit"
                                                    class="btn_proposal_send">{{ __('global.send_proposal') }}</button>
                                            </div>
                                        </div>


                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-success" role="alert">
                                {{ __('global.offer_error_message') }}
                            </div>
                        @endif

                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-sm-12">

                    <div class="_jb_summary light_box">
                        <div class="_jb_summary_largethumb">
                            <!-- Ovdje dodajete link koji omogućava Lightbox da otvori sliku u punoj veličini -->
                            <a href="{{ $job->featured_image ? $job->featured_image : 'https://via.placeholder.com/640x440' }}"
                                data-lightbox="job-gallery" data-title="Featured Image">
                                <img src="{{ $job->featured_image ? $job->featured_image : 'https://via.placeholder.com/640x440' }}"
                                    class="img-fluid" alt="" />
                            </a>
                        </div>

                        <!-- Ovdje počinje galerija slika -->
                                        
                    <div class="_jb_summary_thumb">
                        @foreach ($job->getMedia('image_gallery') as $image)
                            <a href="{{ $image->getUrl() }}" data-lightbox="job-gallery" data-title="Gallery Image">
                                <div class="gallery-image">
                                    <img src="{{ $image->getUrl() }}" class="img-fluid" alt="" />
                                </div>
                            </a>
                        @endforeach
                    </div>
                        <!-- Kraj galerije slika -->

                    </div>



                    <div class="_jb_summary light_box p-4">
                        <h4>{{ __('global.job_info') }}</h4>
                        <ul>
                            <li>{{ __('global.company') }}:
                                <span>{{ $job->user->company_name ?? __('global.not_available') }}</span>
                            </li>
                            <li>{{ __('global.post_date') }}:
                                <span>{{ $job->created_at ? $job->created_at->format('d M Y') : __('global.not_available') }}</span>
                            </li>
                            <li>{{ __('global.expire_date') }}:
                                <span>{{ $job->deadline ? \Carbon\Carbon::parse($job->deadline)->format('d M Y') : __('global.not_available') }}</span>
                            </li>
                            <li>{{ __('global.location') }}:
                                <span>{{ $job->location ?? __('global.not_available') }}</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- ============================ Main Section End ================================== -->
    <script>
        window.addEventListener('load', (event) => {
            const successMessage = "{{ session('successMessage') }}";
            if (successMessage) {
                Swal.fire({
                    title: 'Uspjeh!',
                    text: successMessage,
                    icon: 'success',
                    confirmButtonText: 'U redu'
                });
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $('#bookmark-btn').on('click', function() {
            var $this = $(this);
            var job_id = $this.data('job-id');
            var isBookmarked = $this.data('bookmarked');

            var ajaxUrl = isBookmarked ? "{{ route('bookmarks.destroy', '') }}/" + job_id :
                "{{ route('bookmarks.store') }}";
            var ajaxType = isBookmarked ? 'DELETE' : 'POST';

            $.ajax({
                url: ajaxUrl,
                type: ajaxType,
                data: {
                    _token: "{{ csrf_token() }}",
                    job_id: job_id
                },
                success: function(response) {
                    $this.data('bookmarked', !isBookmarked);
                    $this.toggleClass('bookmarked');
                    $this.find('i').toggleClass('fas far');

                    Swal.fire({
                        title: isBookmarked ? 'Wurde entfernt!' : 'Hinzugefügt!',
                        text: isBookmarked ? 'Der Job wurde aus Ihren Lesezeichen entfernt.' :
                            'Der Job wurde zu Ihren Lesezeichen hinzugefügt.',
                        icon: 'success',
                        confirmButtonText: 'In Ordnung'
                    });
                },
                error: function() {
                    Swal.fire({
                        title: 'Fehler!',
                        text: 'Ein Fehler ist aufgetreten.',
                        icon: 'error',
                        confirmButtonText: 'In Ordnung'
                    });
                }
            });
        });
    </script>
@endsection
