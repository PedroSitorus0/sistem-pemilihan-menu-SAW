<x-app-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Dashboard Utama</h1>
    </x-slot>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        
        <div class="bg-[#a3e635] border-4 border-black rounded-2xl shadow-[8px_8px_0_0_rgba(0,0,0,1)] p-8 mb-10">
            <h2 class="text-4xl font-black text-black">Selamat datang, {{ explode(' ', auth()->user()->nama)[0] }}!</h2>
            <p class="mt-2 text-lg font-bold text-gray-800">Sistem Pendukung Keputusan Pemilihan Menu Kantin siap digunakan.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <a href="{{ route('saw.hasil') }}" class="block bg-white border-4 border-black rounded-2xl shadow-[6px_6px_0_0_rgba(0,0,0,1)] p-6 hover:-translate-y-1 hover:shadow-[10px_10px_0_0_rgba(0,0,0,1)] transition-all">
                <div class="text-5xl mb-4"></div>
                <h3 class="text-xl font-black text-black uppercase">Lihat Peringkat</h3>
                <p class="text-gray-600 font-medium mt-1">Cek menu apa yang menempati posisi pertama hari ini.</p>
            </a>

            <a href="{{ route('penilaian.index') }}" class="block bg-[#ff90e8] border-4 border-black rounded-2xl shadow-[6px_6px_0_0_rgba(0,0,0,1)] p-6 hover:-translate-y-1 hover:shadow-[10px_10px_0_0_rgba(0,0,0,1)] transition-all">
                <div class="text-5xl mb-4"></div>
                <h3 class="text-xl font-black text-black uppercase">Beri Penilaian</h3>
                <p class="text-gray-900 font-medium mt-1">Partisipasi Anda membantu keakuratan algoritma SAW.</p>
            </a>

            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'dev')
            <a href="{{ route('saw.index') }}" class="block bg-[#60A5FA] border-4 border-black rounded-2xl shadow-[6px_6px_0_0_rgba(0,0,0,1)] p-6 hover:-translate-y-1 hover:shadow-[10px_10px_0_0_rgba(0,0,0,1)] transition-all">
                <div class="text-5xl mb-4"></div>
                <h3 class="text-xl font-black text-black uppercase">Panel Admin</h3>
                <p class="text-gray-900 font-medium mt-1">Pantau matriks keputusan dan normalisasi data.</p>
            </a>
            @endif

        </div>

    </div>
</x-app-layout>