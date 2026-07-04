<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('System Logs') }}
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

        .method-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            border-radius: 0.5rem;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            font-family: 'JetBrains Mono', monospace;
            border: 1px solid;
        }

        .method-get {
            background-color: #DBEAFE;
            color: #1E40AF;
            border-color: #BFDBFE;
        }

        .method-post {
            background-color: #DCFCE7;
            color: #166534;
            border-color: #BBEF63;
        }

        .method-put,
        .method-patch {
            background-color: #FEF08A;
            color: #713F12;
            border-color: #FECF5C;
        }

        .method-delete {
            background-color: #FEE2E2;
            color: #7F1D1D;
            border-color: #FECACA;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.375rem 0.75rem;
            border-radius: 0.5rem;
            font-size: 11px;
            font-weight: 600;
            font-family: 'JetBrains Mono', monospace;
            border: 1px solid;
        }

        .status-ok {
            background-color: #F0FDF4;
            color: #166534;
            border-color: #BBF7D0;
        }

        .status-error {
            background-color: #FEF2F2;
            color: #991B1B;
            border-color: #FECACA;
        }

        .status-error-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: #DC2626;
            flex-shrink: 0;
        }

        .btn-detail {
            background-color: #F0F9FF;
            color: #075985;
            border-color: #BAE6FD;
        }

        .btn-detail:hover {
            background-color: #E0F2FE;
            border-color: #7DD3FC;
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

        .filter-card {
            background: white;
            border: 1px solid #EAE6DF;
            border-radius: 0.875rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .filter-label {
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #948E86;
            font-weight: 600;
        }

        .filter-input,
        .filter-select {
            padding: 0.75rem 0.875rem;
            border: 1.5px solid #18120F;
            border-radius: 0.5rem;
            font-family: 'Inter', sans-serif;
            font-size: 13px;
            color: #18120F;
            background-color: white;
            transition: all 0.2s ease;
        }

        .filter-input:focus,
        .filter-select:focus {
            outline: none;
            border-color: #E63912;
            background-color: #FEF7F3;
            box-shadow: 0 2px 8px rgba(230, 57, 18, 0.1);
        }

        .filter-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23E63912' stroke-width='2.5'%3E%3Cpath d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 0.875rem;
            padding-right: 2.5rem;
            cursor: pointer;
        }

        .filter-buttons {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.375rem;
            padding: 0.75rem 1.25rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.05em;
            border: 1.5px solid;
            border-radius: 0.5rem;
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

        .btn-small {
            padding: 0.5rem 0.75rem;
            font-size: 11px;
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
            margin-bottom: 1.5rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: white;
            border: 1px solid #EAE6DF;
            border-radius: 0.75rem;
            padding: 1.25rem;
            text-align: center;
        }

        .stat-label {
            font-family: 'JetBrains Mono', monospace;
            font-size: 10px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #948E86;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-family: 'Fraunces', serif;
            font-size: 24px;
            font-weight: 600;
            color: #18120F;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#E63912]"></span>
                        <span class="table-header-label">Aktivitas Sistem</span>
                    </div>
                    <h3 class="font-display text-2xl font-semibold text-[#18120F]">System Logs</h3>
                    <p class="text-sm text-[#948E86] mt-1">Pantau semua aktivitas pengguna dalam sistem.</p>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('logs.export', request()->query()) }}" class="btn btn-secondary">
                        ↓ Export CSV
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert-success">
                    ✓ {{ session('success') }}
                </div>
            @endif

            <!-- Filter Section -->
            <div class="filter-card">
                <h4 class="font-display text-sm font-semibold text-[#18120F] mb-4">Filter & Cari</h4>

                <form method="GET" action="{{ route('logs.index') }}">
                    <div class="filter-grid">
                        <div class="filter-group">
                            <label class="filter-label">Pengguna</label>
                            <select name="user_id" class="filter-select">
                                <option value="">-- Semua Pengguna --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" 
                                        {{ ($filters['user_id'] ?? '') == $user->id ? 'selected' : '' }}>
                                        {{ $user->nama }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="filter-group">
                            <label class="filter-label">Method HTTP</label>
                            <select name="method" class="filter-select">
                                <option value="">-- Semua Method --</option>
                                <option value="GET" {{ ($filters['method'] ?? '') === 'GET' ? 'selected' : '' }}>GET</option>
                                <option value="POST" {{ ($filters['method'] ?? '') === 'POST' ? 'selected' : '' }}>POST</option>
                                <option value="PUT" {{ ($filters['method'] ?? '') === 'PUT' ? 'selected' : '' }}>PUT</option>
                                <option value="PATCH" {{ ($filters['method'] ?? '') === 'PATCH' ? 'selected' : '' }}>PATCH</option>
                                <option value="DELETE" {{ ($filters['method'] ?? '') === 'DELETE' ? 'selected' : '' }}>DELETE</option>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label class="filter-label">Tanggal Dari</label>
                            <input type="date" name="date_from" class="filter-input" value="{{ $filters['date_from'] ?? '' }}">
                        </div>

                        <div class="filter-group">
                            <label class="filter-label">Tanggal Hingga</label>
                            <input type="date" name="date_to" class="filter-input" value="{{ $filters['date_to'] ?? '' }}">
                        </div>

                        <div class="filter-group">
                            <label class="filter-label">Cari URL</label>
                            <input type="text" name="url" class="filter-input" placeholder="Cari URL..." value="{{ $filters['url'] ?? '' }}">
                        </div>

                        <div class="filter-group">
                            <label class="filter-label">Cari Aksi</label>
                            <input type="text" name="aksi" class="filter-input" placeholder="Cari aksi..." value="{{ $filters['aksi'] ?? '' }}">
                        </div>

                        <div class="filter-group">
                            <label class="filter-label">Status / Error</label>
                            <select name="status" class="filter-select">
                                <option value="">-- Semua Status --</option>
                                <option value="errors" {{ ($filters['status'] ?? '') === 'errors' ? 'selected' : '' }}> Hanya Error (4xx/5xx)</option>
                                <option value="404" {{ ($filters['status'] ?? '') == '404' ? 'selected' : '' }}>404 - Not Found</option>
                                <option value="405" {{ ($filters['status'] ?? '') == '405' ? 'selected' : '' }}>405 - Method Not Allowed</option>
                                <option value="401" {{ ($filters['status'] ?? '') == '401' ? 'selected' : '' }}>401 - Unauthenticated</option>
                                <option value="403" {{ ($filters['status'] ?? '') == '403' ? 'selected' : '' }}>403 - Forbidden</option>
                                <option value="419" {{ ($filters['status'] ?? '') == '419' ? 'selected' : '' }}>419 - Session Expired</option>
                                <option value="422" {{ ($filters['status'] ?? '') == '422' ? 'selected' : '' }}>422 - Validasi Gagal</option>
                                <option value="429" {{ ($filters['status'] ?? '') == '429' ? 'selected' : '' }}>429 - Too Many Requests</option>
                                <option value="500" {{ ($filters['status'] ?? '') == '500' ? 'selected' : '' }}>500 - Server Error</option>
                                <option value="503" {{ ($filters['status'] ?? '') == '503' ? 'selected' : '' }}>503 - Service Unavailable</option>
                            </select>
                        </div>
                    </div>

                    <div class="filter-buttons">
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                            </svg>
                        </button>
                        <a href="{{ route('logs.index') }}" class="btn btn-secondary">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Stats -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Total Logs</div>
                    <div class="stat-value">{{ $logs->total() }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Halaman Ini</div>
                    <div class="stat-value">{{ $logs->count() }}</div>
                </div>
                <div class="stat-card" style="border-color: #FECACA;">
                    <div class="stat-label">Total Error</div>
                    <div class="stat-value" style="color: #DC2626;">{{ $totalErrors }}</div>
                </div>
            </div>

            <!-- Table -->
            <div class="table-container">
                <div class="table-overflow">
                    <table class="w-full text-sm text-left text-[#18120F]" id="table">
                        <thead>
                            <tr>
                                <th class="table-header-label">Pengguna</th>
                                <th class="table-header-label">Method</th>
                                <th class="table-header-label">URL</th>
                                <th class="table-header-label">Aksi</th>
                                <th class="table-header-label">Status</th>
                                <th class="table-header-label">IP Address</th>
                                <th class="table-header-label">Waktu</th>
                                <th class="table-header-label text-center">Aksi</th>
                            </tr>
                        </thead>
                        {{-- <tbody>
                            @forelse($logs as $log)
                                <tr @if($log->is_error) style="background-color: #FFFBFB;" @endif>
                                    <td>
                                        <div class="font-display font-semibold">{{ $log->user->name }}</div>
                                        <div class="font-mono text-[#6B7280] text-xs">{{ $log->user->email }}</div>
                                    </td>
                                    <td>
                                        <span class="method-badge method-{{ strtolower($log->method) }}">
                                            {{ $log->method }}
                                        </span>
                                    </td>
                                    <td>
                                        <code class="font-mono text-[#6B7280] text-xs bg-[#F7F5F2] px-2 py-1 rounded">
                                            {{ $log->url }}
                                        </code>
                                    </td>
                                    <td>
                                        <span class="text-[#18120F] text-sm">{{ $log->aksi }}</span>
                                    </td>
                                    <td>
                                        @if($log->status_code)
                                            <span class="status-badge {{ $log->is_error ? 'status-error' : 'status-ok' }}">
                                                @if($log->is_error)
                                                    <span class="status-error-dot"></span>
                                                @endif
                                                {{ $log->status_code }}
                                            </span>
                                        @else
                                            <span class="text-[#948E86] text-xs">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="font-mono text-[#6B7280] text-xs">{{ $log->ip_address ?? '-' }}</span>
                                    </td>
                                    <td>
                                        <div class="text-sm">{{ $log->created_at->format('d M Y') }}</div>
                                        <div class="font-mono text-[#6B7280] text-xs">{{ $log->created_at->format('H:i:s') }}</div>
                                    </td>
                                    <td class="text-center">
                                        <div class="flex justify-center items-center gap-1.5">
                                            @if($log->is_error)
                                                <a href="{{ route('logs.show', $log->id) }}" class="btn btn-small btn-detail">
                                                    🔍 Detail
                                                </a>
                                            @endif
                                            <form action="{{ route('logs.destroy', $log->id) }}" method="POST" onsubmit="return confirm('Hapus log ini?');" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-small btn-delete" style="background-color: #FEF2F2; color: #7F1D1D; border-color: #FECACA;">
                                                    🗑
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-[#948E86] py-8">
                                        Tidak ada logs yang sesuai dengan filter
                                    </td>
                                </tr>
                            @endforelse
                        </tbody> --}}
                        <tbody>
    @foreach($logs as $log)
        <tr @if($log->is_error) style="background-color: #FFFBFB;" @endif>
            <td>
                <div class="font-display font-semibold">{{ $log->user->name ?? 'Sistem / Guest' }}</div>
                <div class="font-mono text-[#6B7280] text-xs">{{ $log->user->email ?? '-' }}</div>
            </td>
            <td>
                <span class="method-badge method-{{ strtolower($log->method) }}">
                    {{ $log->method }}
                </span>
            </td>
            <td>
                <code class="font-mono text-[#6B7280] text-xs bg-[#F7F5F2] px-2 py-1 rounded">
                    {{ $log->url }}
                </code>
            </td>
            <td>
                <span class="text-[#18120F] text-sm">{{ $log->aksi }}</span>
            </td>
            <td>
                @if($log->status_code)
                    <span class="status-badge {{ $log->is_error ? 'status-error' : 'status-ok' }}">
                        @if($log->is_error)
                            <span class="status-error-dot"></span>
                        @endif
                        {{ $log->status_code }}
                    </span>
                @else
                    <span class="text-[#948E86] text-xs">-</span>
                @endif
            </td>
            <td>
                <span class="font-mono text-[#6B7280] text-xs">{{ $log->ip_address ?? '-' }}</span>
            </td>
            <td>
                <div class="text-sm">{{ $log->created_at->format('d M Y') }}</div>
                <div class="font-mono text-[#6B7280] text-xs">{{ $log->created_at->format('H:i:s') }}</div>
            </td>
            <td class="text-center">
                <div class="flex justify-center items-center gap-1.5">
                    @if($log->is_error)
                        <a href="{{ route('logs.show', $log->id) }}" class="btn btn-small btn-detail">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                            </svg>
                        </a>
                    @endif
                    <form action="{{ route('logs.destroy', $log->id) }}" method="POST" onsubmit="return confirm('Hapus log ini?');" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-small btn-delete" style="background-color: #FEF2F2; color: #7F1D1D; border-color: #FECACA;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
    @endforeach 
    </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $logs->appends(request()->query())->links() }}
            </div>

        </div>
    </div>
</x-app-layout>