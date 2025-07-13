@extends('admin.layouts.app')

@section('content')

<div class="card">
  <div class="card-header bg-dark text-white">
    <h4 class="mb-0">صفحة عرض العملاء </h4>
  </div>
  <div class="card-body text-center">
    
    <img src="{{ asset('storage/' . $custom->img) }}" alt="Custom Img" width="150" class="rounded-circle mb-3"  height="">
   
  </div>
</div>

@endsection


