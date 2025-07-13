@extends('admin.layouts.app')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">عرض الخدمات</h4>
        <a href="{{ url('admin/services/create') }}" class="btn btn-success btn-sm">
            <i class="fa fa-plus" aria-hidden="true"></i> إضافة خدمة جديدة
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>اسم الخدمة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($services as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2 flex-wrap">
                                <a href="{{ url('admin/services/' . $item->id) }}" title="عرض" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i> عرض
                                </a>
                                <a href="{{ url('admin/services/' . $item->id . '/edit') }}" title="تعديل" class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil-square-o"></i> تعديل
                                </a>
                                <form method="POST" action="{{ url('admin/services/' . $item->id) }}">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-sm" title="حذف" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                        <i class="fa fa-trash-o"></i> حذف
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
