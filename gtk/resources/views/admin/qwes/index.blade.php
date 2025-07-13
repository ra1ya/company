@extends('admin.layouts.app')

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">الأسئلة الشائعة</h4>
        <a href="{{ url('admin/qwes/create') }}" class="btn btn-success btn-sm">
            <i class="fa fa-plus" aria-hidden="true"></i> إضافة جديد
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>الإجابة</th>
                        <th>السؤال</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($qwes as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                          <td>{{ Str::limit(strip_tags($item->ans), 80) }}</td>
                        <td>{{ Str::limit(strip_tags($item->qwe), 80) }}</td>

                      
                        <td>
                            <div class="d-flex justify-content-center gap-2 flex-wrap">
                                <a href="{{ url('admin/qwes/' . $item->id) }}" class="btn btn-info btn-sm" title="عرض">
                                    <i class="fa fa-eye"></i> عرض
                                </a>
                                <a href="{{ url('admin/qwes/' . $item->id . '/edit') }}" class="btn btn-primary btn-sm" title="تعديل">
                                    <i class="fa fa-pencil-square-o"></i> تعديل
                                </a>
                                <form method="POST" action="{{ url('admin/qwes/' . $item->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')" title="حذف">
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
