@extends('admin.layouts.app')

@section('content')

<div class="card">
  <div class="card-header bg-dark text-white">تعديل الخبر</div>
  <div class="card-body">

    <form action="{{ url('admin/team/' . $team->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <label> الاسم</label>
        <input type="text" name="name" class="form-control" value="{{ $team->name }}"><br>
         
        
        <label> صفته</label>
        <input type="text" name="des" class="form-control" value="{{ $team->des }}"><br>


        
        <label> رمز الصفة</label>
        <input type="text" name="code" class="form-control" value="{{ $team->code }}"><br>

        <label>الصورة الحالية</label><br>
        <img src="{{ asset('storage/' . $team->img) }}" width="100" class="rounded-circle mb-3"><br><br>

        <label>تحديث الصورة</label>
        <input type="file" name="img" class="form-control"><br>
      
        <button type="submit" class="btn btn-success">تحديث</button>
    </form>

  </div>
</div>

@endsection
