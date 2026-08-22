@extends('admin.layouts.app')

@section('content')

<div class="card">
  <div div class="card-header bg-dark text-white">صفحة عرض الاسئلة </div>
  <div class="card-body">
    <h5 class="card-title">{{ $qwes->qwe }}</h5>
    <h5 class="card-title">{{ $qwes->ans }}</h5>
 
    
  </div>
</div>

@endsection
