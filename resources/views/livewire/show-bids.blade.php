<!-- resources/views/livewire/show-bids.blade.php -->


    @forelse ($job->bids as $bid)
        <div class="col-xl-4 col-lg-6 col-md-6"  wire:key="bid-{{ $bid->id }}" wire:loading.remove>
            <div class="_dash_grid_box">
                <div class="_dash_remove_wrap"><a href="#" data-toggle="tooltip" data-placement="top" title="Remove" class="_trash_removeal" wire:click.prevent="deleteBid({{ $bid->id }})"><i class="fa fa-trash"></i></a></div>
                <div class="_dash_grid_box_thumb">
                    <img src="{{ $bid->user->image }}" class="img-fluid circle">
                </div>
                <div class="_dash_grid_box_caption">
                    <span class="_elopi_location"><i class="ti-location-pin mr-1"></i>{{ $bid->user->location }}</span>
                    <h4 class="_elcio_title"><a href="#">{{ $bid->user->company_id }}</a></h4>
                    <div class="_dash_usr_rates">
                        <span class="{{ $bid->user->rating >= 4.5 ? 'good' : ($bid->user->rating >= 4.0 ? 'mid' : 'high') }}">{{ $bid->user->rating }}</span>
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fa fa-star{{ $i <= $bid->user->rating ? ' filled' : '' }}"></i>
                        @endfor
                    </div>

                    <div class="_dash_usr_bid_rate">
                        <ul>
                            <li>${{ $bid->amount }}<span>{{ $bid->type }}</span></li>
                            <li>{{ $bid->delivery_time }} Days<span>Delivery Time</span></li>
                        </ul>
                    </div>

                    <div class="_dash_usr_actioned">
                        <ul>
                            <li><a href="#" wire:click.prevent="acceptBid({{ $bid->id }})" class="_download_cv"><i class="fa fa-check"></i>Accept Offer</a></li>

                            <li><a href="#" data-toggle="modal" data-target="#message" class="_send_message"><i class="fa fa-envelope"></i>Send Message</a></li>
                        </ul>
                    </div>
                </div>
         
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-info text-center mx-auto" role="alert">
                There are no active bids on this ad.
            </div>
        </div>
        
    @endforelse
    <!-- Indikator učitavanja -->
    <div class="col-xl-4 col-lg-6 col-md-6" wire:loading wire:target="deleteBid">
        <p>Deleting...</p>
    </div>

