@extends('dashboard.layouts.master')

<title>إدارة المسؤولين</title>

@section('content')

    @include('dashboard.partials.errors')
    @include('dashboard.partials.success')

    @can('اضافة-المسؤولين')
        <a class="btn btn-success mb-2" href="{{ route('dashboard.admins.create') }}"> اضافة مسؤول جديد</a>
    @endcan

    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>الاسم</th>
            <th>البريد الالكتروني</th>
            <th>الأدوار</th>
            <th width="280px">خيارات</th>
        </tr>

        @foreach ($data as $key => $admin)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>
                    @if(!empty($admin->getRoleNames()))
                        @foreach($admin->getRoleNames() as $roleName)
                            <label class="badge badge-success">{{ $roleName }}</label>
                        @endforeach
                    @endif
                </td>
                <td>

                    <a class="btn btn-info" href="{{ route('dashboard.admins.show', $admin->id) }}">
                        <i class="la la-eye"></i>
                        عرض
                    </a>

                    @can('تعديل-المسؤولين')
                        <a class="btn btn-primary" href="{{ route('dashboard.admins.edit', $admin->id) }}">
                            <i class="la la-pencil"></i>
                            تعديل
                        </a>
                    @endcan

                    @can('حذف-المسؤولين')
                        <form action="{{ route('dashboard.admins.destroy', $admin->id) }}" method="POST" style="display: inline">
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
    {!! $data->render() !!}

@endsection
