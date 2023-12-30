@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="card bg-blueGray-100">
            <div class="card-header">
                <div class="card-header-container text-center">
                    <h6 class="card-title">
                        {{ trans('global.view') }}
                        {{ trans('cruds.permission.title_singular') }}:
                        {{ trans('cruds.permission.fields.id') }}
                        <span class="font-bold">:{{ $permission->id }}</span>
                    </h6>
                </div>
            </div>


            <div class="card-body">
                <div class="pt-3">
                    <table class="table table-view">
                        <tbody class="bg-white">
                            <tr>
                                <th>
                                    {{ trans('cruds.permission.fields.id') }}
                                </th>
                                <td>
                                    {{ $permission->id }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.permission.fields.title') }}
                                </th>
                                <td>
                                    {{ $permission->title }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="form-group flex justify-between my-4 mx-4">
                    <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">
                        {{ trans('global.back') }}
                    </a>
                    @can('permission_edit')
                        <a href="{{ route('admin.permissions.edit', $permission) }}" class="btn btn-primary bg-indigo-600">
                            {{ trans('global.edit') }}
                        </a>
                    @endcan
                </div>


            </div>
        </div>
    </div>
@endsection
