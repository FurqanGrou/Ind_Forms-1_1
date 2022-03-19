@extends('dashboard.layouts.master')

<title>إدارة الادوار</title>

@section('content')

    @include('dashboard.partials.errors')
    @include('dashboard.partials.success')

    <form action="{{ route('dashboard.roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>الأسم:</strong>
                    <input type="text" name="name" placeholder="الأسم" class="form-control" value="{{ old('name', $role->name) }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>الصلاحيات:</strong>
                    <br/>
                    @foreach($permission as $value)
                        <label>
                            <input type="checkbox" name="permission[]" value="{{ $value->id }}" class="name" {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
                            {{ $value->name }}
                        </label>
                        <br/>
                    @endforeach
                </div>
            </div>
            <div class="ml-2 text-center">
                <button type="submit" class="btn btn-primary">حفظ</button>
            </div>
        </div>
    </form>

@endsection
