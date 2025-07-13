@extends('admin.layouts.app')

@section('content')

<div class="card">
  <div class="card-header bg-dark text-white">تعديل الخدمة</div>
  <div class="card-body">

    <form action="{{ url('admin/services/' . $services->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <label>الاسم</label>
        <input type="text" name="name" class="form-control" value="{{ $services->name }}"><br>

        <label>الأيقونة الحالية:</label><br>
        <img src="{{ asset('storage/' . $services->icon) }}" width="100"><br><br>

        <label>تحديث الأيقونة:</label>
        <input type="file" name="icon" class="form-control"><br>

        <button type="submit" class="btn btn-success">تحديث</button>
    </form>

  </div>
</div>

@endsection
