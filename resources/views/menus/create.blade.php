<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Menu Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 sm:p-10">

                <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-12">

                        <div class="border-b border-gray-900/10 pb-12">
                            <h2 class="text-base/7 font-semibold text-gray-900">Informasi Dasar Menu</h2>
                            <p class="mt-1 text-sm/6 text-gray-600">Pastikan data yang dimasukkan seperti nama, harga, dan ketersediaan sudah benar.</p>

                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                
                                <div class="sm:col-span-4">
                                    <label for="nama_menu" class="block text-sm/6 font-medium text-gray-900">Nama Menu</label>
                                    <div class="mt-2">
                                        <input id="nama_menu" type="text" name="nama_menu" value="{{ old('nama_menu') }}" placeholder="Contoh: Nasi Goreng Spesial" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" required />
                                        @error('nama_menu') 
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p> 
                                        @enderror
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="kategori" class="block text-sm/6 font-medium text-gray-900">Kategori</label>
                                    <div class="mt-2 grid grid-cols-1">
                                        <select id="kategori" name="kategori" required class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                            <option value="">-- Pilih Kategori --</option>
                                            <option value="Makanan" {{ old('kategori') == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                                            <option value="Minuman" {{ old('kategori') == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                                            <option value="Cemilan" {{ old('kategori') == 'Cemilan' ? 'selected' : '' }}>Cemilan</option>
                                        </select>
                                        <svg viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                                            <path d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                                        </svg>
                                    </div>
                                    @error('kategori') 
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p> 
                                    @enderror
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="harga" class="block text-sm/6 font-medium text-gray-900">Harga (Rp)</label>
                                    <div class="mt-2">
                                        <input id="harga" type="number" name="harga" value="{{ old('harga') }}" min="0" placeholder="Contoh: 15000" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" required />
                                        @error('harga') 
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p> 
                                        @enderror
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="ketersediaan" class="block text-sm/6 font-medium text-gray-900">Status Ketersediaan</label>
                                    <div class="mt-2 grid grid-cols-1">
                                        <select id="ketersediaan" name="ketersediaan" required class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                            <option value="tersedia" {{ old('ketersediaan') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                            <option value="tanpa keterangan" {{ old('ketersediaan') == 'tanpa keterangan' ? 'selected' : '' }}>Tanpa Keterangan</option>
                                            <option value="tidak tersedia" {{ old('ketersediaan') == 'tidak tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                                        </select>
                                        <svg viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                                            <path d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                                        </svg>
                                    </div>
                                    @error('ketersediaan') 
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p> 
                                    @enderror
                                </div>

                            </div>
                        </div>

                        <div class="border-b border-gray-900/10 pb-12">
                            <h2 class="text-base/7 font-semibold text-gray-900">Detail & Media</h2>
                            <p class="mt-1 text-sm/6 text-gray-600">Tambahkan penjelasan menarik dan visual yang menggugah selera untuk menu Anda.</p>

                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                
                                <div class="col-span-full">
                                    <label for="deskripsi" class="block text-sm/6 font-medium text-gray-900">Deskripsi Menu (Opsional)</label>
                                    <div class="mt-2">
                                        <textarea id="deskripsi" name="deskripsi" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">{{ old('deskripsi') }}</textarea>
                                    </div>
                                    <p class="mt-3 text-sm/6 text-gray-600">Tuliskan beberapa kalimat yang menjelaskan isi dari menu ini.</p>
                                    @error('deskripsi') 
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p> 
                                    @enderror
                                </div>

                                {{-- <div class="col-span-full">
                                    <label for="foto" class="block text-sm/6 font-medium text-gray-900">Foto Cover Menu</label>
                                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                        <div class="text-center">
                                            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="mx-auto size-12 text-gray-300">
                                                <path d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" fill-rule="evenodd" />
                                            </svg>
                                            <div class="mt-4 flex justify-center text-sm/6 text-gray-600">
                                                <label for="foto" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-indigo-600 hover:text-indigo-500">
                                                    <span>Upload a file</span>
                                                    <input id="foto" type="file" name="foto" class="sr-only" accept="image/jpeg,image/png,image/jpg" />
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs/5 text-gray-600">PNG, JPG, JPEG up to 2MB</p>
                                        </div>
                                    </div>
                                    @error('foto') 
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p> 
                                    @enderror
                                </div> --}}

                            <div class="col-span-full">
                            <label for="foto" class="block text-sm/6 font-medium text-gray-900">Foto Cover Menu</label>
                            
                            <div id="drop-zone" class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10 transition-colors duration-200">
                                <div class="text-center">
                                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="mx-auto size-12 text-gray-300">
                                        <path d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" fill-rule="evenodd" />
                                    </svg>
                                    <div class="mt-4 flex justify-center text-sm/6 text-gray-600">
                                        <label for="foto" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-indigo-600 hover:text-indigo-500">
                                            <span>Upload a file</span>
                                            <input id="foto" type="file" name="foto" class="sr-only" accept="image/jpeg,image/png,image/jpg" />
                                        </label>
                                        <p id="file-name-display" class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs/5 text-gray-600">PNG, JPG, JPEG up to 2MB</p>
                                </div>
                            </div>
                            @error('foto') 
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p> 
                            @enderror
                            </div>

                            </div>
                        </div>

                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <a href="{{ route('menus.index') }}" class="text-sm/6 font-semibold text-gray-900 hover:text-gray-600">Cancel</a>
                        
                        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Save Menu
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropZone = document.getElementById('drop-zone');
            const fileInput = document.getElementById('foto');
            const fileNameDisplay = document.getElementById('file-name-display');

            // Mencegah browser membuka file saat di-drag (perilaku bawaan)
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
                document.body.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            // Menambahkan efek visual saat file berada di atas kotak (hover area)
            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, unhighlight, false);
            });

            function highlight(e) {
                dropZone.classList.add('border-indigo-600', 'bg-indigo-50');
                dropZone.classList.remove('border-gray-900/25');
            }

            function unhighlight(e) {
                dropZone.classList.remove('border-indigo-600', 'bg-indigo-50');
                dropZone.classList.add('border-gray-900/25');
            }

            // Menangani kejadian saat file dijatuhkan (di-drop)
            dropZone.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;

                if (files.length > 0) {
                    // Memasukkan file ke dalam input type="file" tersembunyi
                    fileInput.files = files;
                    updateFileName(files[0].name);
                }
            }

            // Menangani kejadian saat diklik manual via tombol "Upload a file"
            fileInput.addEventListener('change', function(e) {
                if (this.files.length > 0) {
                    updateFileName(this.files[0].name);
                }
            });

            // Fungsi untuk mengubah teks "or drag and drop" menjadi nama file
            function updateFileName(name) {
                fileNameDisplay.textContent = name;
                fileNameDisplay.classList.add('text-indigo-600', 'font-semibold');
            }
        });
    </script>
    @endpush
</x-app-layout>