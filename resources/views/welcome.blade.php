<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>৪ সিগন্যাল ব্যাটালিয়ন</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom Styles */
        .card {
            width: 50%;
            max-width: 400px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            animation: fadeInDown 0.5s ease forwards;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 20vh;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            color: #fff;
            background-color: #6b7280;
            text-decoration: none;
            transition: background-color 0.3s ease;
            margin-bottom: 10px;
        }
        .btn:hover {
            background-color: #4b5563;
        }
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        /* Additional Styles */
        header, footer {
            width: 100%;
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        /* Ensure footer is always visible */
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }
        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        footer {
            background-color: white;
            color: #000000; /* Carbon black */
            text-align: center;
            padding: 20px 0; /* Adjust padding as needed */
        }
    </style>
</head>
<body class="antialiased">
    {{-- <header style="background-color: #333; color: #fff; padding: 20px; text-align: center;">
        <!-- Add your header content here -->
        <h1 style="font-family: 'figtree', sans-serif; font-size: 1.5rem; letter-spacing: 2px;">4 Signal Battalion</h1>
    </header> --}}
    
<main>
    <div>
        <img src="{{ asset('images/main_logo.png') }}" alt="Landing Image">

        
        <div >
            @if (Route::has('login'))
                <div class="text-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn mb-4 text-gray-100 bg-blue-500 hover:bg-blue-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn mb-4 mr-2 text-gray-100 bg-blue-500 hover:bg-blue-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">লগ-ইন</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn mb-4 text-gray-100 bg-blue-500 hover:bg-blue-700 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">রেজিস্টার</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </div>
    
</main>

<footer>
    <!-- Add your footer content here -->
    <p>Developed with <i class="fa fa-heart" ></i> by Captain Salman</p>
</footer>
</body>

</html>
