@extends('admin.layouts.app')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">عرض الأخبار</h4>
        <a href="{{ url('admin/news/create') }}" class="btn btn-success btn-sm">
            <i class="fa fa-plus"></i> إضافة خبر جديد
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>العنوان</th>
                        <th>التفاصيل</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($news as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ Str::limit($item->det, 50) }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2 flex-wrap">
                                <a href="{{ url('admin/news/' . $item->id) }}" title="عرض" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i> عرض
                                </a>
                                <a href="{{ url('admin/news/' . $item->id . '/edit') }}" title="تعديل" class="btn btn-primary btn-sm">
                                    <i class="fa fa-pencil-square-o"></i> تعديل
                                </a>
                                <form method="POST" action="{{ url('admin/news/' . $item->id) }}">
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
