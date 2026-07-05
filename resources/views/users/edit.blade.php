<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pengguna') }}
        </h2>
    </x-slot>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        .font-display { font-family: 'Fraunces', serif; font-feature-settings: 'ss01' 1; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }

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

        .form-input,
        .form-select {
            padding: 0.875rem 1rem;
            border: 1.5px solid #18120F;
            border-radius: 0.75rem;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            color: #18120F;
            background-color: white;
            transition: all 0.2s ease;
        }

        .form-input::placeholder {
            color: #C9C3B9;
        }

        .form-input:focus,
        .form-select:focus {
            outline: none;
            border-color: #E63912;
            background-color: #FEF7F3;
            box-shadow: 0 2px 8px rgba(230, 57, 18, 0.1);
        }

        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23E63912' stroke-width='2.5'%3E%3Cpath d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 1rem;
            padding-right: 2.5rem;
            cursor: pointer;
        }

        .form-select option {
            color: #18120F;
            background-color: white;
            padding: 0.5rem;
        }

        .form-error {
            font-size: 12px;
            color: #DC2626;
            font-family: 'Inter', sans-serif;
        }

        .alert-error {
            background-color: #FEF2F2;
            border: 1px solid #FECACA;
            color: #7F1D1D;
            padding: 1rem;
            border-radius: 0.75rem;
            font-weight: 500;
            font-size: 14px;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .alert-error-icon {
            flex-shrink: 0;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-card {
            background: white;
            border: 1px solid #EAE6DF;
            border-radius: 0.875rem;
            padding: 2rem;
            box-shadow: 0 1px 2px rgba(24, 18, 15, 0.04);
        }

        .form-divider {
            height: 1px;
            background-color: #EAE6DF;
            margin: 2rem 0;
        }

        .button-group {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
            flex-wrap: wrap;
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
        }

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

        .btn-secondary {
            background-color: white;
            color: #18120F;
            border-color: #18120F;
        }

        .btn-secondary:hover {
            background-color: #F7F5F2;
            border-color: #E63912;
            color: #E63912;
        }

        .info-section {
            background-color: #F7F5F2;
            border-left: 3px solid #E63912;
            padding: 1rem;
            border-radius: 0.5rem;
            font-size: 13px;
            line-height: 1.6;
        }

        .info-section-label {
            font-family: 'JetBrains Mono', monospace;
            font-size: 10px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #948E86;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .info-section-content {
            color: #18120F;
            font-family: 'Inter', sans-serif;
        }

        .form-section-title {
            font-family: 'Fraunces', serif;
            font-size: 16px;
            font-weight: 600;
            color: #18120F;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .form-section-title::before {
            content: '';
            width: 3px;
            height: 20px;
            background-color: #E63912;
            border-radius: 1.5px;
        }
    </style>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8">
                <div class="flex items-center gap-2 mb-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#E63912]"></span>
                    <span class="font-mono text-[11px] uppercase tracking-[0.18em] text-[#948E86]">Manajemen Akun</span>
                </div>
                <h3 class="font-display text-3xl font-semibold text-[#18120F] mb-2">Edit Pengguna</h3>
                <p class="text-sm text-[#948E86]">Perbarui informasi dan role pengguna sistem.</p>
            </div>

            @if($errors->any())
                <div class="alert-error mb-6">
                    <div class="alert-error-icon">⚠</div>
                    <div>
                        <strong>Terjadi kesalahan:</strong>
                        <ul class="mt-1 list-disc list-inside space-y-0.5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="form-card">
                    <h4 class="form-section-title">Informasi Dasar</h4>

                    <div class="space-y-5">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap</label>
                            <input 
                                type="text" 
                                name="nama" 
                                class="form-input @error('nama') border-red-500 @enderror"
                                value="{{ old('nama', $user->nama) }}"
                                placeholder="Masukkan nama lengkap pengguna"
                                required
                            >
                            @error('nama')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input 
                                type="email" 
                                name="email" 
                                class="form-input @error('email') border-red-500 @enderror"
                                value="{{ old('email', $user->email) }}"
                                placeholder="Masukkan email pengguna"
                                required
                            >
                            @error('email')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Role</label>
                            <select 
                                name="role" 
                                class="form-select @error('role') border-red-500 @enderror"
                                required
                            >
                                <option value="">-- Pilih Role --</option>
                                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="mahasiswa" {{ old('role', $user->role) === 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                                <option value="dev" {{ old('role', $user->role) === 'dev' ? 'selected' : '' }}>Developer</option>
                            </select>
                            @error('role')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Password Baru (Opsional)</label>
                            <input 
                                type="password" 
                                name="password" 
                                class="form-input @error('password') border-red-500 @enderror"
                                placeholder="Kosongkan jika tidak ingin mengubah password"
                            >
                            <p class="text-[12px] text-[#948E86]">Password minimal 8 karakter. Biarkan kosong jika tidak ingin mengubah.</p>
                            @error('password')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Konfirmasi Password</label>
                            <input 
                                type="password" 
                                name="password_confirmation" 
                                class="form-input"
                                placeholder="Ketik ulang password baru (jika ada)"
                            >
                        </div>
                    </div>
                </div>

                <div class="form-card">
                    <h4 class="form-section-title">Informasi Akun</h4>

                    <div class="space-y-3">
                        <div class="info-section">
                            <div class="info-section-label">ID Pengguna</div>
                            <div class="info-section-content font-mono text-[#6B7280]">{{ $user->id }}</div>
                        </div>

                        <div class="info-section">
                            <div class="info-section-label">Dibuat Pada</div>
                            <div class="info-section-content">
                                {{ $user->created_at->format('d F Y \p\u\k\u\l H:i') }}
                            </div>
                        </div>

                        <div class="info-section">
                            <div class="info-section-label">Diperbarui Pada</div>
                            <div class="info-section-content">
                                {{ $user->updated_at->format('d F Y \p\u\k\u\l H:i') }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="button-group">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">
                        ← Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        ✓ Simpan Perubahan
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>