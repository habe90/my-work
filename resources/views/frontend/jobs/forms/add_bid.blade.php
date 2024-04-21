<form class="proposal-form" method="POST" action="{{ route('proposals.store') }}">
    @csrf
    <input type="hidden" name="job_id" value="{{ $job->id }}">
    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="form-group">
                <label>{{ __('global.your_price') }}</label>
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
                <label>{{ __('global.cover_letter') }}</label>
                <textarea class="form-control" name="comment" rows="3"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="_terms_policy">
                <div class="_mercurt10">
                    <input id="tm" class="checkbox-custom" name="terms" type="checkbox">
                    <label for="tm" class="checkbox-custom-label"></label>
                </div>
                <div>{{ __('global.agree_terms') }} <a href="{{ __('global.terms_and_conditions_link') }}">{{ __('global.terms_and_conditions') }}</a>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <button type="submit" class="btn_proposal_send">{{ __('global.send_proposal') }}</button>
        </div>
    </div>
</form>
