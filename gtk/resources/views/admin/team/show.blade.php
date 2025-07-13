@extends('admin.layouts.app')

@section('content')

<div class="card">
  <div class="card-header bg-dark text-white">
    <h4 class="mb-0">صفحة عرض عضو الفريق</h4>
  </div>
  <div class="card-body text-center">
    <img src="{{ asset('storage/' . $team->img) }}" alt="Team Img" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
    
    <h5 class="card-title">  الاسم : {{ $team->name }}</h5> 
    <h5 class="card-title">صفته : {{ $team->des}}</h5>
    <h5 class="card-title">{{ $team->code }}</h5>
    

  </div>
</div>

@endsection

