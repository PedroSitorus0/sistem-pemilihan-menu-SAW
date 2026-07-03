<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Menu: ') }} <span class="text-gray-500">{{ $menu->nama_menu }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 sm:p-10">

                <form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-12">
                        <div class="border-b border-gray-900/10 pb-12">
                            <h2 class="text-base/7 font-semibold text-gray-900">Perbarui Informasi Menu</h2>
                            <p class="mt-1 text-sm/6 text-gray-600">Sesuaikan data menu di bawah ini dengan perubahan terbaru.</p>

                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                
                                <div class="sm:col-span-4">
                                    <label for="nama_menu" class="block text-sm/6 font-medium text-gray-900">Nama Menu</label>
                                    <div class="mt-2">
                                        <input id="nama_menu" type="text" name="nama_menu" value="{{ old('nama_menu', $menu->nama_menu) }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" required />
                                        @error('nama_menu') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="kategori" class="block text-sm/6 font-medium text-gray-900">Kategori</label>
                                    <div class="mt-2 grid grid-cols-1">
                                        <select id="kategori" name="kategori" required class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                            <option value="">-- Pilih Kategori --</option>
                                            <option value="Makanan" {{ old('kategori', $menu->kategori) == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                                            <option value="Minuman" {{ old('kategori', $menu->kategori) == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                                            <option value="Cemilan" {{ old('kategori', $menu->kategori) == 'Cemilan' ? 'selected' : '' }}>Cemilan</option>
                                        </select>
                                        <svg viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                                            <path d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                                        </svg>
                                    </div>
                                    @error('kategori') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="harga" class="block text-sm/6 font-medium text-gray-900">Harga (Rp)</label>
                                    <div class="mt-2">
                                        <input id="harga" type="number" name="harga" value="{{ old('harga', $menu->harga) }}" min="0" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" required />
                                        @error('harga') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                    </div>
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="ketersediaan" class="block text-sm/6 font-medium text-gray-900">Status Ketersediaan</label>
                                    <div class="mt-2 grid grid-cols-1">
                                        <select id="ketersediaan" name="ketersediaan" required class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                            <option value="tersedia" {{ old('ketersediaan', $menu->ketersediaan) == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                            <option value="tanpa keterangan" {{ old('ketersediaan', $menu->ketersediaan) == 'tanpa keterangan' ? 'selected' : '' }}>Tanpa Keterangan</option>
                                            <option value="tidak tersedia" {{ old('ketersediaan', $menu->ketersediaan) == 'tidak tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                                        </select>
                                        <svg viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4">
                                            <path d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
                                        </svg>
                                    </div>
                                    @error('ketersediaan') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="border-b border-gray-900/10 pb-12">
                            <h2 class="text-base/7 font-semibold text-gray-900">Detail & Media</h2>
                            
                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                
                                <div class="col-span-full">
                                    <label for="deskripsi" class="block text-sm/6 font-medium text-gray-900">Deskripsi Menu (Opsional)</label>
                                    <div class="mt-2">
                                        <textarea id="deskripsi" name="deskripsi" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">{{ old('deskripsi', $menu->deskripsi) }}</textarea>
                                    </div>
                                    @error('deskripsi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                </div>

                                @php
                                    $hasImage = $menu->foto ? true : false;
                                    $imageUrl = $hasImage ? asset('storage/' . $menu->foto) : '';
                                @endphp

                                <div class="col-span-full">
                                    <div class="flex items-center justify-between">
                                        <span class="block text-sm/6 font-medium text-gray-900">Foto Cover Menu</span>
                                        
                                        <button type="button" id="btn-preview" class="{{ $hasImage ? '' : 'hidden' }} text-sm font-semibold text-indigo-600 hover:text-indigo-800 underline focus:outline-none">
                                            Lihat Preview Foto
                                        </button>
                                    </div>
                                    
                                    <label for="foto" id="drop-zone" class="relative mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10 transition-colors duration-200 cursor-pointer hover:border-indigo-500 hover:bg-gray-50">
                                        <input id="foto" type="file" name="foto" class="sr-only" accept="image/jpeg,image/png,image/jpg" />

                                        <div id="upload-content" class="text-center relative z-20">
                                            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" class="mx-auto size-12 text-gray-300">
                                                <path d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" fill-rule="evenodd" />
                                            </svg>
                                            <div class="mt-4 flex justify-center text-sm/6 text-gray-600">
                                                <span class="font-semibold text-indigo-600">Upload a file</span>
                                                <p id="file-name-text" class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs/5 text-gray-600">PNG, JPG, JPEG up to 2MB</p>
                                        </div>
                                    </label>
                                    @error('foto') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                                    
                                    @if($hasImage)
                                        <p class="mt-2 text-sm text-gray-500">Biarkan kosong jika tidak ingin mengubah foto saat ini.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <a href="{{ route('menus.index') }}" class="text-sm/6 font-semibold text-gray-900 hover:text-gray-600">Batal</a>
                        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Perbarui Menu
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div id="image-modal" class="fixed inset-0 z-50 hidden bg-gray-900/80 items-center justify-center p-4 backdrop-blur-sm transition-opacity">
        <div class="relative bg-white rounded-lg shadow-xl max-w-2xl w-full overflow-hidden">
            <div class="flex items-center justify-between p-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-900">Preview Foto Menu</h3>
                <button type="button" id="btn-close-modal" class="text-gray-400 hover:text-red-500 focus:outline-none transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-4 flex justify-center bg-gray-200">
                <img id="modal-image" src="{{ $imageUrl }}" class="max-h-[60vh] object-contain rounded" alt="Preview Foto">
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropZone = document.getElementById('drop-zone');
            const fileInput = document.getElementById('foto');
            
            const btnPreview = document.getElementById('btn-preview');
            const imageModal = document.getElementById('image-modal');
            const btnCloseModal = document.getElementById('btn-close-modal');
            const modalImage = document.getElementById('modal-image');
            const fileNameText = document.getElementById('file-name-text');

            // --- FUNGSI MODAL ---
            // Buka Modal
            btnPreview.addEventListener('click', function() {
                imageModal.classList.remove('hidden');
                imageModal.classList.add('flex');
            });

            // Tutup Modal (Tombol Exit)
            btnCloseModal.addEventListener('click', function() {
                imageModal.classList.add('hidden');
                imageModal.classList.remove('flex');
            });

            // Tutup Modal jika area gelap di luar kotak diklik
            imageModal.addEventListener('click', function(e) {
                if(e.target === imageModal) {
                    imageModal.classList.add('hidden');
                    imageModal.classList.remove('flex');
                }
            });

            // --- FUNGSI DRAG & DROP & PREVIEW ---
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
                document.body.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => {
                    dropZone.classList.add('border-indigo-600', 'bg-indigo-50');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, () => {
                    dropZone.classList.remove('border-indigo-600', 'bg-indigo-50');
                }, false);
            });

            dropZone.addEventListener('drop', function(e) {
                const dt = e.dataTransfer;
                if (dt.files.length > 0) {
                    fileInput.files = dt.files;
                    processAndPreviewFile(dt.files[0]);
                }
            }, false);

            fileInput.addEventListener('change', function(e) {
                if (this.files.length > 0) {
                    processAndPreviewFile(this.files[0]);
                }
            });

            function processAndPreviewFile(file) {
                if (!file.type.startsWith('image/')) {
                    alert('File yang diunggah harus berupa gambar.');
                    return;
                }

                const reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function(e) {
                    // Update gambar di dalam modal
                    modalImage.src = e.target.result;
                    
                    // Tampilkan teks "Lihat Preview Foto" karena foto siap dilihat
                    btnPreview.classList.remove('hidden');
                    
                    // Ubah teks box upload menjadi nama file
                    fileNameText.textContent = file.name;
                    fileNameText.classList.add('text-indigo-600', 'font-semibold');
                }
            }
        });
    </script>
    @endpush
</x-app-layout>