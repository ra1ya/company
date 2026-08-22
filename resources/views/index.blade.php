<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Elegant Transparent Background</title>
    <style>
        body {
         
            background-size: cover; 
            background-position: center;
            background-repeat: no-repeat; 
            background-attachment: fixed; 
            background-color: rgba(255, 255, 255, 0.8); 
            background-blend-mode: overlay; 
            font-family: 'Roboto', sans-serif; 
            color: #444;
            line-height: 1.6; 
            padding: 20px; 
            text-align: center; 
        }

        nav {
            margin-top: 100px; /* المسافة من الأعلى */
            display: flex;
            flex-direction: column; 
            align-items: center;
        }

        a {
            display: block;
            width: 250px;
            margin: 15px 0; /* المسافة بين الروابط */
            padding: 12px 20px;
            text-decoration: none;
            background-color: rgba(255, 255, 255, 0.9); 
            color: #2d2d2d; 
            font-size: 18px;
            border-radius: 8px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
            transition: all 0.3s ease-in-out; 
        }

        a:hover {
            background-color: rgba(42, 0, 253, 0.974); 
            color: #fff; 
            transform: translateY(-5px); 
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); 
        }

        @media (max-width: 768px) {
            a {
                width: 90%; 
            }
        }
    </style>
</head>
<body>
    @if (Route::has('login'))
        <nav>
            @auth('web')
                <a href="{{ url('/dashboard') }}">
                    Dashboard
                </a>
            @else
            
            @endauth

            @auth('admin')
                <a href="{{ url('/admin/dashboard') }}">
                    Admin Dashboard
                </a>
            @else
            <a href="{{ route('admin.login') }}">Admin Log in</a>

                @if (Route::has('admin.register') && \App\Models\Admin::count() == 0)
                    <a href="{{ route('admin.register') }}">
                        Admin Register
                    </a>
                @endif
            @endauth


           
        </nav>
    @endif
</body>
</html>
