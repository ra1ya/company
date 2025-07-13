<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="turbolinks-visit-control" content="reload">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
         
        .sidebar-header {
            background-color: #343a40; /* لون الخلفية الداكن */
            color: white; /* لون النص */
            text-align: center; /* توسيط النص */
            font-size: 18px; /* حجم الخط */
            font-weight: bold; /* سماكة الخط */
            padding: 16px; /* تباعد داخلي */
            border-bottom: 1px solid #ddd; /* خط سفلي لفصل الهيدر عن الروابط */
        }
        .sidebar {
    width: 220px;
    height: calc(100vh - 64px); /* التكيف مع الشاشة بدون الشريط العلوي */
    position: fixed;
    top: 64px; /* بعد الشريط العلوي */
    left: 0;
    background-color: #ffffff;
    border-right: 1px solid #ddd;
    z-index: 1000;  
    overflow-y: auto; /* إضافة شريط تمرير إذا كان المحتوى طويلًا */
   /*ملاحظة اذا كنت تريد روابط تنقر فاستخدم زد  اندكس وبوسشن ثفيكسد اما لو كان بدون زد اندكس لازم تخلي تخلي بوسشن ريلاتيف*/
}


        .sidebar a {
            display: block;
            color: #333;
            padding: 16px;
            text-decoration: none;
            font-size: 16px;
            border-bottom: 1px solid #ddd;
        }
        .sidebar a.active {
            background-color: #04AA6D;
            color: white;
            pointer-events: auto; /* تأكد من أن الرابط قابل للنقر */
        }
        .sidebar a:hover {
            background-color: #f5f5f5;
            color: #333;
          
        }

        .content {
          /*  margin-left: 165px; /* إزاحة تساوي عرض الشريط الجانبي */
        padding-left: 20%;
        padding-top: 70px;
        padding-right: 100px;
        position: relative; /* التأكد من تطبيق الترتيب بشكل صحيح */
        z-index: 0; /* أدنى من الشريط الجانبي */
       width: 1100px;
        
    }

        .navbar {
            background-color: #343a40;
        }

        .navbar-brand {
            color: white;
            
        }
        nav {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%; /* العرض الكامل */
    z-index: 10; /* التأكد من أنه في الأمام */
    background-color: #ffffff; /* لون الخلفية */
    border-bottom: 1px solid #ddd; /* خط سفلي */
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); /* ظل خفيف */
}

/* الحاوية الرئيسية */
.main-content {
    margin-top: 64px; /* إزاحة مساوية لارتفاع الشريط العلوي */
    padding: 20px; /* تباعد داخلي */
}

/* المحتوى الرئيسي */
.content-area {
    margin-left: 240px; /* إزاحة تساوي عرض الشريط الجانبي */
    padding: 20px;
}

/* تحسين التنقلات */
.nav-link {
    display: inline-block;
    padding: 10px 20px;
    color: #333;
    text-decoration: none;
    font-size: 16px;
    font-weight: 500;
    transition: background-color 0.3s, color 0.3s;
}

.nav-link:hover {
    background-color: #f5f5f5;
    color: #04AA6D;
}

.active {
    background-color: #04AA6D;
    color: white;
}

    </style>
</head>
<body>
   
    <div class="min-h-screen bg-gray-100 flex">
        <!-- Sidebar -->
         
        <div class="sidebar">
            
            <div class="sidebar-header">
                Admin Dashboard
            </div>
            <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.index') ? 'active' : '' }}">الخدمات</a>
            <a href="{{ route('admin.about.index') }}" class="{{ request()->routeIs('admin.about.index') ? 'active' : '' }}">النبذة</a>
            <a href="{{ route('admin.qwes.index') }}" class="{{ request()->routeIs('admin.qwes.index') ? 'active' : '' }}">الاسئلة الشائعة</a>
            <a href="{{ route('admin.news.index') }}" class="{{ request()->routeIs('admin.news.index') ? 'active' : '' }}">الاخبار</a>
            <a href="{{ route('admin.custom.index') }}" class="{{ request()->routeIs('admin.custom.index') ? 'active' : '' }}">  العملاء  </a>
            <a href="{{ route('admin.team.index') }}" class="{{ request()->routeIs('admin.team.index') ? 'active' : '' }}">  اعضاء فريق العمل</a>
            <a href="{{ route('admin.say.index') }}" class="{{ request()->routeIs('admin.say.index') ? 'active' : '' }}">  ماذا قالوا</a>
            
            
            
        </div>
        
        
        
        

        <!-- Content Area -->
        <div class="content">
            @include('admin.layouts.navigation')
            <main>
                @yield('content')
            </main>
        </div>
    </div>
    <script>
   document.querySelectorAll('.sidebar a').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        console.log(`Redirecting to: ${this.href}`);
        window.location.href = this.href;
    });
});


console.log("JavaScript is loaded");
    </script>
</body>

</html>
