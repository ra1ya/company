@extends('admin.layouts.app')

@section('content')
 
<div class="card">
  <div class="card-header bg-dark text-white">اضافة العملاء</div>
  <div class="card-body">
      
    <form action="{{ url('admin/custom') }}" method="post" enctype="multipart/form-data">
      @csrf
      
   
      <label>اضافة صورة</label><br>
      <input type="file" name="img" class="form-control" accept=".svg,.png,.jpg,.jpeg,.webp" required><br>
       
      
      <input type="submit" value="اضافة عميل" class="btn btn-success">
  </form>
  
  
   
  </div>
</div>
 
@stop