<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-2 text-sm text-gray-500">
            <a href="{{ route('penilaian.index') }}" class="hover:text-indigo-600">Penilaian</a>
            <span>/</span>
            <span class="text-gray-900 font-semibold">{{ $menu->nama_menu }}</span>
        </div>
    </x-slot>

    <div class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
            
            <div class="lg:grid lg:grid-cols-12 lg:gap-x-12">
                
                <div class="lg:col-span-5">
                    <div class="aspect-video lg:aspect-square w-full rounded-2xl bg-gray-100 overflow-hidden shadow-sm border border-gray-100">
                        @if($menu->foto)
                            <img src="{{ asset('storage/' . $menu->foto) }}" class="h-full w-full object-cover">
                        @else
                            <div class="h-full w-full flex items-center justify-center text-gray-400">Tidak ada foto</div>
                        @endif
                    </div>
                    
                    <h1 class="mt-6 text-3xl font-extrabold text-gray-900 tracking-tight">{{ $menu->nama_menu }}</h1>
                    <p class="mt-2 text-2xl font-semibold text-indigo-600">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                    <p class="mt-4 text-gray-600 leading-relaxed">{{ $menu->deskripsi ?: 'Tidak ada deskripsi rinci untuk menu ini.' }}</p>

                    <hr class="my-8 border-gray-200">

                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Ulasan Pelanggan</h3>
                        
                        <div class="flex items-center mb-3">
                            <div class="flex items-center space-x-1 text-yellow-400">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-6 h-6 {{ $i <= round($averageRating) ? 'text-yellow-400' : 'text-gray-300' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                                    </svg>
                                @endfor
                            </div>
                            <p class="ms-2 text-lg font-bold text-gray-900">{{ number_format($averageRating, 1) }} <span class="text-sm font-normal text-gray-500">out of 5</span></p>
                        </div>
                        <p class="text-sm font-medium text-gray-500">{{ $totalVoters }} Penilaian Global</p>
                        
                        <div class="mt-6 space-y-3">
                            @foreach([5, 4, 3, 2, 1] as $star)
                            <div class="flex items-center">
                                <span class="text-sm font-medium text-indigo-600 w-12">{{ $star }} star</span>
                                <div class="w-full h-3 mx-4 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-3 bg-yellow-400 rounded-full" style="width: {{ $ratingPercentages[$star] }}%"></div>
                                </div>
                                <span class="text-sm font-medium text-gray-500 w-8">{{ $ratingPercentages[$star] }}%</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mt-12 lg:mt-0 lg:col-span-7 bg-gray-50 p-8 rounded-2xl border border-gray-100 shadow-sm self-start">
                    <h2 class="text-xl font-bold text-gray-900 mb-2">Berikan Penilaian Anda</h2>
                    <p class="text-sm text-gray-500 mb-8">Klik bintang untuk memberikan nilai pada masing-masing kriteria menu ini.</p>
                    
                    <form action="{{ route('penilaian.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                        <div class="space-y-6">
                            @foreach($kriteria as $k)
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                                <div class="mb-2 sm:mb-0">
                                    <label class="text-base font-semibold text-gray-800">{{ $k->nama_kriteria }}</label>
                                    <p class="text-xs text-gray-400 uppercase tracking-wider">{{ $k->sifat }}</p>
                                </div>
                                
                                <div x-data="{ rating: {{ $penilaian->get($k->id)->nilai ?? 0 }}, hover: 0 }" class="flex items-center space-x-1">
                                    
                                    <input type="hidden" name="data[{{$k->id}}]" x-model="rating" required>
                                    
                                    <template x-for="star in 5">
                                        <svg @click="rating = star" 
                                             @mouseover="hover = star" 
                                             @mouseleave="hover = 0"
                                             :class="(hover || rating) >= star ? 'text-yellow-400 scale-110' : 'text-gray-300'"
                                             class="w-8 h-8 cursor-pointer transition-all duration-150" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/>
                                        </svg>
                                    </template>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <button type="submit" class="mt-8 w-full bg-indigo-600 text-white py-4 rounded-xl font-bold text-lg hover:bg-indigo-700 hover:shadow-lg transition-all transform hover:-translate-y-0.5">
                            Simpan Penilaian
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>