@extends('dashboard.layouts.master')

<title>إدارة المسؤولين</title>

@section('content')

    @include('dashboard.partials.errors')
    @include('dashboard.partials.success')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <h2>عرض بياانت مسؤول</h2>
            </div>
            <div class="pull-left">
                <a class="btn btn-primary" href="{{ route('dashboard.admins.index') }}"> الخلف</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>الاسم:</strong>
            {{ $admin->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <strong>البريد الالكتروني:</strong>
        {{ $admin->email }}
    </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <strong>الادوار:</strong>
        @if(!empty($admin->getRoleNames()))
            @foreach($admin->getRoleNames() as $v)
                <label class="badge badge-success">{{ $v }}</label>
            @endforeach
        @endif
    </div>
    </div>
    </div>
@endsection
