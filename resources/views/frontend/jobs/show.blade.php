@extends('frontend.layouts.front')
@section('content')
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
                                        <div class="jb_types urgent">Urgent</div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="_jb_details01_last">
                            <ul class="_flex_btn">
                                <li><a href="#" class="_saveed_jb"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#" class="_applied_jb">Send Proposal</a></li>
                            </ul>
                        </div>

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
                                <h4 class="mb-0">Project Info</h4>
                                <div class="row">

                                    @if ($job->additional_details)
                                        @foreach ($job->additional_details as $detailKey => $detailValue)
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="_eltio_caption">
                                                    <div class="_eltio_caption_icon">
                                                        @php
                                                            $iconMap = [
                                                                'kvadratura' => 'ti-ruler',
                                                                'broj_vata' => 'ti-bolt',
                                                                // Dodajte ostale  ikone ovdje
                                                            ];
                                                            $icon = $iconMap[$detailKey] ?? 'ti-info-alt';
                                                        @endphp
                                                        <i class="{{ $icon }}"></i>
                                                    </div>
                                                    <div class="_eltio_caption_body">
                                                        @if (is_array($detailValue))
                                                            <!-- Ako je vrijednost niza takoder niz, koristite dodatnu foreach petlju -->
                                                            @foreach ($detailValue as $subKey => $subValue)
                                                                <h4>{{ ucfirst(str_replace('_', ' ', $subKey)) }}</h4>
                                                                <span>{{ $subValue }}</span>
                                                            @endforeach
                                                        @else
                                                            <!-- Ako je vrijednost niza jednostavan string ili broj, ispisite ga direktno -->
                                                            <h4>{{ ucfirst(str_replace('_', ' ', $detailKey)) }}</h4>
                                                            <span>{{ $detailValue }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="_wrap_box_slice">
                            <div class="_job_detail_single">
                                <h4>Job Description</h4>
                                <p>{!! $job->description !!}</p>
                            </div>

                            <div class="_job_detail_single">
                                <h4>Files Attachments</h4>
                                <div class="row">

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="_file_caption">
                                            <div class="_file_caption_flex">
                                                <div class="_eltio_caption_icon">
                                                    <img src="assets/img/pdf.png" class="img-fluid" alt="" />
                                                </div>
                                                <div class="_eltio_caption_body">
                                                    <h4>project_sample.pdf</h4>
                                                    <span>File size 25kb</span>
                                                </div>
                                            </div>
                                            <div class="_file_caption_right">
                                                <a href="javascript:void(0);"><i class="fa fa-download"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="_file_caption">
                                            <div class="_file_caption_flex">
                                                <div class="_eltio_caption_icon">
                                                    <img src="assets/img/word.png" class="img-fluid" alt="" />
                                                </div>
                                                <div class="_eltio_caption_body">
                                                    <h4>project_doc.docx</h4>
                                                    <span>File size 182 kb</span>
                                                </div>
                                            </div>
                                            <div class="_file_caption_right">
                                                <a href="javascript:void(0);"><i class="fa fa-download"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="_file_caption">
                                            <div class="_file_caption_flex">
                                                <div class="_eltio_caption_icon">
                                                    <img src="assets/img/picture.png" class="img-fluid" alt="" />
                                                </div>
                                                <div class="_eltio_caption_body">
                                                    <h4>Project_image.png</h4>
                                                    <span>File size 18 kb</span>
                                                </div>
                                            </div>
                                            <div class="_file_caption_right">
                                                <a href="javascript:void(0);"><i class="ti-image"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="_file_caption">
                                            <div class="_file_caption_flex">
                                                <div class="_eltio_caption_icon">
                                                    <img src="assets/img/txt-file.png" class="img-fluid" alt="" />
                                                </div>
                                                <div class="_eltio_caption_body">
                                                    <h4>Project_detail.txt</h4>
                                                    <span>File size 63 kb</span>
                                                </div>
                                            </div>
                                            <div class="_file_caption_right">
                                                <a href="javascript:void(0);"><i class="fa fa-download"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="_job_detail_single flexeo">
                                <div class="_job_detail_single_flex">
                                    <ul class="shares_jobs">
                                        <li>Share The Job</li>
                                        <li><a href="#" class="share fb"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" class="share tw"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#" class="share gp"><i class="fa fa-google"></i></a></li>
                                    </ul>
                                </div>

                                <div class="_exlio_buttons">
                                    <ul class="bottoms_applies">
                                        <li><a href="#" class="_saveed_jb">Save Project</a></li>
                                        <li><a href="#" class="_applied_jb">Send Proposal</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="_wrap_box_slice">,
                            @if($job->bids->isNotEmpty())
                            <div class="_job_detail_single">
                                <h4>Projektne Ponude ({{ $job->bids->count() }})</h4>
                                <div class="_proposal_bids_list">
                                    @foreach($bids as $bid)
                                        <div class="_proposal_bids_single">
                                            <div class="_proposal_bids_flex">
                                                <div class="_proposal_bids_thumb">
                                                    <!-- Umjesto placeholdera ubacite stvarnu sliku korisnika -->
                                                    <img src="{{ $bid->user->profile_photo_url }}" class="img-fluid circle" alt="{{ $bid->user->name }}" />
                                                </div>
                                                <div class="_proposal_bids_caption">
                                                    <h4><a href="freelancer-detail.html">{{ $bid->user->name }}<img src="assets/img/verify.svg" class="ml-1" width="12" alt=""></a></h4>
                                                    <div class="_locat124"><i class="ti-location-pin mr-1"></i>{{ $bid->user->location }}</div>
                                                    <div class="_freelance_review_10">
                                                        <!-- Ovdje ubacite logiku za prikaz zvjezdica i broja recenzija -->
                                                        <span class="_overall_rate high">{{ $bid->user->rating }}</span>
                                                        @for ($i = 0; $i < $bid->user->rating; $i++)
                                                            <i class="fa fa-star filled"></i>
                                                        @endfor
                                                        <a href="#" class="over_reviews_count">({{ $bid->user->reviews_count }} Reviews)</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="_proposal_bids_right">
                                                <div class="_freelancer_rate">
                                                    <h4>${{ $bid->amount }}</h4>
                                                    <span>{{ $bid->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                            
                                </div>
                           
                            </div>
                            {{ $bids->links() }}
                            @endif
                        </div>
                        @if(!$userHasMadeBid)
                        <div class="_wrap_box_slice">
                            <div class="_job_detail_single">
                                <h4>Send Proposal</h4>
                                <form class="proposal-form"  method="POST" action="{{ route('proposals.store') }}">
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
                                                <div>I agree to the <a
                                                        href="https://marketplace.exertiowp.com/terms-and-conditions/">terms
                                                        and conditions</a></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <button type="submit" class="btn_proposal_send">Send Proposal</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-sm-12">

                    <div class="_jb_summary light_box">
                        <div class="_jb_summary_largethumb">
                            <span>125 days left</span>
                            <img src="https://via.placeholder.com/640x440" class="img-fluid" alt="" />
                        </div>
                        <div class="_jb_summary_thumb">
                            <img src="https://via.placeholder.com/250x250" class="img-fluid" alt="" />
                        </div>
                        <div class="_jb_summary_caption">
                            <h4>Accenture Private Limited</h4>
                            <span>Since 10th July 2017</span>
                            <h4 class="pises_price">$35<sub>/hourly</sub></h4>
                        </div>
                        <div class="_jb_summary_body">

                            <div class="_view_profile_btns">
                                <a href="employer-detail.html" class="btn btn_emplo_eloi">View Profile</a>
                            </div>
                        </div>
                    </div>

                    <div class="_jb_summary light_box p-4">
                        <h4>Job Explain</h4>
                        <ul>
                            <li>Company:<span>Invision</span></li>
                            <li>Vacancy:<span>03 Open</span></li>
                            <li>Post Date:<span>10 Dec 2020</span></li>
                            <li>Expire Date:<span>10 Oct 2021</span></li>
                            <li>Location:<span>Canada, USA</span></li>
                            <li>Salary:<span>$40k - $80k</span></li>
                            <li>Rate:<span>$20-$25 hourly</span></li>
                            <li>Hours:<span>45h/week</span></li>
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
            if(successMessage) {
                Swal.fire({
                    title: 'Uspjeh!',
                    text: successMessage,
                    icon: 'success',
                    confirmButtonText: 'U redu'
                });
            }
        });
        </script>
        
@endsection
