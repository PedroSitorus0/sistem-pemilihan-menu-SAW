<section>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        .font-display { font-family: 'Fraunces', serif; font-feature-settings: 'ss01' 1; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }

        .profile-card {
            background: white;
            border: 1px solid #EAE6DF;
            border-radius: 0.875rem;
            padding: 1.5rem;
        }
        @media (min-width: 640px) { .profile-card { padding: 1.75rem; } }

        .avatar-wrap {
            position: relative;
            width: 72px;
            height: 72px;
            flex-shrink: 0;
        }

        .profile-avatar-img {
            width: 72px;
            height: 72px;
            border-radius: 9999px;
            object-fit: cover;
            border: 1.5px solid #F4C7B8;
        }

        .profile-avatar-fallback {
            width: 72px;
            height: 72px;
            border-radius: 9999px;
            background-color: #FEF7F3;
            border: 1.5px solid #F4C7B8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Fraunces', serif;
            font-size: 26px;
            font-weight: 600;
            color: #E63912;
        }

        .avatar-upload-btn {
            position: absolute;
            bottom: -2px;
            right: -2px;
            width: 26px;
            height: 26px;
            border-radius: 9999px;
            background-color: #E63912;
            border: 2px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 11px;
            color: white;
            transition: all 0.2s ease;
        }

        .avatar-upload-btn:hover {
            background-color: #D4300F;
        }

        .role-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.3rem 0.75rem;
            border-radius: 0.5rem;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            font-family: 'JetBrains Mono', monospace;
        }

        .role-dev { background-color: #EDE9FE; color: #6D28D9; border: 1px solid #DDD6FE; }
        .role-admin { background-color: #FEF3C7; color: #92400E; border: 1px solid #FCD34D; }
        .role-mahasiswa { background-color: #F3F4F6; color: #374151; border: 1px solid #E5E7EB; }

        .verify-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.2rem 0.6rem;
            border-radius: 9999px;
            font-size: 10px;
            font-weight: 600;
            font-family: 'JetBrains Mono', monospace;
        }

        .verify-badge.verified {
            background-color: #ECFDF5;
            color: #065F46;
            border: 1px solid #A7F3D0;
        }

        .verify-badge.pending {
            background-color: #FFFBEB;
            color: #92400E;
            border: 1px solid #FDE68A;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-label {
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #948E86;
            font-weight: 600;
        }

        .form-input {
            padding: 0.875rem 1rem;
            border: 1.5px solid #18120F;
            border-radius: 0.75rem;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            color: #18120F;
            background-color: white;
            transition: all 0.2s ease;
            width: 100%;
        }

        .form-input:focus {
            outline: none;
            border-color: #E63912;
            background-color: #FEF7F3;
            box-shadow: 0 2px 8px rgba(230, 57, 18, 0.1);
        }

        .form-input-locked {
            padding: 0.875rem 1rem;
            border: 1.5px solid #EAE6DF;
            border-radius: 0.75rem;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            color: #6B7280;
            background-color: #F7F5F2;
            width: 100%;
            max-width: 220px;
            cursor: not-allowed;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.5rem;
        }

        .form-error {
            font-size: 12px;
            color: #DC2626;
            font-family: 'Inter', sans-serif;
        }

        .form-hint {
            font-size: 12px;
            color: #948E86;
            font-family: 'Inter', sans-serif;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.05em;
            border: 1.5px solid;
            border-radius: 0.75rem;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            text-transform: uppercase;
            width: 100%;
        }
        @media (min-width: 640px) { .btn { width: auto; } }

        .btn-primary {
            background-color: #E63912;
            color: white;
            border-color: #E63912;
        }

        .btn-primary:hover {
            background-color: #D4300F;
            border-color: #D4300F;
            box-shadow: 0 4px 12px rgba(230, 57, 18, 0.25);
        }

        .alert-warning {
            background-color: #FFFBEB;
            border: 1px solid #FDE68A;
            color: #92400E;
            border-radius: 0.75rem;
            padding: 1rem;
            font-size: 13px;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .alert-warning a, .alert-warning button {
            color: #92400E;
            font-weight: 600;
            text-decoration: underline;
        }

        .saved-message {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            color: #166534;
            font-weight: 600;
        }
    </style>

    <div class="profile-card">
        <div class="flex items-center gap-2 mb-2">
            <span class="w-1.5 h-1.5 rounded-full bg-[#E63912]"></span>
            <span class="font-mono text-[11px] uppercase tracking-[0.18em] text-[#948E86]">Pengaturan Akun</span>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center gap-4 mb-8 pb-6 border-b border-[#EAE6DF]">
            <div class="avatar-wrap">
                @if($user->foto)
                    <img src="{{ asset('storage/' . $user->foto) }}" alt="{{ $user->nama }}" class="profile-avatar-img" id="avatarPreview">
                @else
                    <div class="profile-avatar-fallback" id="avatarFallback">
                        {{ strtoupper(substr($user->nama, 0, 1)) }}
                    </div>
                    <img src="" alt="" class="profile-avatar-img hidden" id="avatarPreview">
                @endif

                <label for="foto" class="avatar-upload-btn" title="Ubah foto profil">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                        <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4z"/>
                        <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5m0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                    </svg>
                    <input type="file" id="foto" name="foto" accept="image/*" class="hidden" form="profile-form" onchange="previewAvatar(event)">
                </label>
            </div>
            <div>
                <h3 class="font-display text-xl font-semibold text-[#18120F]">{{ $user->nama }}</h3>
                <div class="flex flex-wrap items-center gap-2 mt-1.5">
                    @if($user->role === 'dev')
                        <span class="role-badge role-dev">Developer</span>
                    @elseif($user->role === 'admin')
                        <span class="role-badge role-admin">Admin</span>
                    @else
                        <span class="role-badge role-mahasiswa">Mahasiswa</span>
                    @endif

                    @if($user->nomor_induk)
                        <span class="font-mono text-xs text-[#948E86]">{{ $user->nomor_induk }}</span>
                        @if($user->nomor_induk_verified_at)
                            <span class="verify-badge verified">✓ Terverifikasi</span>
                        @else
                            <span class="verify-badge pending">Menunggu Verifikasi</span>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        @if (session('status') === 'profile-updated')
            <div class="saved-message mb-5">
                ✓ Profil berhasil diperbarui.
            </div>
        @endif

        @error('foto')
            <div class="alert-warning mb-4"><span>{{ $message }}</span></div>
        @enderror

        <form id="profile-form" method="post" action="{{ route('profile.update') }}" class="space-y-5" enctype="multipart/form-data">
            @csrf
            @method('patch')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="form-group">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input
                        id="nama" name="nama" type="text" class="form-input"
                        value="{{ old('nama', $user->nama) }}" required autofocus autocomplete="name"
                    >
                    @error('nama')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input
                        id="email" name="email" type="email" class="form-input"
                        value="{{ old('email', $user->email) }}" required autocomplete="username"
                    >
                    @error('email')<span class="form-error">{{ $message }}</span>@enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="alert-warning mt-1">
                            <span>Email Anda belum terverifikasi.</span>
                            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                                @csrf
                                <button type="submit" class="text-left">Klik di sini untuk kirim ulang email verifikasi.</button>
                            </form>
                            @if (session('status') === 'verification-link-sent')
                                <span class="font-semibold">Link verifikasi baru telah dikirim ke email Anda.</span>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label">Nomor HP</label>
                    <input
                        id="phone" name="phone" type="text" class="form-input"
                        value="{{ old('phone', $user->phone) }}" placeholder="Contoh: 081234567890" autocomplete="tel"
                    >
                    @error('phone')<span class="form-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="nomor_induk" class="form-label">
                        Nomor Induk (NIM)
                        @if($user->nomor_induk_verified_at)
                            <span class="verify-badge verified ml-1">✓ Terverifikasi</span>
                        @elseif($user->nomor_induk)
                            <span class="verify-badge pending ml-1">Menunggu Verifikasi</span>
                        @endif
                    </label>
                    <input
                        id="nomor_induk" name="nomor_induk" type="text" class="form-input"
                        value="{{ old('nomor_induk', $user->nomor_induk) }}" placeholder="Masukkan NIM Anda"
                    >
                    @error('nomor_induk')
                        <span class="form-error">{{ $message }}</span>
                    @else
                        <span class="form-hint">
                            @if($user->nomor_induk_verified_at)
                                NIM Anda sudah diverifikasi oleh admin/dev. Mengubahnya akan mengembalikan status menjadi "Menunggu Verifikasi".
                            @else
                                NIM akan diverifikasi manual oleh admin atau developer. Anda akan melihat tanda ✓ setelah disetujui.
                            @endif
                        </span>
                    @enderror
                </div>

                <div class="form-group sm:col-span-2">
                    <label class="form-label">Role</label>
                    <div class="form-input-locked">
                        <span class="capitalize">{{ $user->role }}</span>
                        <span class="text-xs text-[#948E86]" title="Tidak dapat diubah"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4M4.5 7A1.5 1.5 0 0 0 3 8.5v5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5v-5A1.5 1.5 0 0 0 11.5 7zM8 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3"/>
</svg></span>
                    </div>
                    <span class="form-hint">Role hanya dapat diubah oleh admin/developer melalui Manajemen Pengguna.</span>
                </div>
            </div>

            <div class="flex items-center gap-4 pt-2">
                <button type="submit" class="btn btn-primary">
                    ✓ Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewAvatar(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                const preview = document.getElementById('avatarPreview');
                const fallback = document.getElementById('avatarFallback');
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                if (fallback) fallback.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    </script>
</section>