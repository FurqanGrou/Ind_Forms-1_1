@extends('dashboard.layouts.master')

<title>Users Management</title>

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <h2>إضافة مسؤول جديد</h2>
            </div>
            <div class="pull-left">
                <a class="btn btn-primary" href="{{ route('dashboard.admins.index') }}"> الخلف</a>
            </div>
        </div>
    </div>

    @include('dashboard.partials.errors')
    @include('dashboard.partials.success')

    <form action="{{ route('dashboard.admins.store') }}" method="POST">
        @csrf

        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>الاسم:</strong>
            <input type="text" name="name" placeholder="الاسم" class="form-control" value="{{ old('name') }}">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <strong>البريد الالكتروني:</strong>
        <input type="email" name="email" placeholder="البريد الالكتروني" class="form-control" value="{{ old('email') }}">
    </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <strong>كلمة المرور:</strong>
        <input type="password" name="password" placeholder="كلمة المرور" class="form-control">
    </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <strong>تأكيد كلمة المرور:</strong>
        <input type="password" name="confirm-password" placeholder="تأكيد كلمة المرور" class="form-control">
    </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <strong>الدور:</strong>
        <select name="roles[]" id="" class="form-control" multiple>
            @foreach($roles as $role)
                <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
        </select>
    </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <button type="submit" class="btn btn-primary">حفظ</button>
    </div>
    </div>

    </form>
@endsection
