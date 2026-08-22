@extends('admin.layouts.app')

@section('content')

<div class="card">
  <div class="card-header bg-dark text-white">
    <h4 class="mb-0">صفحة عرض صاحب المقال </h4>
  </div>
  <div class="card-body text-center">
    <img src="{{ asset('storage/' . $say->img) }}" alt="Team Img" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
    
    <h5 class="card-title"> {{ $say->name }}</h5> 
    <p class="card-text"> {{ $say->des }}</p> <br>
    <p class="card-text"><strong></strong> {{ $say->say }}</p>
  </div>
</div>

@endsection
