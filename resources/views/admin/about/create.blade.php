@extends('admin.layouts.app')

@section('content')
 
<div class="card">
  <div class="card-header bg-dark text-white">نبذة عن شركتنا</div>
  <div class="card-body">
      
    <form action="{{ url('admin/about') }}" method="post" enctype="multipart/form-data">
      @csrf
      
      <label>اكتب بالعربي</label><br>
     
      
      <textarea name="des_ar" class="form-control" rows="5" required></textarea><br>


      <label>اكتب بالانجليزي</label><br>
      
      <textarea name="des_en" class="form-control" rows="5" required></textarea><br>

      <input type="submit" value="اضافة" class="btn btn-success">
  </form>
  
  
   
  </div>
</div>
 
@stop