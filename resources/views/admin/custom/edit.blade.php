@extends('admin.layouts.app')

@section('content')

<div class="card">
  <div class="card-header bg-dark text-white">تعديل بيانات العميل</div>
  <div class="card-body">

    <form action="{{ url('admin/custom/' . $custom->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <label> </label><br>
        <img src="{{ asset('storage/' . $custom->img) }}" width="150" class="rounded-circle mb-3"><br><br>

        <label>تحديث الصورة</label>
        <input type="file" name="img" class="form-control"><br>
        
      
        <button type="submit" class="btn btn-success">تحديث</button>
    </form>

  </div>
</div>

@endsection
