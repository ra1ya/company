@extends('admin.layouts.app')

@section('content')
 
<div class="card">
  <div class="card-header bg-dark text-white">services Page</div>
  <div class="card-body">
      
    <form action="{{ url('admin/services') }}" method="post" enctype="multipart/form-data">
      @csrf
      
      <label>اسم الخدمة</label><br>
      <input type="text" name="name" class="form-control" required><br>
  
      <label>أيقونة الخدمة (PNG/SVG)</label><br>
      <input type="file" name="icon" class="form-control" accept=".svg,.png,.jpg,.jpeg,.webp" required><br>
  
      <input type="submit" value="إضافة الخدمة" class="btn btn-success">
  </form>
  
  
   
  </div>
</div>
 
@stop