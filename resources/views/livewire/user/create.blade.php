<form wire:submit.prevent="submit" class="pt-3">

    <div class="grid grid-cols-2 gap-4 mx-4">

        <!-- First Row -->
        <div class="form-group {{ $errors->has('user.name') ? 'invalid' : '' }}">
            <label class="form-label required" for="name">{{ trans('cruds.user.fields.name') }}</label>
            <input class="form-input" type="text" name="name" id="name" required wire:model.defer="user.name">
            <div class="validation-message">
                {{ $errors->first('user.name') }}
            </div>
            <div class="help-block">
                {{ trans('cruds.user.fields.name_helper') }}
            </div>
        </div>

        <div class="form-group {{ $errors->has('user.address') ? 'invalid' : '' }}">
            <label class="form-label required" for="address">{{ trans('cruds.user.fields.address') }}</label>
            <input class="form-input" type="text" name="address" id="address" required
                wire:model.defer="user.address">
            <div class="validation-message">
                {{ $errors->first('user.address') }}
            </div>
            <div class="help-block">
                {{ trans('cruds.user.fields.address_helper') }}
            </div>
        </div>

        <!-- Second Row -->
        <div class="form-group {{ $errors->has('user.phone') ? 'invalid' : '' }}">
            <label class="form-label required" for="phone">{{ trans('cruds.user.fields.phone') }}</label>
            <input class="form-input" type="text" name="phone" id="phone" required
                wire:model.defer="user.phone">
            <div class="validation-message">
                {{ $errors->first('user.phone') }}
            </div>
            <div class="help-block">
                {{ trans('cruds.user.fields.phone_helper') }}
            </div>
        </div>

        <div class="form-group {{ $errors->has('user.email') ? 'invalid' : '' }}">
            <label class="form-label required" for="email">{{ trans('cruds.user.fields.email') }}</label>
            <input class="form-input" type="email" name="email" id="email" required
                wire:model.defer="user.email">
            <div class="validation-message">
                {{ $errors->first('user.email') }}
            </div>
            <div class="help-block">
                {{ trans('cruds.user.fields.email_helper') }}
            </div>
        </div>

        <!-- Third Row -->
        <div class="form-group {{ $errors->has('user.password') ? 'invalid' : '' }}">
            <label class="form-label required" for="password">{{ trans('cruds.user.fields.password') }}</label>
            <input class="form-input" type="password" name="password" id="password" required
                wire:model.defer="password">
            <div class="validation-message">
                {{ $errors->first('user.password') }}
            </div>
            <div class="help-block">
                {{ trans('cruds.user.fields.password_helper') }}
            </div>
        </div>

        
        <div class="form-group {{ $errors->has('user.locale') ? 'invalid' : '' }}">
            <label class="form-label" for="locale">{{ trans('cruds.user.fields.locale') }}</label>
            <input class="form-input" type="text" name="locale" id="locale" wire:model.defer="user.locale">
            <div class="validation-message">
                {{ $errors->first('user.locale') }}
            </div>
            <div class="help-block">
                {{ trans('cruds.user.fields.locale_helper') }}
            </div>
        </div>

        <!-- Fourth Row -->
        <div class="form-group {{ $errors->has('user.user_type') ? 'invalid' : '' }}">
            <label class="form-label required" for="user_type">{{ trans('cruds.user.fields.user_type') }}</label>
            <input class="form-input" type="text" name="user_type" id="user_type" required
                wire:model.defer="user.user_type">
            <div class="validation-message">
                {{ $errors->first('user.user_type') }}
            </div>
            <div class="help-block">
                {{ trans('cruds.user.fields.user_type_helper') }}
            </div>
        </div>

        <div class="form-group {{ $errors->has('roles') ? 'invalid' : '' }}">
            <label class="form-label required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
            <x-select-list class="form-input" required id="roles" name="roles" wire:model="roles"
                :options="$this->listsForFields['roles']" multiple />
            <div class="validation-message">
                {{ $errors->first('roles') }}
            </div>
            <div class="help-block">
                {{ trans('cruds.user.fields.roles_helper') }}
            </div>
        </div>
    </div>


    <div class="form-group flex justify-between my-4 mx-4">
        <a href="{{ route('admin.users.index') }}" class="btn btn-danger bg-danger">
            {{ trans('global.cancel') }}
        </a>
        <button class="btn btn-primary bg-indigo-600" type="submit">
            {{ trans('global.save') }}
        </button>
    </div>
</form>
