<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Pendukung Keputusan Menu Untuk Kantin di STMIK Mardira Indonesia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-50 text-slate-900 overflow-x-hidden">

    <nav class="flex justify-between items-center px-8 py-6 max-w-7xl mx-auto">
        <div class="text-2xl font-bold text-[#E63912]">Kantin STMIK Mardira Indonesia</div>
        <div class="space-x-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-slate-600 hover:text-[#E63912] transition font-medium">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-slate-600 hover:text-[#E63912] transition font-medium">Login</a>
                <a href="{{ route('register') }}" class="bg-[#E63912] text-white px-5 py-2.5 rounded-full hover:bg-[#CC3210] transition shadow-lg shadow-[#E63912]/20 font-medium">Register</a>
            @endauth
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-8 py-12 lg:py-20 flex flex-col lg:flex-row items-center gap-12">
        
        <div class="flex-1 space-y-6 animate-fade-in">
            <h1 class="text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight">
                Sistem Pendukung Keputusan <span class="text-[#E63912]">Pemilihan Menu</span>
            </h1>
            <p class="text-lg text-slate-600 max-w-lg leading-relaxed">
                Bingung memilih menu untuk kantin? Gunakan sistem pendukung keputusan kami untuk membantu Anda menentukan pilihan terbaik berdasarkan kriteria yang relevan. Dapatkan rekomendasi menu yang sesuai dengan preferensi dan kebutuhan Anda.
            </p>
            <div class="flex flex-wrap gap-4 pt-4">
                <a href="{{ route('register') }}" class="bg-[#E63912] text-white px-8 py-4 rounded-xl font-semibold hover:bg-[#CC3210] transition transform hover:-translate-y-1 shadow-xl shadow-[#E63912]/30">
                    Mulai Sekarang
                </a>
                <a href="#" class="border border-slate-300 bg-white px-8 py-4 rounded-xl font-semibold hover:border-[#E63912] hover:text-[#E63912] transition shadow-sm">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>

        <div class="flex-1 w-full max-w-lg relative animate-fade-in">
            <div class="aspect-video bg-white rounded-2xl shadow-2xl shadow-slate-200/60 border-4 border-white p-2 transform rotate-2 hover:rotate-0 transition-transform duration-500">
                
                <div class="w-full h-full bg-slate-100 rounded-xl overflow-hidden group">
                    <img src="{{ asset('test.png') }}" alt="Ilustrasi Kantin STMIK Mardira" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                </div>

            </div>
            
            <div class="absolute -z-10 -bottom-6 -right-6 w-72 h-72 bg-[#E63912]/20 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
        </div>
    </main>

    <style>
        .animate-fade-in { animation: fadeIn 1s ease-in-out; }
        @keyframes fadeIn { 
            from { opacity: 0; transform: translateY(20px); } 
            to { opacity: 1; transform: translateY(0); } 
        }
        .animate-blob { animation: blob 7s infinite; }
        @keyframes blob { 
            0% { transform: scale(1); } 
            33% { transform: scale(1.1); } 
            66% { transform: scale(0.9); } 
            100% { transform: scale(1); } 
        }
    </style>
</body>
</html>