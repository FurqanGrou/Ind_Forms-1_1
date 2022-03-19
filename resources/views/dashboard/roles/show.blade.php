@extends('dashboard.layouts.master')

<title>إدارة الادوار</title>

@section('content')

    @include('dashboard.partials.errors')
    @include('dashboard.partials.success')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <h2> عرض الدور وصلاحياته</h2>
            </div>
            <div class="pull-left">
                <a class="btn btn-primary" href="{{ route('dashboard.roles.index') }}"> الخلف</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>الأسم:</strong>
                {{ $role->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>الصلاحيات:</strong>
                @if(!empty($rolePermissions))
                    @foreach($rolePermissions as $permission)
                        <label class="label label-success">{{ $permission->name }},</label>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

@endsection
