@extends('admin.layouts.app')

@section('content')

<div class="card">
  <div div class="card-header bg-dark text-white">تعديل الخبر</div>
  <div class="card-body">

    <form action="{{ url('admin/news/' . $news->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <label> عنوان الخبر</label>
        <input type="text" name="title" class="form-control" value="{{ $news->title }}"><br>

        <label>الصورة الحالية</label><br>
        <img src="{{ asset('storage/' . $news->img) }}" width="100" class="rounded-circle mb-3"><br><br>

        <label>تحديث الصورة</label>
        <input type="file" name="img" class="form-control"><br>
        
        <label>التفاصيل</label>

        <textarea id="det" name="det" class="form-control @error('det') is-invalid @enderror" rows="5" required>{{ old('det', $news->det) }}</textarea>
        <br/>
        <button type="submit" class="btn btn-success">تحديث</button>
    </form>

  </div>
</div>

@endsection
