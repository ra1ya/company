@extends('admin.layouts.app')

@section('content')

<div class="card">
  <div div class="card-header bg-dark text-white">تعديل الاسئلة</div>
  <div class="card-body">

    <form action="{{ url('admin/qwes/' . $qwes->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <label>السؤال</label>
        <input type="text" name="qwe" class="form-control" value="{{ $qwes->qwe }}"><br>
        
        
        <label>الاجابة</label>
     
        <textarea id="ans" name="ans" class="form-control @error('ans') is-invalid @enderror" rows="5" required>{{ old('ans', $qwes->ans) }}</textarea>
        
      

        <button type="submit" class="btn btn-success">تحديث</button>
    </form>

  </div>
</div>

@endsection
