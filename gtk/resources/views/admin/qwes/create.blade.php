@extends('admin.layouts.app')

@section('content')
 
<div class="card">
  <div div class="card-header bg-dark text-white">الاسئلة الشائعة</div>
  <div class="card-body">
      
    <form action="{{ url('admin/qwes') }}" method="post" enctype="multipart/form-data">
      @csrf
      
      <label>السؤال</label><br>
      <input type= "text"  name="qwe" class="form-control" required><br>

      <label>الاجابة</label><br>
  
      <textarea id="ans" name="ans" class="form-control @error('ans') is-invalid @enderror" rows="5" required></textarea><br>
     
  
      <input type="submit" value="اضافة" class="btn btn-success">
  </form>
  
  
   
  </div>
</div>
 
@stop