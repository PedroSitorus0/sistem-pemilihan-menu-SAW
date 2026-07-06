<section class="w-full max-w-5xl mx-auto px-4 pb-8">
    <div class="bg-white border border-[#EAE6DF] rounded-[0.875rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] overflow-hidden w-full">
        <div class="p-6 sm:p-8">
            <header>
                <h2 class="font-display text-xl sm:text-2xl font-semibold text-[#18120F]">
                    Hapus Akun
                </h2>
                <p class="mt-1 text-[13px] text-[#948E86] max-w-2xl">
                    Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.
                </p>
            </header>

            <div class="mt-6">
                <button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-[#DC2626] text-white border-[1.5px] border-[#DC2626] rounded-xl font-mono text-[13px] font-semibold tracking-[0.05em] uppercase transition-all duration-200 hover:bg-[#B91C1C] hover:border-[#B91C1C] hover:shadow-[0_4px_12px_rgba(220,38,38,0.25)] w-full sm:w-auto"
                >
                    ✕ Hapus Akun
                </button>
            </div>
        </div>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 sm:p-8">
            @csrf
            @method('delete')

            <h2 class="font-display text-xl font-semibold text-[#18120F]">
                Apakah Anda yakin ingin menghapus akun ini?
            </h2>

            <p class="mt-2 text-[13px] text-[#948E86]">
                Setelah akun Anda dihapus, semua data akan hilang selamanya. Silakan masukkan kata sandi Anda untuk mengonfirmasi penghapusan akun secara permanen.
            </p>

            <div class="mt-6 flex flex-col gap-2">
                <label for="password" class="sr-only">Password</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="px-4 py-3.5 border-[1.5px] border-[#18120F] rounded-xl font-sans text-sm text-[#18120F] bg-white transition-all duration-200 focus:outline-none focus:border-[#DC2626] focus:bg-[#FEF2F2] focus:shadow-[0_2px_8px_rgba(220,38,38,0.1)] w-full sm:w-3/4"
                    placeholder="Masukkan Password Anda"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="text-[12px] text-[#DC2626] font-sans mt-1" />
            </div>

            <div class="mt-6 flex flex-col sm:flex-row justify-end gap-3">
                <button 
                    type="button" 
                    x-on:click="$dispatch('close')"
                    class="inline-flex items-center justify-center px-6 py-3 bg-white text-[#18120F] border-[1.5px] border-[#EAE6DF] rounded-xl font-mono text-[13px] font-semibold tracking-[0.05em] uppercase transition-all duration-200 hover:bg-[#F7F5F2] hover:border-[#DDD6CC] w-full sm:w-auto"
                >
                    Batal
                </button>

                <button 
                    type="submit"
                    class="inline-flex items-center justify-center px-6 py-3 bg-[#DC2626] text-white border-[1.5px] border-[#DC2626] rounded-xl font-mono text-[13px] font-semibold tracking-[0.05em] uppercase transition-all duration-200 hover:bg-[#B91C1C] hover:border-[#B91C1C] hover:shadow-[0_4px_12px_rgba(220,38,38,0.25)] w-full sm:w-auto"
                >
                    Hapus Akun Permanen
                </button>
            </div>
        </form>
    </x-modal>
</section>