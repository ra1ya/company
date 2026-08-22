@extends('admin.layouts.app')

@section('content')

<div class="card">
  
  <div class="card-header bg-dark text-white">صفحة عرض الخبر</div>
  <div class="card-body">
     <img src="{{ asset('storage/' . $news->img) }}" alt="News Img" width="100"class="rounded-circle mb-3" >
    <h5 class="card-title">  {{ $news->title }}</h5>
   
    <h5 class="card-title"></h5>
    
    <h5 class="card-title"> {{ $news->det }}</h5>
  </div>
</div>

@endsection
