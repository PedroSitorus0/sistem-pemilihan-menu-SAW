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

        .role-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.375rem 0.875rem;
            border-radius: 0.5rem;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            font-family: 'JetBrains Mono', monospace;
        }

        .role-dev {
            background-color: #EDE9FE;
            color: #6D28D9;
            border: 1px solid #DDD6FE;
        }

        .role-admin {
            background-color: #FEF3C7;
            color: #92400E;
            border: 1px solid #FCD34D;
        }

        .role-user {
            background-color: #F3F4F6;
            color: #374151;
            border: 1px solid #E5E7EB;
        }

        .self-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            margin-left: 0.5rem;
            padding: 0.25rem 0.625rem;
            background-color: #DBEAFE;
            color: #1E40AF;
            border-radius: 9999px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.05em;
            font-family: 'JetBrains Mono', monospace;
        }

        .self-badge::before {
            content: '';
            width: 6px;
            height: 6px;
            background-color: #1E40AF;
            border-radius: 50%;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.5rem 0.875rem;
            font-size: 13px;
            font-weight: 600;
            border-radius: 0.5rem;
            border: 1.5px solid transparent;
            cursor: pointer;
            transition: all 0.2s ease;
            font-family: 'JetBrains Mono', monospace;
            text-decoration: none;
        }

        .btn-edit {
            background-color: #ECFDF5;
            color: #065F46;
            border-color: #A7F3D0;
        }

        .btn-edit:hover {
            background-color: #D1FAE5;
            border-color: #6EE7B7;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.12);
        }

        .btn-delete {
            background-color: #FEF2F2;
            color: #7F1D1D;
            border-color: #FECACA;
        }

        .btn-delete:hover {
            background-color: #FEE2E2;
            border-color: #FCA5A5;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.12);
        }

        .btn-restricted {
            padding: 0.5rem 0.875rem;
            font-size: 12px;
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
            box-shadow: 0 1px 3px rgba(24, 18, 15, 0.06);
        }

        #table thead {
            background-color: #F7F5F2;
            border-color: #EAE6DF;
        }

        #table thead th {
            color: #18120F;
            font-weight: 600;
            padding: 1rem 1.5rem;
            border-color: #EAE6DF;
        }

        #table tbody td {
            padding: 1rem 1.5rem;
            color: #18120F;
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
        }

        .alert-success {
            background-color: #ECFDF5;
            border-color: #A7F3D0;
            color: #065F46;
            border-radius: 0.75rem;
            padding: 1rem;
            border: 1px solid;
            font-weight: 500;
            font-size: 14px;
        }

        .pagination-container {
            margin-top: 1.5rem;
        }

        .pagination-container * {
            font-family: 'JetBrains Mono', monospace !important;
        }

        /* DataTables Custom Styling */
        .dataTables_wrapper {
            position: relative;
        }

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
            transition: all 0.2s ease;
        }

        .dataTables_length select:hover {
            background-color: #F7F5F2;
            border-color: #E63912;
        }

        .dataTables_filter {
            margin-bottom: 1.25rem !important;
            float: none !important;
            text-align: right;
        }

        .dataTables_filter label {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-family: 'JetBrains Mono', monospace !important;
            font-size: 13px;
            color: #18120F;
            justify-content: flex-end;
            margin: 0;
        }

        .dataTables_filter input {
            padding: 0.625rem 0.875rem;
            border: 1.5px solid #18120F;
            border-radius: 0.5rem;
            font-family: 'JetBrains Mono', monospace !important;
            font-size: 13px;
            color: #18120F;
            transition: all 0.2s ease;
        }

        .dataTables_filter input:focus {
            outline: none;
            border-color: #E63912;
            background-color: #FEF7F3;
            box-shadow: 0 2px 8px rgba(230, 57, 18, 0.1);
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
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .dataTables_paginate .paginate_button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 2.5rem;
            padding: 0.5rem 0.75rem;
            border: 1.5px solid #18120F;
            border-radius: 0.5rem;
            background-color: white;
            color: #18120F;
            font-family: 'JetBrains Mono', monospace !important;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .dataTables_paginate .paginate_button:hover:not(.disabled) {
            background-color: #F7F5F2;
            border-color: #E63912;
            box-shadow: 0 2px 8px rgba(230, 57, 18, 0.1);
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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#E63912]"></span>
                        <span class="table-header-label">Manajemen Akun</span>
                    </div>
                    <h3 class="font-display text-2xl font-semibold text-[#18120F]">Daftar Pengguna Sistem</h3>
                    <p class="text-sm text-[#948E86] mt-1">Kelola data dan hak akses pengguna aplikasi Anda.</p>
                </div>
            </div>

            @if(session('success'))
                <div class="alert-success mb-6">
                    ✓ {{ session('success') }}
                </div>
            @endif

            <div class="table-container">
                <div class="table-overflow">
                    <table class="w-full text-sm text-left text-[#18120F]" id="table">
                        <thead>
                            <tr>
                                <th class="table-header-label">Nama Lengkap</th>
                                <th class="table-header-label">Email</th>
                                <th class="table-header-label">Role</th>
                                <th class="table-header-label text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                @php
                                    // LOGIKA TOMBOL FRONT-END
                                    $canEdit = false;
                                    $currentUserRole = auth()->user()->role;
                                    
                                    if ($currentUserRole === 'dev' && $user->role !== 'dev') {
                                        $canEdit = true;
                                    } elseif ($currentUserRole === 'admin' && $user->role === 'user') {
                                        $canEdit = true;
                                    }
                                @endphp

                                <tr>
                                    <td>
                                        <div class="font-display font-semibold text-[#18120F]">
                                            {{ $user->nama }}
                                            @if($user->id === auth()->id())
                                                <span class="self-badge">Anda</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="font-mono text-[#6B7280]">{{ $user->email }}</span>
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
                                    <td class="text-center">
                                        @if($canEdit)
                                            <div class="flex justify-center items-center gap-2 flex-wrap">
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn-action btn-edit">
                                                    Edit
                                                </a>
                                                
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-action btn-delete">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="btn-restricted">Akses Dibatasi</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="pagination-container">
                {{ $users->links() }}
            </div>

        </div>
    </div>
</x-app-layout>