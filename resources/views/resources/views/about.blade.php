<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tentang Aplikasi — Sistem Pendukung Keputusan Menu Kantin STMIK Mardira Indonesia</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-50 text-slate-900 overflow-x-hidden">

    <nav class="flex justify-between items-center px-8 py-6 max-w-7xl mx-auto">
        <a href="{{ url('/') }}" class="text-2xl font-bold text-[#E63912]">Kantin STMIK Mardira Indonesia</a>
        <div class="space-x-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-slate-600 hover:text-[#E63912] transition font-medium">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-slate-600 hover:text-[#E63912] transition font-medium">Login</a>
                <a href="{{ route('register') }}" class="bg-[#E63912] text-white px-5 py-2.5 rounded-full hover:bg-[#CC3210] transition shadow-lg shadow-[#E63912]/20 font-medium">Register</a>
            @endauth
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-8 py-12 lg:py-16 space-y-16">

        {{-- Hero / intro --}}
        <section class="text-center space-y-6 animate-fade-in">
            <span class="inline-block bg-[#E63912]/10 text-[#E63912] text-sm font-semibold px-4 py-1.5 rounded-full">
                Tentang Aplikasi
            </span>
            <h1 class="text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight">
                Sistem Pendukung Keputusan <span class="text-[#E63912]">Pemilihan Menu Kantin</span>
            </h1>
            <p class="text-lg text-slate-600 max-w-2xl mx-auto leading-relaxed">
                Aplikasi ini dibangun untuk membantu proses pengambilan keputusan dalam memilih menu
                kantin di lingkungan STMIK Mardira Indonesia, dengan pendekatan yang terukur dan
                berbasis data, bukan sekadar tebakan atau kebiasaan.
            </p>
        </section>

        {{-- Apa itu SPK --}}
        <section class="bg-white rounded-2xl shadow-xl shadow-slate-200/60 border border-slate-100 p-8 lg:p-10 animate-fade-in">
            <h2 class="text-2xl font-bold mb-4">Apa itu Sistem Pendukung Keputusan (SPK)?</h2>
            <p class="text-slate-600 leading-relaxed">
                Sistem Pendukung Keputusan (SPK) adalah sebuah sistem berbasis komputer yang
                membantu pengambil keputusan dalam memilih alternatif terbaik dari sejumlah
                pilihan, dengan mempertimbangkan beberapa kriteria sekaligus. Pada aplikasi ini,
                SPK digunakan untuk menentukan menu kantin mana yang paling sesuai berdasarkan
                kriteria seperti harga, rasa, ketersediaan bahan, dan preferensi pengguna.
            </p>
        </section>

        {{-- Fitur utama --}}
        <section class="animate-fade-in">
            <h2 class="text-2xl font-bold mb-8 text-center">Fitur Utama</h2>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

                <div class="bg-white rounded-xl shadow-lg shadow-slate-200/50 border border-slate-100 p-6 hover:-translate-y-1 transition transform">
                    <div class="w-12 h-12 rounded-lg bg-[#E63912]/10 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#E63912]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">Penilaian Berbasis Kriteria</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Setiap menu dinilai berdasarkan beberapa kriteria yang sudah ditentukan,
                        sehingga hasil rekomendasi lebih objektif dan bisa dipertanggungjawabkan.
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-lg shadow-slate-200/50 border border-slate-100 p-6 hover:-translate-y-1 transition transform">
                    <div class="w-12 h-12 rounded-lg bg-[#E63912]/10 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#E63912]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 012-2h2a2 2 0 012 2v6m-6 0h6m-6 0H5a2 2 0 01-2-2V7a2 2 0 012-2h2m10 0h2a2 2 0 012 2v10a2 2 0 01-2 2h-2m-6-4h.01"/></svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">Perangkingan Menu Otomatis</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Sistem menghitung dan mengurutkan menu dari yang paling direkomendasikan
                        hingga yang paling tidak sesuai, sehingga keputusan lebih cepat diambil.
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-lg shadow-slate-200/50 border border-slate-100 p-6 hover:-translate-y-1 transition transform">
                    <div class="w-12 h-12 rounded-lg bg-[#E63912]/10 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#E63912]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">Laporan & Riwayat Keputusan</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Hasil perhitungan dan rekomendasi dapat dilihat kembali sebagai riwayat,
                        membantu evaluasi menu kantin dari waktu ke waktu.
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-lg shadow-slate-200/50 border border-slate-100 p-6 hover:-translate-y-1 transition transform">
                    <div class="w-12 h-12 rounded-lg bg-[#E63912]/10 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#E63912]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 15a3 3 0 100-6 3 3 0 000 6z"/></svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">Antarmuka Sederhana</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Tampilan dirancang agar mudah digunakan, baik oleh pengelola kantin maupun
                        mahasiswa yang ingin melihat rekomendasi menu.
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-lg shadow-slate-200/50 border border-slate-100 p-6 hover:-translate-y-1 transition transform">
                    <div class="w-12 h-12 rounded-lg bg-[#E63912]/10 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#E63912]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">Manajemen Pengguna</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Mendukung login dan registrasi, sehingga setiap pengguna dapat memiliki
                        akses dan riwayat penggunaannya masing-masing.
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-lg shadow-slate-200/50 border border-slate-100 p-6 hover:-translate-y-1 transition transform">
                    <div class="w-12 h-12 rounded-lg bg-[#E63912]/10 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#E63912]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">Rekomendasi Lebih Akurat</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Dengan menggabungkan beberapa kriteria sekaligus, rekomendasi yang
                        dihasilkan lebih mendekati kebutuhan nyata dibandingkan pemilihan manual.
                    </p>
                </div>

            </div>
        </section>

        {{-- CTA --}}
        <section class="text-center bg-white rounded-2xl shadow-xl shadow-slate-200/60 border border-slate-100 p-10 animate-fade-in">
            <h2 class="text-2xl font-bold mb-3">Siap mencoba?</h2>
            <p class="text-slate-600 mb-6 max-w-lg mx-auto">
                Daftar sekarang dan mulai gunakan sistem pendukung keputusan untuk menemukan
                menu kantin terbaik sesuai kebutuhan Anda.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('register') }}" class="bg-[#E63912] text-white px-8 py-4 rounded-xl font-semibold hover:bg-[#CC3210] transition transform hover:-translate-y-1 shadow-xl shadow-[#E63912]/30">
                    Mulai Sekarang
                </a>
                <a href="{{ url('/') }}" class="border border-slate-300 bg-white px-8 py-4 rounded-xl font-semibold hover:border-[#E63912] hover:text-[#E63912] transition shadow-sm">
                    Kembali ke Beranda
                </a>
            </div>
        </section>

    </main>

    <style>
        .animate-fade-in { animation: fadeIn 1s ease-in-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</body>
</html>
