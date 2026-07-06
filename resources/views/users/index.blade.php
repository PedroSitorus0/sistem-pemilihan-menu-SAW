<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manajemen Pengguna') }}
        </h2>
    </x-slot>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        .font-display { font-family: 'Fraunces', serif; font-feature-settings: 'ss01' 1; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }

        .table-header-label {
            font-family: 'JetBrains Mono', monospace;
            font-size: 10px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #948E86;
            font-weight: 600;
        }

        .user-avatar-img {
            width: 40px;
            height: 40px;
            border-radius: 9999px;
            object-fit: cover;
            border: 1px solid #EAE6DF;
            flex-shrink: 0;
        }

        .user-avatar-fallback {
            width: 40px;
            height: 40px;
            border-radius: 9999px;
            background-color: #FEF7F3;
            border: 1px solid #F4C7B8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Fraunces', serif;
            font-size: 15px;
            font-weight: 600;
            color: #E63912;
            flex-shrink: 0;
        }

        .role-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.3rem 0.75rem;
            border-radius: 0.5rem;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            font-family: 'JetBrains Mono', monospace;
            white-space: nowrap;
        }

        .role-dev { background-color: #EDE9FE; color: #6D28D9; border: 1px solid #DDD6FE; }
        .role-admin { background-color: #FEF3C7; color: #92400E; border: 1px solid #FCD34D; }
        .role-user { background-color: #F3F4F6; color: #374151; border: 1px solid #E5E7EB; }

        .self-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            margin-left: 0.4rem;
            padding: 0.2rem 0.55rem;
            background-color: #DBEAFE;
            color: #1E40AF;
            border-radius: 9999px;
            font-size: 10px;
            font-weight: 600;
            font-family: 'JetBrains Mono', monospace;
            white-space: nowrap;
        }

        .self-badge::before {
            content: '';
            width: 5px;
            height: 5px;
            background-color: #1E40AF;
            border-radius: 50%;
        }

        .verify-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.25rem 0.6rem;
            border-radius: 9999px;
            font-size: 10px;
            font-weight: 600;
            font-family: 'JetBrains Mono', monospace;
            white-space: nowrap;
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

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.45rem 0.8rem;
            font-size: 12px;
            font-weight: 600;
            border-radius: 0.5rem;
            border: 1.5px solid transparent;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: 'JetBrains Mono', monospace;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-edit {
            background-color: #ECFDF5;
            color: #065F46;
            border-color: #A7F3D0;
        }
        .btn-edit:hover { background-color: #D1FAE5; border-color: #6EE7B7; }

        .btn-delete {
            background-color: #FEF2F2;
            color: #7F1D1D;
            border-color: #FECACA;
        }
        .btn-delete:hover { background-color: #FEE2E2; border-color: #FCA5A5; }

        .btn-verify {
            background-color: #EFF6FF;
            color: #1E40AF;
            border-color: #BFDBFE;
        }
        .btn-verify:hover { background-color: #DBEAFE; border-color: #93C5FD; }

        .btn-reject {
            background-color: #FFF7ED;
            color: #9A3412;
            border-color: #FED7AA;
        }
        .btn-reject:hover { background-color: #FFEDD5; border-color: #FDBA74; }

        .btn-restricted {
            font-size: 11px;
            color: #9CA3AF;
            font-family: 'JetBrains Mono', monospace;
            cursor: not-allowed;
        }

        #table tbody tr {
            border-color: #EAE6DF;
            transition: all 0.2s ease;
        }
        #table tbody tr:hover {
            background-color: #FEFDFB;
        }
        #table thead {
            background-color: #F7F5F2;
            border-color: #EAE6DF;
        }
        #table thead th {
            color: #18120F;
            font-weight: 600;
            padding: 1rem 1.25rem;
            border-color: #EAE6DF;
            white-space: nowrap;
        }
        #table tbody td {
            padding: 0.9rem 1.25rem;
            color: #18120F;
            vertical-align: middle;
        }

        @media (max-width: 640px) {
            #table thead th, #table tbody td {
                padding: 0.65rem 0.85rem;
                font-size: 12.5px;
            }
        }

        .table-container {
            background: white;
            border: 1px solid #EAE6DF;
            border-radius: 0.875rem;
            overflow: hidden;
            box-shadow: 0 1px 2px rgba(24, 18, 15, 0.04);
        }

        .table-overflow {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .alert-box {
            border-radius: 0.75rem;
            padding: 1rem;
            border: 1px solid;
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background-color: #ECFDF5;
            border-color: #A7F3D0;
            color: #065F46;
        }

        .alert-error {
            background-color: #FEF2F2;
            border-color: #FECACA;
            color: #7F1D1D;
        }

        .pagination-container { margin-top: 1.5rem; }
        .pagination-container * { font-family: 'JetBrains Mono', monospace !important; }

        .dataTables_wrapper { position: relative; }

        .dataTables_length {
            margin-bottom: 1.25rem !important;
            float: none !important;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .dataTables_length label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-family: 'JetBrains Mono', monospace !important;
            font-size: 13px;
            color: #18120F;
            margin: 0;
            flex-wrap: wrap;
        }
        .dataTables_length select {
            padding: 0.5rem 0.75rem;
            border: 1.5px solid #18120F;
            border-radius: 0.5rem;
            background-color: white;
            color: #18120F;
            font-family: 'JetBrains Mono', monospace !important;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }
        .dataTables_length select:hover { background-color: #F7F5F2; border-color: #E63912; }

        .dataTables_filter {
            margin-bottom: 1.25rem !important;
            float: none !important;
            text-align: left;
        }
        @media (min-width: 640px) { .dataTables_filter { text-align: right; } }

        .dataTables_filter label {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-family: 'JetBrains Mono', monospace !important;
            font-size: 13px;
            color: #18120F;
            justify-content: flex-start;
            margin: 0;
            flex-wrap: wrap;
            width: 100%;
        }
        @media (min-width: 640px) { .dataTables_filter label { justify-content: flex-end; } }

        .dataTables_filter input {
            padding: 0.625rem 0.875rem;
            border: 1.5px solid #18120F;
            border-radius: 0.5rem;
            font-family: 'JetBrains Mono', monospace !important;
            font-size: 13px;
            color: #18120F;
            flex: 1;
            min-width: 0;
        }
        @media (min-width: 640px) { .dataTables_filter input { flex: none; } }

        .dataTables_filter input:focus {
            outline: none;
            border-color: #E63912;
            background-color: #FEF7F3;
        }

        .dataTables_info {
            padding: 1rem 0 !important;
            font-family: 'JetBrains Mono', monospace !important;
            font-size: 12px;
            color: #948E86;
            float: none !important;
            text-align: left;
            border-top: 1px solid #EAE6DF;
            margin-top: 1rem !important;
        }

        .dataTables_paginate {
            float: none !important;
            text-align: right;
            padding: 1rem 0 0 0 !important;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 0.4rem;
            flex-wrap: wrap;
        }

        .dataTables_paginate .paginate_button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 2.25rem;
            padding: 0.45rem 0.65rem;
            border: 1.5px solid #18120F;
            border-radius: 0.5rem;
            background-color: white;
            color: #18120F;
            font-family: 'JetBrains Mono', monospace !important;
            font-size: 12.5px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
        }

        .dataTables_paginate .paginate_button:hover:not(.disabled) {
            background-color: #F7F5F2;
            border-color: #E63912;
        }
        .dataTables_paginate .paginate_button.current {
            background-color: #E63912;
            color: white;
            border-color: #E63912;
        }
        .dataTables_paginate .paginate_button.disabled,
        .dataTables_paginate .paginate_button.disabled:hover {
            background-color: #F3F4F6;
            color: #D1D5DB;
            border-color: #E5E7EB;
            cursor: not-allowed;
        }
    </style>

    <x-app-layout>
    <div class="py-8 sm:py-12">
        <div class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-6 sm:mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#E63912]"></span>
                        <span class="table-header-label">Manajemen Akun</span>
                    </div>
                    <h3 class="font-display text-xl sm:text-2xl font-semibold text-[#18120F]">Daftar Pengguna Sistem</h3>
                    <p class="text-sm text-[#948E86] mt-1">Kelola data, foto, verifikasi NIM, dan hak akses pengguna.</p>
                </div>
            </div>

            @if(session('success'))
                <div class="alert-box alert-success">✓ {{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert-box alert-error">⚠ {{ session('error') }}</div>
            @endif

            <div class="table-container">
                <div class="table-overflow w-full overflow-x-auto">
                    <table class="w-full text-sm text-left text-[#18120F]" id="table">
                        <thead>
                            <tr>
                                <th class="table-header-label">Pengguna</th>
                                <th class="table-header-label">Role</th>
                                <th class="table-header-label">NIM</th>
                                <th class="table-header-label text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                @php
                                    $canEdit = false;
                                    $currentUserRole = auth()->user()->role;

                                    if ($currentUserRole === 'dev' && $user->role !== 'dev') {
                                        $canEdit = true;
                                    } elseif ($currentUserRole === 'admin' && $user->role === 'user') {
                                        $canEdit = true;
                                    }

                                    $canVerifyNim = in_array($currentUserRole, ['admin', 'dev']);
                                @endphp

                                <tr>
                                    <td>
                                        <div class="flex items-center gap-3 min-w-[180px]">
                                            @if($user->foto)
                                                <img src="{{ asset('storage/' . $user->foto) }}" alt="{{ $user->nama }}" class="user-avatar-img">
                                            @else
                                                <div class="user-avatar-fallback">
                                                    {{ strtoupper(substr($user->nama, 0, 1)) }}
                                                </div>
                                            @endif
                                            <div class="min-w-0">
                                                <div class="font-display font-semibold text-[#18120F] flex items-center flex-wrap gap-1 leading-tight">
                                                    <span class="truncate max-w-[140px] sm:max-w-none">{{ $user->nama }}</span>
                                                    @if($user->id === auth()->id())
                                                        <span class="self-badge">Anda</span>
                                                    @endif
                                                </div>
                                                <div class="font-mono text-[#6B7280] text-xs truncate max-w-[160px] sm:max-w-none">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($user->role === 'dev')
                                            <span class="role-badge role-dev">Developer</span>
                                        @elseif($user->role === 'admin')
                                            <span class="role-badge role-admin">Admin</span>
                                        @else
                                            <span class="role-badge role-user">User</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->nomor_induk)
                                            <div class="flex flex-col gap-1">
                                                <span class="font-mono text-xs text-[#18120F]">{{ $user->nomor_induk }}</span>
                                                @if($user->nomor_induk_verified_at)
                                                    <span class="verify-badge verified w-fit">✓ Terverifikasi</span>
                                                @else
                                                    <span class="verify-badge pending w-fit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hourglass-bottom inline-block mr-1" viewBox="0 0 16 16">
                                                            <path d="M2 1.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1-.5-.5m2.5.5v1a3.5 3.5 0 0 0 1.989 3.158c.533.256 1.011.791 1.011 1.491v.702s.18.149.5.149.5-.15.5-.15v-.7c0-.701.478-1.236 1.011-1.492A3.5 3.5 0 0 0 11.5 3V2z"/>
                                                        </svg> 
                                                        Menunggu
                                                    </span>
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-[#948E86] text-xs">- belum diisi -</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="flex justify-center items-center gap-1.5 flex-wrap">
                                            @if($canVerifyNim && $user->nomor_induk && !$user->nomor_induk_verified_at)
                                                <form action="{{ route('users.verifyNim', $user->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn-action btn-verify" title="Verifikasi NIM ini">
                                                        ✓ Verifikasi
                                                    </button>
                                                </form>
                                                <form action="{{ route('users.rejectNim', $user->id) }}" method="POST" onsubmit="return confirm('Tolak NIM ini? User harus mengisi ulang.');" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn-action btn-reject" title="Tolak NIM ini">
                                                        ✕ Tolak
                                                    </button>
                                                </form>
                                            @endif

                                            @if($canEdit)
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn-action btn-edit">Edit</a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-action btn-delete">Hapus</button>
                                                </form>
                                            @endif

                                            @if(!$canEdit && !($canVerifyNim && $user->nomor_induk && !$user->nomor_induk_verified_at))
                                                <span class="btn-restricted">Akses Dibatasi</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="pagination-container mt-4">
                {{ $users->links() }}
            </div>

        </div>
    </div>
</x-app-layout>