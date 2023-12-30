<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('permission.title') ? 'border-red-500' : '' }} mb-4 mx-4">
    <label class="block text-sm font-semibold text-gray-600" for="title">{{ trans('cruds.permission.fields.title') }}</label>
    <input
        class="form-input mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        type="text"
        name="title"
        id="title"
        required
        wire:model.defer="permission.title"
    />
    @if($errors->has('permission.title'))
        <div class="text-red-500 text-xs mt-1">{{ $errors->first('permission.title') }}</div>
    @endif
    <div class="text-gray-500 text-xs mt-1">{{ trans('cruds.permission.fields.title_helper') }}</div>
</div>


    <div class="form-group flex justify-between my-4 mx-4">
        <a href="{{ route('admin.permissions.index') }}" class="btn btn-danger bg-danger">
            {{ trans('global.cancel') }}
        </a>
        <button class="btn btn-primary bg-indigo-600" type="submit">
            {{ trans('global.save') }}
        </button>
    </div>
</form>