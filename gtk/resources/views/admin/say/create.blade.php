@extends('admin.layouts.app')

@section('content')

<div class="card">
  <div class="card-header bg-dark text-white">
    <h4 class="mb-0">إضافة مقال جديد</h4>
  </div>
  <div class="card-body">
    <form action="{{ url('admin/say') }}" method="post" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label for="name" class="form-label">الاسم</label>
        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" required>
        @error('name')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="des" class="form-label">صفته</label>
        <input type="text" id="des" name="des" class="form-control @error('des') is-invalid @enderror" required>
        @error('des')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="say" class="form-label">ماذا قالوا؟</label>
        <textarea id="say" name="say" class="form-control @error('say') is-invalid @enderror" rows="5" required></textarea>
        @error('say')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-4">
        <label for="img" class="form-label">إضافة صورة</label>
        <input type="file" id="img" name="img" class="form-control @error('img') is-invalid @enderror" accept=".svg,.png,.jpg,.jpeg,.webp" required>
        @error('img')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- هنا المعاينة -->
        <div class="mt-3">
          <img id="preview-img" src="#" alt="معاينة الصورة" style="max-width: 250px; display: none; border: 1px solid #ddd; padding: 5px;">
        </div>
      </div>

      <button type="submit" class="btn btn-success px-4">إضافة مقال</button>
    </form>
  </div>
</div>

@endsection

@section('scripts')
<script>
  document.getElementById('img').addEventListener('change', function(event){
    const [file] = event.target.files;
    if(file){
      const preview = document.getElementById('preview-img');
      preview.src = URL.createObjectURL(file);
      preview.style.display = 'block';
    }
  });
</script>
@endsection
