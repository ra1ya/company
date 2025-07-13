@extends('admin.layouts.app')

@section('content')

<div class="card">
  <div class="card-header bg-dark text-white">صفحة عرض النبذة   </div>
  <div class="card-body">
    <h5 class="card-title">  {{ $about->des_ar }}</h5>
    <h5 class="card-title">  {{ $about->des_en }}</h5>
 
    
  </div>
</div>

@endsection
