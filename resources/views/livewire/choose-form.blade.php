<div class="tab-content" id="tabContent">
    <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <h4>Form: {{ $categoryName ?? 'Nije odabrana kategorija' }}</h4>
        <input type="hidden" name="service_category_id" value="{{ $serviceCategoryId }}">
        {!! $dynamicForm !!}
    
    </div>
</div>
