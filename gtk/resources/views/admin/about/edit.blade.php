@extends('admin.layouts.app')

@section('content')

<div class="card">
  <div class="card-header bg-dark text-white">تعديل النبذة</div>
  <div class="card-body">

    <form action="{{ url('admin/about/' . $about->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <label>اكتب بالعربي</label>
     
        <textarea name="des_ar" class="form-control" rows="5" required>{{ $about->des_ar }}</textarea><br>

        
        <label>اكتب بالانجليزي</label>
        <textarea name="des_en" class="form-control" rows="5" required>{{ $about->des_en }}</textarea><br>


    
      
      

        <button type="submit" class="btn btn-success">تحديث</button>
    </form>

  </div>
</div>

@endsection
