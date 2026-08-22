@extends('admin.layouts.app')

@section('content')

<div class="card">
  <div class="card-header bg-dark text-white">
    <h4 class="mb-0">تعديل المقال</h4>
  </div>
  <div class="card-body">

    <form action="{{ url('admin/say/' . $say->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PATCH')

      <div class="mb-3">
        <label for="name" class="form-label">الاسم</label>
        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $say->name) }}">
        @error('name')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="des" class="form-label">صفته</label>
        <input type="text" id="des" name="des" class="form-control @error('des') is-invalid @enderror" value="{{ old('des', $say->des) }}">
        @error('des')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="say" class="form-label">المقال</label>
        <textarea id="say" name="say" class="form-control @error('say') is-invalid @enderror" rows="5" required>{{ old('say', $say->say) }}</textarea>
        @error('say')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">الصورة الحالية</label><br>
        <img src="{{ asset('storage/' . $say->img) }}" width="100" alt="الصورة الحالية" class="rounded-circle mb-3"><br>
      </div>

      <div class="mb-4">
        <label for="img" class="form-label">تحديث الصورة</label>
        <input type="file" id="img" name="img" class="form-control @error('img') is-invalid @enderror" accept=".svg,.png,.jpg,.jpeg,.webp">
        @error('img')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn btn-success px-4">تحديث</button>
    </form>

  </div>
</div>

@endsection
