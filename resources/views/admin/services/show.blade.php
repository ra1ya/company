@extends('admin.layouts.app')

@section('content')

<div class="card">
  <div class="card-header bg-dark text-white">صفحة عرض الخدمة</div>
  <div class="card-body">
    <h5 class="card-title">الاسم: {{ $services->name }}</h5>
    <h5 class="card-title">الأيقونة:</h5>
    <img src="{{ asset('storage/' . $services->icon) }}" alt="Service Icon" width="100">
    
  </div>
</div>

@endsection
