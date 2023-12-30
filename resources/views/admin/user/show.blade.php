@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container text-center">
                <h6 class="card-title">
                    {{-- Naslov --}}
                    {{ trans('global.view') }}
                    {{ trans('cruds.user.title_singular') }}:
                    {{ trans('cruds.user.fields.id') }}
                    <span class="font-bold">:{{ $user->id }}</span>
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-8">
    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <tbody>
            <tr>
                <th class="py-2 px-4 bg-gray-100 font-semibold">ID</th>
                <td class="py-2 px-4">{{ $user->id }}</td>
            </tr>
            <tr>
                <th class="py-2 px-4 bg-gray-100 font-semibold">Name</th>
                <td class="py-2 px-4">{{ $user->name }}</td>
            </tr>
            <tr>
                <th class="py-2 px-4 bg-gray-100 font-semibold">Address</th>
                <td class="py-2 px-4">{{ $user->address }}</td>
            </tr>
            <tr>
                <th class="py-2 px-4 bg-gray-100 font-semibold">Phone</th>
                <td class="py-2 px-4">{{ $user->phone }}</td>
            </tr>
            <tr>
                <th class="py-2 px-4 bg-gray-100 font-semibold">Email</th>
                <td class="py-2 px-4">
                    <a class="text-blue-500" href="mailto:{{ $user->email }}">
                        <i class="far fa-envelope fa-fw"></i>
                        {{ $user->email }}
                    </a>
                </td>
            </tr>
            <tr>
                <th class="py-2 px-4 bg-gray-100 font-semibold">Email Verified At</th>
                <td class="py-2 px-4">{{ $user->email_verified_at }}</td>
            </tr>
            <tr>
                <th class="py-2 px-4 bg-gray-100 font-semibold">Roles</th>
                <td class="py-2 px-4">
                    @foreach($user->roles as $key => $entry)
                        <span class="badge badge-relationship">{{ $entry->title }}</span>
                    @endforeach
                </td>
            </tr>
            <tr>
                <th class="py-2 px-4 bg-gray-100 font-semibold">Locale</th>
                <td class="py-2 px-4">{{ $user->locale }}</td>
            </tr>
            <tr>
                <th class="py-2 px-4 bg-gray-100 font-semibold">User Type</th>
                <td class="py-2 px-4">{{ $user->user_type }}</td>
            </tr>
        </tbody>
    </table>
</div>

            <div class="form-group flex justify-between my-4 mx-4">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
                @can('user_edit')
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary bg-indigo-600">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection