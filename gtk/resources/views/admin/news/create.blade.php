@extends('admin.layouts.app')

@section('content')
 
<div class="card">
  <div div class="card-header bg-dark text-white">news Page</div>
  <div class="card-body">
      
    <form action="{{ url('admin/news') }}" method="post" enctype="multipart/form-data">
      @csrf
      
      <label>عنوان الخبر</label><br>
      <input type="text" name="title" class="form-control" required><br>
  
      <label>اضافة صورة</label><br>
      <input type="file" name="img" class="form-control" accept=".svg,.png,.jpg,.jpeg,.webp" required><br>
       
      <label>التفاصيل</label><br>
      <textarea id="det" name="det" class="form-control @error('det') is-invalid @enderror" rows="5" required></textarea><br>
     
      <input type="submit" value="اضافة خبر" class="btn btn-success">
  </form>
  
  
   
  </div>
</div>
 
@stop

