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
            overflow: hidden;
        }

        /* ---------- Facebook-style header: cover + overlapping avatar ---------- */

        .profile-header {
            position: relative;
        }

        .cover-banner {
            position: relative;
            width: 100%;
            height: 132px;
            background: linear-gradient(120deg, #E63912 0%, #F4713D 48%, #F9A66C 100%);
            overflow: hidden;
        }
        @media (min-width: 640px) { .cover-banner { height: 168px; } }

        .cover-banner-img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* subtle texture so a flat gradient doesn't look bare when there's no cover photo */
        .cover-banner::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle at 18% 20%, rgba(255,255,255,0.16) 0, transparent 45%),
                               radial-gradient(circle at 82% 78%, rgba(24,18,15,0.10) 0, transparent 40%);
            pointer-events: none;
        }

        .cover-upload-btn {
            position: absolute;
            bottom: 0.75rem;
            right: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.45rem 0.75rem;
            border-radius: 0.6rem;
            background-color: rgba(24, 18, 15, 0.55);
            backdrop-filter: blur(4px);
            color: white;
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.04em;
            cursor: pointer;
            border: 1px solid rgba(255,255,255,0.25);
            transition: background-color 0.2s ease;
        }
        .cover-upload-btn:hover { background-color: rgba(24, 18, 15, 0.72); }
        .cover-upload-btn svg { width: 14px; height: 14px; }

        .profile-header-row {
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            padding: 0 1.5rem 1.5rem;
            margin-top: -40px;
        }
        @media (min-width: 640px) {
            .profile-header-row {
                flex-direction: row;
                align-items: flex-end;
                padding: 0 1.75rem 1.5rem;
                margin-top: -44px;
            }
        }

        .avatar-wrap {
            position: relative;
            width: 96px;
            height: 96px;
            flex-shrink: 0;
        }
        @media (min-width: 640px) { .avatar-wrap { width: 112px; height: 112px; } }

        .profile-avatar-img {
            width: 100%;
            height: 100%;
            border-radius: 9999px;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 0 0 1.5px #F4C7B8;
            display: block;
            background-color: #FEF7F3;
        }

        .profile-avatar-fallback {
            width: 100%;
            height: 100%;
            border-radius: 9999px;
            background-color: #FEF7F3;
            border: 4px solid white;
            box-shadow: 0 0 0 1.5px #F4C7B8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Fraunces', serif;
            font-size: 32px;
            font-weight: 600;
            color: #E63912;
        }

        .avatar-upload-btn {
            position: absolute;
            bottom: 2px;
            right: 2px;
            width: 30px;
            height: 30px;
            border-radius: 9999px;
            background-color: #E63912;
            border: 2.5px solid white;
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

        .profile-identity {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            padding-top: 0.25rem;
        }
        @media (min-width: 640px) {
            .profile-identity { padding-top: 0; padding-bottom: 0.25rem; }
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

        .profile-body { padding: 1.5rem; }
        @media (min-width: 640px) { .profile-body { padding: 1.75rem; } }

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

        .btn-primary:disabled {
            background-color: #F4C7B8;
            border-color: #F4C7B8;
            cursor: not-allowed;
            box-shadow: none;
        }

        .btn-ghost {
            background-color: white;
            color: #18120F;
            border-color: #EAE6DF;
        }
        .btn-ghost:hover {
            background-color: #F7F5F2;
            border-color: #DDD6CC;
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

        /* ---------- Crop modal ---------- */

        .crop-modal-overlay {
            position: fixed;
            inset: 0;
            background-color: rgba(24, 18, 15, 0.6);
            backdrop-filter: blur(2px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            z-index: 100;
        }

        .crop-modal {
            background: white;
            border-radius: 1rem;
            border: 1px solid #EAE6DF;
            width: 100%;
            max-width: 480px;
            max-height: 92vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .crop-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.125rem 1.25rem;
            border-bottom: 1px solid #EAE6DF;
            flex-shrink: 0;
        }

        .crop-modal-title {
            font-family: 'Fraunces', serif;
            font-weight: 600;
            font-size: 17px;
            color: #18120F;
        }

        .crop-modal-close {
            width: 28px;
            height: 28px;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #948E86;
            cursor: pointer;
            border: none;
            background: transparent;
            transition: all 0.15s ease;
        }
        .crop-modal-close:hover { background-color: #F7F5F2; color: #18120F; }

        .crop-stage {
            position: relative;
            background-color: #18120F;
            background-image:
                linear-gradient(45deg, #241C17 25%, transparent 25%),
                linear-gradient(-45deg, #241C17 25%, transparent 25%),
                linear-gradient(45deg, transparent 75%, #241C17 75%),
                linear-gradient(-45deg, transparent 75%, #241C17 75%);
            background-size: 16px 16px;
            background-position: 0 0, 0 8px, 8px -8px, -8px 0px;
            overflow: hidden;
            touch-action: none;
            cursor: grab;
            aspect-ratio: 1 / 1;
            width: 100%;
            flex-shrink: 0;
        }
        .crop-stage:active { cursor: grabbing; }

        .crop-canvas {
            position: absolute;
            top: 0;
            left: 0;
            display: block;
        }

        .crop-mask-svg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }

        .crop-controls {
            padding: 1rem 1.25rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            border-top: 1px solid #EAE6DF;
            flex-shrink: 0;
        }

        .zoom-row {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .zoom-row svg { color: #948E86; flex-shrink: 0; }

        .zoom-slider {
            flex: 1;
            -webkit-appearance: none;
            appearance: none;
            height: 4px;
            border-radius: 9999px;
            background: #EAE6DF;
            outline: none;
        }
        .zoom-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 16px;
            height: 16px;
            border-radius: 9999px;
            background: #E63912;
            cursor: pointer;
            border: 2px solid white;
            box-shadow: 0 1px 4px rgba(0,0,0,0.25);
        }
        .zoom-slider::-moz-range-thumb {
            width: 16px;
            height: 16px;
            border-radius: 9999px;
            background: #E63912;
            cursor: pointer;
            border: 2px solid white;
            box-shadow: 0 1px 4px rgba(0,0,0,0.25);
        }

        .crop-hint-text {
            font-family: 'Inter', sans-serif;
            font-size: 12px;
            color: #948E86;
            text-align: center;
        }

        .crop-actions {
            display: flex;
            gap: 0.625rem;
            padding: 1rem 1.25rem 1.25rem;
        }
        .crop-actions .btn { flex: 1; width: auto; }

        .crop-type-tabs {
            display: flex;
            gap: 0.375rem;
            padding: 0 1.25rem 1rem;
        }

        .crop-type-tab {
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            padding: 0.4rem 0.7rem;
            border-radius: 0.5rem;
            border: 1.5px solid #EAE6DF;
            background: white;
            color: #948E86;
            cursor: default;
        }
        .crop-type-tab.active {
            border-color: #E63912;
            color: #E63912;
            background-color: #FEF7F3;
        }

        @media (prefers-reduced-motion: reduce) {
            .cover-upload-btn, .avatar-upload-btn, .btn, .crop-modal-close { transition: none; }
        }

        /*
         * FIX: .crop-modal-overlay, .profile-avatar-fallback, .profile-avatar-img and
         * .cover-banner-img above all set `display` directly on a single-class selector
         * (specificity 0-1-0) — exactly the same specificity as Tailwind's `.hidden`
         * utility. With equal specificity, whichever rule appears LATER in the cascade
         * wins, regardless of which classes are actually present on the element. Since
         * this partial's <style> block loads after Tailwind's stylesheet, our `display`
         * rules were winning even when `.hidden` was applied — so the crop modal, the
         * avatar fallback letter, etc. never actually hid.
         * These ID-scoped overrides (specificity 1-1-0) always beat a plain class rule,
         * regardless of source order, so `.hidden` reliably wins whenever it's present —
         * without needing to touch or depend on Tailwind at all.
         */
        #cropOverlay.hidden { display: none; }
        #avatarFallback.hidden { display: none; }
        #avatarPreview.hidden { display: none; }
        #coverPreview.hidden { display: none; }
    </style>

    <div class="profile-card">
        <div class="profile-header">
            <div class="cover-banner" id="coverBanner">
                @if($user->cover_photo ?? false)
                    <img src="{{ asset('storage/' . $user->cover_photo) }}" alt="" class="cover-banner-img" id="coverPreview">
                @else
                    <img src="" alt="" class="cover-banner-img hidden" id="coverPreview">
                @endif

                <label for="cover_photo" class="cover-upload-btn" title="Ubah foto sampul">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4z"/>
                        <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5m0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                    </svg>
                    <span>Ubah Sampul</span>
                    <input type="file" id="cover_photo" name="cover_photo" accept="image/*" class="hidden" onchange="openCropper(event, 'cover')">
                </label>
            </div>

            <div class="profile-header-row">
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4z"/>
                            <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5m0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                        </svg>
                        <input type="file" id="foto" name="foto" accept="image/*" class="hidden" onchange="openCropper(event, 'avatar')">
                    </label>
                </div>

                <div class="profile-identity">
                    <h3 class="font-display text-xl font-semibold text-[#18120F]">{{ $user->nama }}</h3>
                    <div class="flex flex-wrap items-center gap-2">
                        @if($user->role === 'dev')
                            <span class="role-badge role-dev">Developer</span>
                        @elseif($user->role === 'admin')
                            <span class="role-badge role-admin">Admin</span>
                        @else
                            <span class="role-badge role-mahasiswa">Mahasiswa/User</span>
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
        </div>

        <div class="profile-body">
            @if (session('status') === 'profile-updated')
                <div class="saved-message mb-5">
                    ✓ Profil berhasil diperbarui.
                </div>
            @endif

            @error('foto')
                <div class="alert-warning mb-4"><span>{{ $message }}</span></div>
            @enderror
            @error('cover_photo')
                <div class="alert-warning mb-4"><span>{{ $message }}</span></div>
            @enderror

            <form id="profile-form" method="post" action="{{ route('profile.update') }}" class="space-y-5" enctype="multipart/form-data">
                @csrf
                @method('patch')

                {{-- Cropped blobs land here as base64 hidden fields before submit --}}
                <input type="hidden" name="foto_cropped" id="foto_cropped_input">
                <input type="hidden" name="cover_photo_cropped" id="cover_cropped_input">

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
                            <span class="text-xs text-[#948E86]" title="Tidak dapat diubah"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
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
    </div>

    {{-- ============ CROP MODAL ============ --}}
    <div class="crop-modal-overlay hidden" id="cropOverlay">
        <div class="crop-modal">
            <div class="crop-modal-header">
                <span class="crop-modal-title" id="cropModalTitle">Sesuaikan Foto</span>
                <button type="button" class="crop-modal-close" onclick="closeCropper()" aria-label="Tutup">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                    </svg>
                </button>
            </div>

            <div class="crop-stage" id="cropStage">
                <canvas class="crop-canvas" id="cropCanvas"></canvas>
                <svg class="crop-mask-svg" id="cropMaskSvg" xmlns="http://www.w3.org/2000/svg"></svg>
            </div>

            <div class="crop-controls">
                <div class="zoom-row">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11m6.44-1.06a7.5 7.5 0 1 1 1.06-1.06l3.04 3.04a.75.75 0 1 1-1.06 1.06z"/>
                    </svg>
                    <input type="range" class="zoom-slider" id="zoomSlider" min="1" max="4" step="0.01" value="1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11m6.44-1.06a7.5 7.5 0 1 1 1.06-1.06l3.04 3.04a.75.75 0 1 1-1.06 1.06z"/>
                    </svg>
                </div>
                <p class="crop-hint-text">Seret untuk menggeser · gunakan slider untuk memperbesar</p>
            </div>

            <div class="crop-actions">
                <button type="button" class="btn btn-ghost" onclick="closeCropper()">Batal</button>
                <button type="button" class="btn btn-primary" id="cropConfirmBtn" onclick="confirmCrop()">✓ Gunakan Foto</button>
            </div>
        </div>
    </div>

    <script>
        (function () {
            'use strict';

            // ---------- Elements ----------
            const overlay      = document.getElementById('cropOverlay');
            const stage         = document.getElementById('cropStage');
            const canvas        = document.getElementById('cropCanvas');
            const ctx           = canvas.getContext('2d');
            const maskSvg        = document.getElementById('cropMaskSvg');
            const zoomSlider     = document.getElementById('zoomSlider');
            const modalTitle     = document.getElementById('cropModalTitle');

            // ---------- Crop-target config ----------
            // avatar: 1:1 circular crop, output 480x480
            // cover : 16:5 rectangular crop, output 1280x400 (Facebook-ish cover ratio)
            const TARGETS = {
                avatar: { ratio: 1,     outW: 480,  outH: 480, shape: 'circle', label: 'Sesuaikan Foto Profil' },
                cover:  { ratio: 16/5,  outW: 1280, outH: 400, shape: 'rect',   label: 'Sesuaikan Foto Sampul' },
            };

            let currentTarget = null;   // 'avatar' | 'cover'
            let img = new Image();
            let imgLoaded = false;

            // Transform state: position of image center relative to stage center, plus scale
            let scale = 1;
            let minScale = 1;
            let offsetX = 0;
            let offsetY = 0;

            let stageW = 0, stageH = 0;
            // The crop "window" in stage-space (where the visible circle/rect sits)
            let cropWin = { x: 0, y: 0, w: 0, h: 0 };

            let dragging = false;
            let dragStartX = 0, dragStartY = 0;
            let dragOffsetStartX = 0, dragOffsetStartY = 0;

            // ---------- Open / close ----------
            window.openCropper = function (event, targetKey) {
                const file = event.target.files && event.target.files[0];
                if (!file) return;

                currentTarget = targetKey;
                const cfg = TARGETS[targetKey];
                modalTitle.textContent = cfg.label;

                const reader = new FileReader();
                reader.onload = function (e) {
                    img = new Image();
                    img.onload = function () {
                        imgLoaded = true;
                        overlay.classList.remove('hidden');
                        // layout needs the stage visible + measured, so defer to next frame
                        requestAnimationFrame(setupStage);
                    };
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);

                // reset the file input so selecting the same file again still fires change
                event.target.value = '';
            };

            window.closeCropper = function () {
                overlay.classList.add('hidden');
                imgLoaded = false;
                currentTarget = null;
            };

            // ---------- Stage setup ----------
            function setupStage() {
                const cfg = TARGETS[currentTarget];
                const rect = stage.getBoundingClientRect();
                stageW = rect.width;
                stageH = rect.height; // aspect-ratio:1/1 in CSS, so stageH === stageW

                canvas.width = stageW;
                canvas.height = stageH;

                // Define the crop window centered in the stage.
                // For avatar (1:1) the window is a centered circle nearly filling the stage.
                // For cover (16:5) the window is a centered wide rect.
                if (cfg.shape === 'circle') {
                    const size = stageW * 0.82;
                    cropWin = { x: (stageW - size) / 2, y: (stageH - size) / 2, w: size, h: size };
                } else {
                    const w = stageW * 0.92;
                    const h = w / cfg.ratio;
                    cropWin = { x: (stageW - w) / 2, y: (stageH - h) / 2, w: w, h: h };
                }

                // Minimum scale = smallest scale where image still fully covers the crop window
                const coverScaleW = cropWin.w / img.naturalWidth;
                const coverScaleH = cropWin.h / img.naturalHeight;
                minScale = Math.max(coverScaleW, coverScaleH);
                scale = minScale;

                zoomSlider.min = minScale.toFixed(4);
                zoomSlider.max = (minScale * 4).toFixed(4);
                zoomSlider.step = ((minScale * 4 - minScale) / 200).toFixed(6);
                zoomSlider.value = minScale.toFixed(4);

                offsetX = 0;
                offsetY = 0;

                buildMask();
                draw();
            }

            // ---------- Mask (darkened area outside the crop window) ----------
            function buildMask() {
                maskSvg.setAttribute('viewBox', `0 0 ${stageW} ${stageH}`);
                maskSvg.innerHTML = '';

                const cfg = TARGETS[currentTarget];
                const ns = 'http://www.w3.org/2000/svg';

                const defs = document.createElementNS(ns, 'defs');
                const mask = document.createElementNS(ns, 'mask');
                mask.setAttribute('id', 'stageMask');

                const full = document.createElementNS(ns, 'rect');
                full.setAttribute('x', 0); full.setAttribute('y', 0);
                full.setAttribute('width', stageW); full.setAttribute('height', stageH);
                full.setAttribute('fill', 'white');
                mask.appendChild(full);

                let hole;
                if (cfg.shape === 'circle') {
                    hole = document.createElementNS(ns, 'circle');
                    hole.setAttribute('cx', cropWin.x + cropWin.w / 2);
                    hole.setAttribute('cy', cropWin.y + cropWin.h / 2);
                    hole.setAttribute('r', cropWin.w / 2);
                } else {
                    hole = document.createElementNS(ns, 'rect');
                    hole.setAttribute('x', cropWin.x);
                    hole.setAttribute('y', cropWin.y);
                    hole.setAttribute('width', cropWin.w);
                    hole.setAttribute('height', cropWin.h);
                    hole.setAttribute('rx', 6);
                }
                hole.setAttribute('fill', 'black');
                mask.appendChild(hole);
                defs.appendChild(mask);
                maskSvg.appendChild(defs);

                const overlayRect = document.createElementNS(ns, 'rect');
                overlayRect.setAttribute('x', 0); overlayRect.setAttribute('y', 0);
                overlayRect.setAttribute('width', stageW); overlayRect.setAttribute('height', stageH);
                overlayRect.setAttribute('fill', 'rgba(24,18,15,0.62)');
                overlayRect.setAttribute('mask', 'url(#stageMask)');
                maskSvg.appendChild(overlayRect);

                const border = document.createElementNS(ns, cfg.shape === 'circle' ? 'circle' : 'rect');
                if (cfg.shape === 'circle') {
                    border.setAttribute('cx', cropWin.x + cropWin.w / 2);
                    border.setAttribute('cy', cropWin.y + cropWin.h / 2);
                    border.setAttribute('r', cropWin.w / 2);
                } else {
                    border.setAttribute('x', cropWin.x);
                    border.setAttribute('y', cropWin.y);
                    border.setAttribute('width', cropWin.w);
                    border.setAttribute('height', cropWin.h);
                    border.setAttribute('rx', 6);
                }
                border.setAttribute('fill', 'none');
                border.setAttribute('stroke', 'white');
                border.setAttribute('stroke-width', '2');
                maskSvg.appendChild(border);
            }

            // ---------- Draw image onto canvas given current scale/offset ----------
            function draw() {
                ctx.clearRect(0, 0, stageW, stageH);

                const drawW = img.naturalWidth * scale;
                const drawH = img.naturalHeight * scale;

                // Image is centered on stage center + user offset
                const cx = stageW / 2 + offsetX;
                const cy = stageH / 2 + offsetY;

                ctx.drawImage(img, cx - drawW / 2, cy - drawH / 2, drawW, drawH);
            }

            // ---------- Clamp offset so crop window always stays covered ----------
            function clampOffset() {
                const drawW = img.naturalWidth * scale;
                const drawH = img.naturalHeight * scale;

                const cx = stageW / 2;
                const cy = stageH / 2;

                // image edges in stage space before offset applied at 0,0 relative bounds
                // allowed offset range so that image edge never crosses inside crop window edge
                const maxOffsetX = (drawW / 2) - (cropWin.x + cropWin.w - cx);
                const minOffsetX = -((drawW / 2) - (cx - cropWin.x));
                const maxOffsetY = (drawH / 2) - (cropWin.y + cropWin.h - cy);
                const minOffsetY = -((drawH / 2) - (cy - cropWin.y));

                offsetX = Math.min(maxOffsetX, Math.max(minOffsetX, offsetX));
                offsetY = Math.min(maxOffsetY, Math.max(minOffsetY, offsetY));
            }

            // ---------- Pointer drag (mouse + touch via Pointer Events) ----------
            stage.addEventListener('pointerdown', function (e) {
                if (!imgLoaded) return;
                dragging = true;
                stage.setPointerCapture(e.pointerId);
                dragStartX = e.clientX;
                dragStartY = e.clientY;
                dragOffsetStartX = offsetX;
                dragOffsetStartY = offsetY;
            });

            stage.addEventListener('pointermove', function (e) {
                if (!dragging) return;
                offsetX = dragOffsetStartX + (e.clientX - dragStartX);
                offsetY = dragOffsetStartY + (e.clientY - dragStartY);
                clampOffset();
                draw();
            });

            function endDrag(e) {
                if (!dragging) return;
                dragging = false;
                try { stage.releasePointerCapture(e.pointerId); } catch (err) {}
            }
            stage.addEventListener('pointerup', endDrag);
            stage.addEventListener('pointercancel', endDrag);
            stage.addEventListener('pointerleave', function (e) { if (dragging) endDrag(e); });

            // ---------- Zoom ----------
            zoomSlider.addEventListener('input', function () {
                if (!imgLoaded) return;
                scale = parseFloat(zoomSlider.value);
                clampOffset();
                draw();
            });

            // mouse wheel zoom too, since it's a natural expectation
            stage.addEventListener('wheel', function (e) {
                if (!imgLoaded) return;
                e.preventDefault();
                const delta = e.deltaY > 0 ? -0.05 : 0.05;
                scale = Math.min(minScale * 4, Math.max(minScale, scale + delta * (minScale)));
                zoomSlider.value = scale.toFixed(4);
                clampOffset();
                draw();
            }, { passive: false });

            // ---------- Re-layout on resize (modal stays open across breakpoint changes) ----------
            window.addEventListener('resize', function () {
                if (!overlay.classList.contains('hidden') && imgLoaded) {
                    setupStage();
                }
            });

            // ---------- Confirm: export crop window to an output canvas at target resolution ----------
            window.confirmCrop = function () {
                const cfg = TARGETS[currentTarget];
                const out = document.createElement('canvas');
                out.width = cfg.outW;
                out.height = cfg.outH;
                const outCtx = out.getContext('2d');

                // Map: for every pixel in cropWin (stage space), find the corresponding
                // source pixel in the original image, then draw that mapped region scaled to outW/outH.
                const drawW = img.naturalWidth * scale;
                const drawH = img.naturalHeight * scale;
                const imgLeft = (stageW / 2 + offsetX) - drawW / 2;
                const imgTop  = (stageH / 2 + offsetY) - drawH / 2;

                const srcX = (cropWin.x - imgLeft) / scale;
                const srcY = (cropWin.y - imgTop) / scale;
                const srcW = cropWin.w / scale;
                const srcH = cropWin.h / scale;

                if (cfg.shape === 'circle') {
                    outCtx.save();
                    outCtx.beginPath();
                    outCtx.arc(cfg.outW / 2, cfg.outH / 2, cfg.outW / 2, 0, Math.PI * 2);
                    outCtx.closePath();
                    outCtx.clip();
                }

                outCtx.drawImage(img, srcX, srcY, srcW, srcH, 0, 0, cfg.outW, cfg.outH);

                if (cfg.shape === 'circle') {
                    outCtx.restore();
                }

                const mime = cfg.shape === 'circle' ? 'image/png' : 'image/jpeg';
                const dataUrl = out.toDataURL(mime, 0.92);

                // Push result into the hidden field + live preview, then close.
                if (currentTarget === 'avatar') {
                    document.getElementById('foto_cropped_input').value = dataUrl;
                    const preview = document.getElementById('avatarPreview');
                    const fallback = document.getElementById('avatarFallback');
                    preview.src = dataUrl;
                    preview.classList.remove('hidden');
                    if (fallback) fallback.classList.add('hidden');
                } else {
                    document.getElementById('cover_cropped_input').value = dataUrl;
                    const preview = document.getElementById('coverPreview');
                    preview.src = dataUrl;
                    preview.classList.remove('hidden');
                }

                closeCropper();
            };
        })();
    </script>
</section>