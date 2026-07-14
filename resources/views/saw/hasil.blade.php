<x-app-layout>
		    <x-slot name="header">
			<h2 class="font-semibold text-xl text-gray-900 tracking-tight">
			    Rekomendasi Menu
			</h2>
		    </x-slot>

		    <link rel="preconnect" href="https://fonts.googleapis.com">
		    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

		    <style>
			.font-display { font-family: 'Fraunces', serif; font-feature-settings: 'ss01' 1; }
			.font-mono { font-family: 'JetBrains Mono', monospace; }
			.gauge-ring { transition: stroke-dashoffset 0.8s cubic-bezier(0.65, 0, 0.35, 1); }
			.menu-card:hover .card-photo { transform: scale(1.05); }
			.card-photo { transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1); }
			
			/* Custom Dropdown Styles */
			.dropdown-toggle {
			    display: inline-flex;
			    align-items: center;
			    justify-content: space-between;
			    gap: 0.75rem;
			    width: 100%;
			    padding: 0.875rem 1rem;
			    background: white;
			    border: 1.5px solid #18120F;
			    border-radius: 0.75rem;
			    font-family: 'JetBrains Mono', monospace;
			    font-size: 0.875rem;
			    font-weight: 600;
			    color: #18120F;
			    cursor: pointer;
			    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
			}

			.dropdown-toggle:hover {
			    background-color: #F7F5F2;
			    border-color: #E63912;
			    box-shadow: 0 2px 8px rgba(230, 57, 18, 0.1);
			}

			.dropdown-toggle.active {
			    border-color: #E63912;
			    background-color: #FEF7F3;
			    box-shadow: 0 2px 8px rgba(230, 57, 18, 0.15);
			}

			.dropdown-toggle svg {
			    width: 1rem;
			    height: 1rem;
			    color: #E63912;
			    transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
			    flex-shrink: 0;
			}

			.dropdown-toggle.active svg {
			    transform: rotate(180deg);
			}

			.dropdown-menu {
			    position: absolute;
			    top: calc(100% + 0.5rem);
			    left: 0;
			    right: 0;
			    background: white;
			    border: 1.5px solid #18120F;
			    border-radius: 0.75rem;
			    overflow: hidden;
			    box-shadow: 0 8px 24px -8px rgba(24, 18, 15, 0.25);
			    z-index: 50;
			    opacity: 0;
			    visibility: hidden;
			    transform: translateY(-0.5rem);
			    transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
			    max-height: 380px;
			    overflow-y: auto;
			}

			.dropdown-menu.show {
			    opacity: 1;
			    visibility: visible;
			    transform: translateY(0);
			}

			.dropdown-menu option-item {
			    display: block;
			    padding: 0.875rem 1rem;
			    color: #18120F;
			    font-family: 'JetBrains Mono', monospace;
			    font-size: 0.875rem;
			    font-weight: 500;
			    cursor: pointer;
			    transition: all 0.15s ease;
			    border-left: 3px solid transparent;
			}

			.dropdown-menu option-item:hover {
			    background-color: #FEF7F3;
			    border-left-color: #E63912;
			    padding-left: calc(1rem - 3px + 3px);
			}

			.dropdown-menu option-item.selected {
			    background-color: #FEF7F3;
			    border-left-color: #E63912;
			    color: #E63912;
			    font-weight: 600;
			}

			.dropdown-container {
			    position: relative;
			    width: 100%;
			}

			/* Scrollbar styling untuk dropdown */
			.dropdown-menu::-webkit-scrollbar {
			    width: 6px;
			}

			.dropdown-menu::-webkit-scrollbar-track {
			    background: transparent;
			}

			.dropdown-menu::-webkit-scrollbar-thumb {
			    background: #D4CECC;
			    border-radius: 3px;
			}

			.dropdown-menu::-webkit-scrollbar-thumb:hover {
			    background: #948E86;
			}
		    </style>

		    <div class="py-12 bg-white min-h-screen">
			<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

			    <div class="mb-14 flex flex-col lg:flex-row justify-between items-start lg:items-end gap-8 pb-8 border-b border-[#EAE6DF]">
				<div>
				    <div class="flex items-center gap-2 mb-3">
				        <span class="w-1.5 h-1.5 rounded-full bg-[#E63912]"></span>
				        <span class="font-mono text-[11px] uppercase tracking-[0.18em] text-[#948E86]">Sistem Pendukung Keputusan</span>
				    </div>
				    <h1 class="font-display text-4xl sm:text-5xl font-semibold text-[#18120F] tracking-tight leading-[1.05]">
				        Menu terbaik<br class="hidden sm:block"> hari ini<span class="text-[#E63912]">.</span>
				    </h1>
				    <p class="mt-3 text-[#948E86] text-sm max-w-sm">Diurutkan berdasarkan skor SPK dari kombinasi kriteria yang Anda tetapkan.</p>
				</div>

				<div class="w-full sm:w-72">
        <label class="font-mono block mb-3 text-[11px] uppercase tracking-[0.15em] text-[#948E86]">
            Kategori
        </label>
        <div class="dropdown-container">
            <button type="button" class="dropdown-toggle" data-target="filterKategori-menu" aria-haspopup="listbox" aria-expanded="false">
                <span id="filterKategoriLabel">Semua Menu</span>
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
			<?php 
			//kategori 
			?>
            <select id="filterKategori" name="filterKategori" class="sr-only">
                <option value="all">Semua Menu</option>
                @foreach($kategoriList as $kat)
                    <option value="{{($kat) }}">{{ $kat }}</option>
                @endforeach
            </select>

            <div class="dropdown-menu" id="filterKategori-menu" role="listbox">
                <option-item value="all" class="selected">Semua Menu</option-item>
                @foreach($kategoriList as $kat)
                    <option-item value="{{($kat) }}">{{ $kat }}</option-item>
                @endforeach
            </div>
        </div>
    </div>

				<div class="w-full lg:w-72">
				    <label class="font-mono block mb-3 text-[11px] uppercase tracking-[0.15em] text-[#948E86]">
				        Urutkan berdasarkan
				    </label>
				    <div class="dropdown-container">
				        <button type="button" class="dropdown-toggle" id="sortMenuBtn" aria-haspopup="listbox" aria-expanded="false">
				            <span id="sortMenuLabel">Peringkat SPK (Rekomendasi Utama)</span>
				            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
				                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
				            </svg>
				        </button>

				        <select id="sortMenu" name="sortMenu" class="sr-only" aria-label="Urutkan berdasarkan">
				            <option value="spk_desc">Peringkat SPK (Rekomendasi Utama)</option>
				            @foreach($kriteria as $k)
				                <option value="kriteria_{{ $k->id }}_{{ $k->sifat }}">
				                    {{ $k->nama_kriteria }}
				                    @if(strtolower($k->sifat) == 'cost')
				                        (Termurah / Terendah)
				                    @else
				                        (Terbaik / Tertinggi)
				                    @endif
				                </option>
				            @endforeach
				        </select>

				        <div class="dropdown-menu" id="sortMenu-menu" role="listbox">
				            <option-item value="spk_desc" class="selected">Peringkat SPK (Rekomendasi Utama)</option-item>
				            @foreach($kriteria as $k)
				                <option-item value="kriteria_{{ $k->id }}_{{ $k->sifat }}">
				                    {{ $k->nama_kriteria }}
				                    @if(strtolower($k->sifat) == 'cost')
				                        (Termurah / Terendah)
				                    @else
				                        (Terbaik / Tertinggi)
				                    @endif
				                </option-item>
				            @endforeach
				        </div>
				    </div>
				</div>
			    </div>

			    <div id="menuContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-12">
				@php
				    $skorMax = collect($hasil)->max('skor') ?: 1;
				    $circumference = 2 * pi() * 26;
				@endphp

				@if(empty($hasil))
    <div class="col-span-full flex flex-col items-center justify-center py-20 px-4 text-center bg-white rounded-2xl border border-dashed border-[#DFDAD1]">
        <div class="w-16 h-16 mb-4 rounded-full bg-[#FEF7F3] flex items-center justify-center text-[#E63912]">
            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
            </svg>
        </div>
        <h3 class="font-display text-xl font-semibold text-[#18120F]">Belum Ada Rekomendasi</h3>
        <p class="text-[#948E86] mt-2 max-w-sm">Data menu atau penilaian masih kosong. Silakan tambahkan menu dan kriteria terlebih dahulu untuk melihat hasil SPK.</p>
    </div>
