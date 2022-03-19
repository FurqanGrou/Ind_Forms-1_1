@extends('dashboard.layouts.master')

<title>إدارة الادوار</title>

@section('content')

    @include('dashboard.partials.errors')
    @include('dashboard.partials.success')

    @can('اضافة-الادوار')
        <a class="btn btn-success mb-2" href="{{ route('dashboard.roles.create') }}"> إنشاء دور جديد</a>
    @endcan

    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>الاسم</th>
            <th width="280px">خيارات</th>
        </tr>
        @foreach ($roles as $key => $role)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('dashboard.roles.show', $role->id) }}">
                        <i class="la la-eye"></i>
                        عرض
                    </a>

                    <a class="btn btn-primary" href="{{ route('dashboard.roles.edit', $role->id) }}">
                        <i class="la la-pencil"></i>
                        تعديل
                    </a>

                    @can('حذف-الادوار')
                        <form action="{{ route('dashboard.roles.destroy', $role->id) }}" method="POST" style="display: inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">
                                <i class="la la-trash"></i>
                                حذف
                            </button>
                        </form>
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>
    {!! $roles->render() !!}
@endsection
