@extends('admin.layouts.app')

@section('content')
 
<div class="card">
  <div class="card-header bg-dark text-white">اضافة اعضاء الفريق</div>
  <div class="card-body">
      
    <form action="{{ url('admin/team') }}" method="post" enctype="multipart/form-data">
      @csrf
      
      <label>الاسم </label><br>
      <input type="text" name="name" class="form-control" required><br>
      
      
      <label>صفته</label><br>
      <input type="text" name="des" class="form-control" required><br>
     
      
      <label>رمز الصفة</label><br>
      <input type="text" name="code" class="form-control" required><br>
  

      <label>اضافة صورة</label><br>
      <input type="file" name="img" class="form-control" accept=".svg,.png,.jpg,.jpeg,.webp" required><br>
       
      <input type="submit" value="اضافة خبر" class="btn btn-success">
  </form>
  
  
   
  </div>
</div>
 
@stop