@endif 

				@foreach($hasil as $item)
				    @php
				        $persen = $skorMax > 0 ? min(100, ($item['skor'] / $skorMax) * 100) : 0;
				        $offset = $circumference - ($persen / 100) * $circumference;
				    @endphp
				    <div class="menu-card group flex flex-col bg-white rounded-2xl overflow-hidden transition-all duration-300 shadow-[0_1px_2px_rgba(24,18,15,0.06)] border border-[#EAE6DF] hover:shadow-[0_20px_32px_-16px_rgba(24,18,15,0.18)] hover:border-[#DFDAD1] hover:-translate-y-1"
				         data-skor="{{ $item['skor'] }}"
						 data-harga = {{$item['menu']->harga}}
						 data-kategori = {{$item['menu']->kategori}}
				         @foreach($item['kriteria_scores'] as $idKriteria => $nilai)
				             data-kriteria-{{ $idKriteria }}="{{ $nilai }}"
				         @endforeach
				    >
				        <div class="relative h-56 w-full bg-[#F7F5F2] overflow-hidden">
				            @if($item['menu']->foto)
				                <img src="{{ asset('storage/' . $item['menu']->foto) }}" class="card-photo w-full h-full object-cover">
				            @else
				                <div class="w-full h-full flex items-center justify-center text-[#C9C3B9] text-sm font-medium">No Image</div>
				            @endif

				            <div class="absolute inset-0 bg-gradient-to-t from-black/55 via-black/0 to-transparent"></div>

				            <div class="card-rank-number absolute bottom-3 left-4 font-display text-white text-3xl font-semibold drop-shadow-sm">
				                {{ str_pad($item['peringkat'], 2, '0', STR_PAD_LEFT) }}
				            </div>

				            <div class="top-badge hidden absolute top-3 right-3 inline-flex items-center gap-1.5 rounded-full bg-[#E63912] text-white px-3 py-1 text-[10px] font-mono uppercase tracking-wider shadow-md">
				                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 1l2.39 4.84 5.34.78-3.87 3.77.91 5.31L10 13.27l-4.77 2.43.91-5.31L2.27 6.62l5.34-.78L10 1z"/></svg>
				                Terbaik
				            </div>
				        </div>

				        <div class="p-5 flex-1 flex flex-col justify-between">
				            <div>
				                <h3 class="font-display text-xl font-semibold text-[#18120F] leading-snug">{{ $item['menu']->nama_menu }}</h3>
				                <p class="text-[#948E86] mt-1.5 text-sm line-clamp-2">{{ $item['menu']->deskripsi }}</p>
				            </div>

				            <div class="mt-6 flex justify-between items-center">
				                <div>
				                    <p class="font-mono text-[10px] uppercase tracking-wider text-[#948E86] mb-1">Harga</p>
				                    <p class="font-mono text-sm font-semibold text-[#18120F]">Rp {{ number_format($item['menu']->harga, 0, ',', '.') }}</p><br>
									<p class="font-mono text-[10px] uppercase tracking-wider text-[#948E86] mb-1">Kategori</p>
									<p class="font-mono text-sm font-semibold text-black"> {{ $item['menu']->kategori }}</p>
				                </div>

				                <div class="relative w-16 h-16 shrink-0">
				                    <svg class="w-16 h-16 -rotate-90" viewBox="0 0 64 64">
				                        <circle cx="32" cy="32" r="26" fill="none" stroke="#EAE6DF" stroke-width="4"/>
				                        <circle class="gauge-ring" cx="32" cy="32" r="26" fill="none"
				                                stroke="#18120F"
				                                stroke-width="4" stroke-linecap="round"
				                                stroke-dasharray="{{ $circumference }}"
				                                stroke-dashoffset="{{ $offset }}"
				                                data-circumference="{{ $circumference }}"
				                                data-skor="{{ $item['skor'] }}"
				                                data-skor-max="{{ $skorMax }}"/>
				                    </svg>
				                    <div class="absolute inset-0 flex items-center justify-center">
				                        <span class="font-mono text-[13px] font-semibold text-[#18120F]">{{ number_format($item['skor'], 2) }}</span>
				                    </div>
				                </div>
				            </div>
				        </div>
				    </div>
				@endforeach
			    </div>

			</div>
		    </div>

		    <script>
			// Custom Dropdown Handler
			document.addEventListener('DOMContentLoaded', function() {
			    const dropdownBtn = document.getElementById('sortMenuBtn');
			    const dropdownMenu = document.getElementById('sortMenu-menu');
			    const selectElement = document.getElementById('sortMenu');
			    const labelElement = document.getElementById('sortMenuLabel');
			    const optionItems = dropdownMenu.querySelectorAll('option-item');

			    // Toggle dropdown
			    dropdownBtn.addEventListener('click', function() {
				const isOpen = dropdownMenu.classList.contains('show');
				if (isOpen) {
				    dropdownMenu.classList.remove('show');
				    dropdownBtn.classList.remove('active');
				    dropdownBtn.setAttribute('aria-expanded', 'false');
				} else {
				    dropdownMenu.classList.add('show');
				    dropdownBtn.classList.add('active');
				    dropdownBtn.setAttribute('aria-expanded', 'true');
				}
			    });

			    // Handle option selection
			    optionItems.forEach(item => {
				item.addEventListener('click', function() {
				    const value = this.getAttribute('value');
				    const label = this.textContent.trim();

				    // Update all items
				    optionItems.forEach(opt => opt.classList.remove('selected'));
				    this.classList.add('selected');

				    // Update button label
				    labelElement.textContent = label;

				    // Update hidden select
				    selectElement.value = value;

				    // Trigger change event
				    selectElement.dispatchEvent(new Event('change'));

				    // Close dropdown
				    dropdownMenu.classList.remove('show');
				    dropdownBtn.classList.remove('active');
				    dropdownBtn.setAttribute('aria-expanded', 'false');
				});
			    });

			    // Close dropdown when clicking outside
			    document.addEventListener('click', function(event) {
				if (!event.target.closest('.dropdown-container')) {
				    dropdownMenu.classList.remove('show');
				    dropdownBtn.classList.remove('active');
				    dropdownBtn.setAttribute('aria-expanded', 'false');
				}
			    });

			    // Sorting & Dynamic Ranking Logic
			    const container = document.getElementById('menuContainer');
			    const circumference = 2 * Math.PI * 26;

			    function updateCardStyles(cards) {
				cards.forEach((card, index) => {
				    // Update nomor peringkat
				    const rankNumber = card.querySelector('.card-rank-number');
				    if (rankNumber) {
				        rankNumber.textContent = String(index + 1).padStart(2, '0');
				    }

				    // Update styling untuk top card (#1)
				    const isTop = index === 0;
				    if (isTop) {
				        // Tambahkan styling untuk card top
				        card.classList.remove('shadow-[0_1px_2px_rgba(24,18,15,0.06)]', 'border', 'border-[#EAE6DF]', 'hover:shadow-[0_20px_32px_-16px_rgba(24,18,15,0.18)]', 'hover:border-[#DFDAD1]');
				        card.classList.add('shadow-[0_0_0_1.5px_#E63912,0_16px_32px_-12px_rgba(230,57,18,0.25)]', 'hover:shadow-[0_0_0_1.5px_#E63912,0_24px_40px_-12px_rgba(230,57,18,0.35)]');
				    } else {
				        // Kembalikan styling untuk card non-top
				        card.classList.remove('shadow-[0_0_0_1.5px_#E63912,0_16px_32px_-12px_rgba(230,57,18,0.25)]', 'hover:shadow-[0_0_0_1.5px_#E63912,0_24px_40px_-12px_rgba(230,57,18,0.35)]');
				        card.classList.add('shadow-[0_1px_2px_rgba(24,18,15,0.06)]', 'border', 'border-[#EAE6DF]', 'hover:shadow-[0_20px_32px_-16px_rgba(24,18,15,0.18)]', 'hover:border-[#DFDAD1]');
				    }

				    // Update badge "Terbaik"
				    const topBadge = card.querySelector('.top-badge');
				    if (topBadge) {
				        if (isTop) {
				            topBadge.classList.remove('hidden');
				        } else {
				            topBadge.classList.add('hidden');
				        }
				    }

				    // Update gauge ring stroke color
				    const gaugeRing = card.querySelector('.gauge-ring');
				    if (gaugeRing) {
				        if (isTop) {
				            gaugeRing.setAttribute('stroke', '#E63912');
				        } else {
				            gaugeRing.setAttribute('stroke', '#18120F');
				        }
				    }
				});
			    }

			//     selectElement.addEventListener('change', function() {
			// 	let cards = Array.from(container.getElementsByClassName('menu-card'));
			// 	let sortValue = this.value;

			// 	cards.sort(function(a, b) {
			// 	    if (sortValue === 'spk_desc') {
			// 	        return parseFloat(b.dataset.skor) - parseFloat(a.dataset.skor);
			// 	    }
			// 	    else if (sortValue.startsWith('kriteria_')) {
			// 	        let parts = sortValue.split('_');
			// 	        let kriteriaId = parts[1];
			// 	        let sifat = parts[2];

			// 	        let nilaiA = parseFloat(a.getAttribute('data-kriteria-' + kriteriaId));
			// 	        let nilaiB = parseFloat(b.getAttribute('data-kriteria-' + kriteriaId));

			// 	        if (sifat.toLowerCase() === 'cost') {
			// 	            return nilaiA - nilaiB;
			// 	        }
			// 	        else {
			// 	            return nilaiB - nilaiA;
			// 	        }
			// 	    }
			// 	});

			// 	// Update styling cards sesuai urutan baru
			// 	updateCardStyles(cards);

			// 	container.style.opacity = '0';
			// 	setTimeout(() => {
			// 	    container.innerHTML = '';
			// 	    cards.forEach(card => container.appendChild(card));
			// 	    container.style.opacity = '1';
			// 	}, 200);
			//     });

			//     container.style.transition = 'opacity 0.2s ease-in-out';

			//     // Initialize styling on page load
			//     let initialCards = Array.from(container.getElementsByClassName('menu-card'));
			//     updateCardStyles(initialCards);
			// });

			selectElement.addEventListener('change', function() {
				let cards = Array.from(container.getElementsByClassName('menu-card'));
				let sortValue = this.value;
				let activeLabel = labelElement.textContent.toLowerCase(); // Ambil teks label yang sedang aktif

				cards.sort(function(a, b) {
				    if (sortValue === 'spk_desc') {
				        return (parseFloat(b.dataset.skor) || 0) - (parseFloat(a.dataset.skor) || 0);
				    }
				    else if (sortValue.startsWith('kriteria_')) {
				        let parts = sortValue.split('_');
				        let kriteriaId = parts[1];
				        let sifat = parts[2];

				        // ========================================================
				        // FIX 1: LOGIKA CERDAS UNTUK HARGA
				        // Jika label dropdown mengandung kata "harga", paksa JS 
				        // untuk mengurutkan berdasarkan nominal Rp asli, bukan matriks.
				        // ========================================================
				        if (activeLabel.includes('harga')) {
				            let hargaA = parseFloat(a.dataset.harga) || 0;
				            let hargaB = parseFloat(b.dataset.harga) || 0;
				            // Cost = Termurah ke termahal. Benefit = Termahal ke termurah.
				            return sifat === 'cost' ? (hargaA - hargaB) : (hargaB - hargaA);
				        }

				        // Logika default untuk Ketersediaan, Popularitas, Rasa, dll
				        let nilaiA = parseFloat(a.getAttribute('data-kriteria-' + kriteriaId)) || 0;
				        let nilaiB = parseFloat(b.getAttribute('data-kriteria-' + kriteriaId)) || 0;

				        // Jika nilai kriteria sama persis, gunakan Skor SPK sebagai penentu (Tie-breaker)
				        if (nilaiA === nilaiB) {
				            return (parseFloat(b.dataset.skor) || 0) - (parseFloat(a.dataset.skor) || 0);
				        }

				        if (sifat.toLowerCase() === 'cost') {
				            return nilaiA - nilaiB;
				        } else {
				            return nilaiB - nilaiA;
				        }
				    }
				    return 0;
				});

				// ========================================================
				// FIX 2: ANIMASI REALTIME DOM
				// Menggunakan appendChild (memindahkan elemen) alih-alih 
				// innerHTML='' agar DOM tidak rusak dan merespon instan
				// ========================================================
				container.style.opacity = '0.3';
				container.style.transform = 'translateY(12px)';

				setTimeout(() => {
				    // Reorder elemen di dalam DOM
				    cards.forEach(card => container.appendChild(card));
				    
				    // Update visual (Nomor urut 01, 02, dan Badge Terbaik)
				    updateCardStyles(cards);

				    // Kembalikan opacity
				    container.style.opacity = '1';
				    container.style.transform = 'translateY(0)';
				}, 150); // Waktu transisi dipercepat
			    });

			    // Tambahkan efek transisi mulus pada container
			    container.style.transition = 'all 0.25s cubic-bezier(0.4, 0, 0.2, 1)';

			    // Initialize styling saat halaman pertama dimuat
			    let initialCards = Array.from(container.getElementsByClassName('menu-card'));
			    updateCardStyles(initialCards);
			});

			document.addEventListener('DOMContentLoaded', function() {
    
    // 1. Inisialisasi Semua Dropdown Kustom
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    
    dropdownToggles.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const targetId = this.getAttribute('data-target');
            const menu = document.getElementById(targetId);
            const isOpen = menu.classList.contains('show');
            
            // Tutup semua dropdown lain dulu
            document.querySelectorAll('.dropdown-menu').forEach(m => m.classList.remove('show'));
            document.querySelectorAll('.dropdown-toggle').forEach(b => {
                b.classList.remove('active');
                b.setAttribute('aria-expanded', 'false');
            });

            if (!isOpen) {
                menu.classList.add('show');
                this.classList.add('active');
                this.setAttribute('aria-expanded', 'true');
            }
        });
    });

    // 2. Handle Klik Opsi Dropdown
    document.querySelectorAll('.dropdown-menu option-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.stopPropagation();
            const menu = this.closest('.dropdown-menu');
            const container = this.closest('.dropdown-container');
            const btn = container.querySelector('.dropdown-toggle');
            const select = container.querySelector('select');
            const label = btn.querySelector('span');
            
            // Update visual item terpilih
            menu.querySelectorAll('option-item').forEach(opt => opt.classList.remove('selected'));
            this.classList.add('selected');
            
            // Update tombol & select tersembunyi
            label.textContent = this.textContent.trim();
            select.value = this.getAttribute('value');
            
            // Tutup menu
            menu.classList.remove('show');
            btn.classList.remove('active');
            btn.setAttribute('aria-expanded', 'false');
            
            // Picu event change
            select.dispatchEvent(new Event('change'));
        });
    });

    // Tutup dropdown jika klik di luar
    document.addEventListener('click', function() {
        document.querySelectorAll('.dropdown-menu').forEach(m => m.classList.remove('show'));
        document.querySelectorAll('.dropdown-toggle').forEach(b => {
            b.classList.remove('active');
            b.setAttribute('aria-expanded', 'false');
        });
    });

    // 3. LOGIKA FILTER & SORTING
    const container = document.getElementById('menuContainer');
    const selectSort = document.getElementById('sortMenu');
    const selectFilter = document.getElementById('filterKategori');
    let allCards = Array.from(container.getElementsByClassName('menu-card'));

    function updateCardStyles(visibleCards) {
        visibleCards.forEach((card, index) => {
            // Update Nomor Peringkat (Hanya untuk yang tampil)
            const rankNumber = card.querySelector('.card-rank-number');
            if (rankNumber) {
                rankNumber.textContent = String(index + 1).padStart(2, '0');
            }

            const isTop = index === 0;
            
            // Styling Highlight untuk Juara 1
            if (isTop) {
                card.classList.remove('shadow-[0_1px_2px_rgba(24,18,15,0.06)]', 'border-[#EAE6DF]');
                card.classList.add('shadow-[0_0_0_1.5px_#E63912,0_16px_32px_-12px_rgba(230,57,18,0.25)]');
            } else {
                card.classList.remove('shadow-[0_0_0_1.5px_#E63912,0_16px_32px_-12px_rgba(230,57,18,0.25)]');
                card.classList.add('shadow-[0_1px_2px_rgba(24,18,15,0.06)]', 'border-[#EAE6DF]');
            }

            const topBadge = card.querySelector('.top-badge');
            if (topBadge) isTop ? topBadge.classList.remove('hidden') : topBadge.classList.add('hidden');

            const gaugeRing = card.querySelector('.gauge-ring');
            if (gaugeRing) gaugeRing.setAttribute('stroke', isTop ? '#E63912' : '#18120F');
        });
    }

    function applyFiltersAndSort() {
        const sortValue = selectSort.value;
        const filterValue = selectFilter.value;
        const activeSortLabel = document.getElementById('sortMenuLabel').textContent.toLowerCase();
        
        let visibleCards = [];

        // TAHAP 1: FILTERING
        allCards.forEach(card => {
            if (filterValue === 'all' || card.dataset.kategori === filterValue) {
                card.style.display = 'flex'; // Munculkan
                visibleCards.push(card);
            } else {
                card.style.display = 'none'; // Sembunyikan
            }
        });

        // TAHAP 2: SORTING (Hanya pada kartu yang lolos filter)
        visibleCards.sort(function(a, b) {
            if (sortValue === 'spk_desc') {
                return (parseFloat(b.dataset.skor) || 0) - (parseFloat(a.dataset.skor) || 0);
            } 
            else if (sortValue.startsWith('kriteria_')) {
                let parts = sortValue.split('_');
                let kriteriaId = parts[1];
                let sifat = parts[2];

                // Cek khusus untuk "Harga" agar mengurutkan nominal asli Rp
                if (activeSortLabel.includes('harga') || activeSortLabel.includes('termurah')) {
                    let hargaA = parseFloat(a.dataset.harga) || 0;
                    let hargaB = parseFloat(b.dataset.harga) || 0;
                    return sifat === 'cost' ? (hargaA - hargaB) : (hargaB - hargaA);
                }

                let nilaiA = parseFloat(a.getAttribute('data-kriteria-' + kriteriaId)) || 0;
                let nilaiB = parseFloat(b.getAttribute('data-kriteria-' + kriteriaId)) || 0;

                // Tie-breaker menggunakan skor SPK
                if (nilaiA === nilaiB) {
                    return (parseFloat(b.dataset.skor) || 0) - (parseFloat(a.dataset.skor) || 0);
                }

                return sifat === 'cost' ? (nilaiA - nilaiB) : (nilaiB - nilaiA);
            }
            return 0;
        });

        // TAHAP 3: RENDERING ANIMASI DOM
        container.style.opacity = '0.3';
        container.style.transform = 'translateY(12px)';

        setTimeout(() => {
            // Susun ulang yang terlihat di DOM
            visibleCards.forEach(card => container.appendChild(card));
            // Biarkan yang tersembunyi berada di akhir DOM agar tidak hilang
            allCards.filter(c => !visibleCards.includes(c)).forEach(c => container.appendChild(c));
            
            // Hitung ulang peringkat (01, 02) hanya untuk yang tampil
            updateCardStyles(visibleCards);

            container.style.opacity = '1';
            container.style.transform = 'translateY(0)';
        }, 150);
    }

    // Pasang Event Listener untuk kedua select tersembunyi
    selectSort.addEventListener('change', applyFiltersAndSort);
    selectFilter.addEventListener('change', applyFiltersAndSort);

    // Initial load
    container.style.transition = 'all 0.25s cubic-bezier(0.4, 0, 0.2, 1)';
    applyFiltersAndSort();
});
		    </script>

			
		</x-app-layout>