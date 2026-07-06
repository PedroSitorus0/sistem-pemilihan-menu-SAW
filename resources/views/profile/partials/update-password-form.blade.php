<section class="bg-white border border-[#EAE6DF] rounded-[0.875rem] shadow-[0_4px_20px_rgba(0,0,0,0.03)] overflow-hidden mt-8 w-full">
    <div class="p-6 sm:p-8">
        <header>
            <h2 class="font-display text-xl sm:text-2xl font-semibold text-[#18120F]">
                Update Password
            </h2>
            <p class="mt-1 text-[13px] text-[#948E86]">
                Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.
            </p>
        </header>

        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6 max-w-xl">
            @csrf
            @method('put')

            <div class="flex flex-col gap-2">
                <label for="update_password_current_password" class="font-mono text-[11px] tracking-[0.1em] uppercase text-[#948E86] font-semibold">
                    Password Saat Ini
                </label>
                <input
                    id="update_password_current_password"
                    name="current_password"
                    type="password"
                    class="px-4 py-3.5 border-[1.5px] border-[#18120F] rounded-xl font-sans text-sm text-[#18120F] bg-white transition-all duration-200 focus:outline-none focus:border-[#E63912] focus:bg-[#FEF7F3] focus:shadow-[0_2px_8px_rgba(230,57,18,0.1)] w-full"
                    autocomplete="current-password"
                >
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="text-[12px] text-[#DC2626] font-sans mt-1" />
            </div>

            <div class="flex flex-col gap-2">
                <label for="update_password_password" class="font-mono text-[11px] tracking-[0.1em] uppercase text-[#948E86] font-semibold">
                    Password Baru
                </label>
                <input
                    id="update_password_password"
                    name="password"
                    type="password"
                    class="px-4 py-3.5 border-[1.5px] border-[#18120F] rounded-xl font-sans text-sm text-[#18120F] bg-white transition-all duration-200 focus:outline-none focus:border-[#E63912] focus:bg-[#FEF7F3] focus:shadow-[0_2px_8px_rgba(230,57,18,0.1)] w-full"
                    autocomplete="new-password"
                >
                <x-input-error :messages="$errors->updatePassword->get('password')" class="text-[12px] text-[#DC2626] font-sans mt-1" />
            </div>

            <div class="flex flex-col gap-2">
                <label for="update_password_password_confirmation" class="font-mono text-[11px] tracking-[0.1em] uppercase text-[#948E86] font-semibold">
                    Konfirmasi Password
                </label>
                <input
                    id="update_password_password_confirmation"
                    name="password_confirmation"
                    type="password"
                    class="px-4 py-3.5 border-[1.5px] border-[#18120F] rounded-xl font-sans text-sm text-[#18120F] bg-white transition-all duration-200 focus:outline-none focus:border-[#E63912] focus:bg-[#FEF7F3] focus:shadow-[0_2px_8px_rgba(230,57,18,0.1)] w-full"
                    autocomplete="new-password"
                >
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="text-[12px] text-[#DC2626] font-sans mt-1" />
            </div>

            <div class="flex items-center gap-4 pt-2">
                <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-[#E63912] text-white border-[1.5px] border-[#E63912] rounded-xl font-mono text-[13px] font-semibold tracking-[0.05em] uppercase transition-all duration-200 hover:bg-[#D4300F] hover:border-[#D4300F] hover:shadow-[0_4px_12px_rgba(230,57,18,0.25)] w-full sm:w-auto">
                    ✓ Simpan Password
                </button>

                @if (session('status') === 'password-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="font-mono text-[12px] text-[#166534] font-semibold inline-flex items-center gap-1.5"
                    >
                        ✓ Berhasil diperbarui.
                    </p>
                @endif
            </div>
        </form>
    </div>
</section>