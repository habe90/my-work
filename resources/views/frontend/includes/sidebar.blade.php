<div class="dashboard-navbar overlio-top">
    @include('frontend.includes.bottom_mobile')
    <div class="d-user-avater">
        @if (Auth::check())
            <!-- Provjera da li je korisnik prijavljen -->
            @if (Auth::user()->user_type == 'company')
                <!-- Logika za firme -->
                <img src="{{ Auth::user()->image ? Auth::user()->image : asset('frontend/img/no-image.jpg') }}"
                    class="img-fluid rounded" alt="Firma">
                <h4>#{{ Auth::user()->name }}</h4> <!-- Prikazuje ID firme -->
                <span><i class="ti-location-pin"></i>{{ Auth::user()->address }}</span>
                <span><i class="ti-user"></i> {{ Auth::user()->user_type }}</span>
            @else
                <!-- Logika za obične korisnike -->
                <img src="{{ Auth::user()->image ? Auth::user()->image : asset('frontend/img/no-image.jpg') }}"
                    class="img-fluid rounded" alt="{{ Auth::user()->name }}">
                <h4>{{ Auth::user()->name }}</h4>
                <span><i class="ti-location-pin"></i>{{ Auth::user()->address }}</span>
                <span><i class="ti-user"></i> {{ Auth::user()->user_type }}</span>
            @endif
        @endif
    </div>



    <div class="d-navigation">
        <ul id="metismenu">
            @if (Auth::user()->user_type == 'company')
                <li class="{{ request()->is('company-dashboard') ? 'active' : '' }}">
                    <a href="{{ route('company.dashboard') }}"><i
                            class="ti-dashboard"></i>{{ __('global.client-nav.dashboard') }}</a>
                </li>
                <li class="{{ request()->is('user-reviews') ? 'active' : '' }}">
                    <a href="{{ route('review.show') }}"><i
                            class="ti-star"></i>{{ __('global.client-nav.reviews') }}</a>
                </li>
                <li class="{{ request()->is('bookmarks/view') ? 'active' : '' }}">
                    <a href="{{ route('bookmarks.index') }}"><i
                            class="ti-bookmark"></i>{{ __('global.client-nav.bookmarks') }}</a>
                </li>
                <li class="{{ request()->is('bids') ? 'active' : '' }}">
                    <a href="{{ route('bids.index') }}"><i
                            class="ti-briefcase"></i>{{ __('global.client-nav.bids') }}</a>
                </li>
            @else
                <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('user.dashboard') }}"><i
                            class="ti-dashboard"></i>{{ __('global.client-nav.dashboard') }}</a>
                </li>
            @endif
            <li class="{{ request()->is('user/my-profile') ? 'active' : '' }}"><a
                    href="{{ route('users.profile') }}"><i
                        class="ti-user"></i>{{ __('global.client-nav.profile') }}</a></li>
            <li class="{{ request()->is('user/messages') ? 'active' : '' }}">
                <a href="{{ route('messages.index') }}">
                    <i class="ti-email"></i>{{ __('global.client-nav.messages') }}
                    @php
                        $unreadConversations = \App\Models\ImConversation::getUnreadConversations();
                        $unreadCount = $unreadConversations['all'];
                    @endphp
                    @if ($unreadCount > 0)
                        <span class="badge badge-danger">{{ $unreadCount }}</span>
                    @endif
                </a>
            </li>

            @can('reviews_access')
                <li><a href="#"><i class="fa fa-star"></i>{{ __('global.reviews') }}</a></li>
            @endcan

            @can('job_access')
                <li
                    class="{{ request()->is('manage-task', 'manage-bidders', 'active-jobs', 'post-job') ? 'active' : '' }}">
                    <a href="javascript:void(0);" class="has-arrow" aria-expanded="false"><i class="ti-desktop"></i>
                        {{ __('panel.client-nav.jobs') }}</a>
                    <ul>
                        @php
                            $newBidsCount = \App\Models\Bid::whereHas('job', function ($query) {
                                $query->where('user_id', auth()->id());
                            })
                                ->where('status', 'pending')
                                ->count();
                        @endphp

                        <li>
                            <a href="{{ route('bids.index') }}">
                                {{ __('panel.client-nav.manage_bids') }}
                                @if ($newBidsCount > 0)
                                    <span class="badge badge-danger">{{ $newBidsCount }}</span>
                                @endif
                            </a>
                        </li>


                        <li><a href="{{ route('my-jobs') }}">{{ __('panel.client-nav.active_jobs') }}</a></li>
                        <li><a href="/">{{ __('panel.client-nav.post_job') }}</a></li>
                    </ul>
                </li>
            @endcan
            <li class="add-listing dark-bg">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="ti-power-off"></i> {{ __('panel.logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>

        </ul>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var sidebarToggle = document.getElementById('sidebarToggle');
        var sidebar = document.getElementById('sidebar');

        sidebarToggle.addEventListener('click', function(e) {
            e.preventDefault();
            sidebar.classList.toggle('open');
        });
    });
</script>
