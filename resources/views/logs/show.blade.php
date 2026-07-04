<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Log') }}
        </h2>
    </x-slot>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,500&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        .font-display { font-family: 'Fraunces', serif; font-feature-settings: 'ss01' 1; }
        .font-mono { font-family: 'JetBrains Mono', monospace; }

        .detail-card {
            background: white;
            border: 1px solid #EAE6DF;
            border-radius: 0.875rem;
            padding: 1.75rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 2px rgba(24, 18, 15, 0.04);
        }

        .detail-card.error-card {
            border-color: #FECACA;
            background-color: #FFFBFB;
        }

        .detail-section-title {
            font-family: 'Fraunces', serif;
            font-size: 15px;
            font-weight: 600;
            color: #18120F;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .detail-section-title::before {
            content: '';
            width: 3px;
            height: 18px;
            background-color: #E63912;
            border-radius: 1.5px;
        }

        .error-card .detail-section-title::before {
            background-color: #DC2626;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.25rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 0.375rem;
        }

        .info-label {
            font-family: 'JetBrains Mono', monospace;
            font-size: 10px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #948E86;
            font-weight: 600;
        }

        .info-value {
            font-size: 14px;
            color: #18120F;
            font-weight: 500;
        }

        .info-value.mono {
            font-family: 'JetBrains Mono', monospace;
            font-size: 13px;
        }

        .status-badge-large {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 13px;
            font-weight: 700;
            font-family: 'JetBrains Mono', monospace;
            border: 1.5px solid;
        }

        .status-error-large {
            background-color: #FEF2F2;
            color: #991B1B;
            border-color: #FCA5A5;
        }

        .status-ok-large {
            background-color: #F0FDF4;
            color: #166534;
            border-color: #86EFAC;
        }

        .exception-class-tag {
            display: inline-block;
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            font-weight: 600;
            color: #7F1D1D;
            background-color: #FEE2E2;
            border: 1px solid #FECACA;
            padding: 0.5rem 0.875rem;
            border-radius: 0.5rem;
            word-break: break-all;
        }

        .exception-message-box {
            background-color: #18120F;
            color: #FFF7ED;
            padding: 1.25rem;
            border-radius: 0.75rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 13px;
            line-height: 1.6;
            word-break: break-word;
        }

        .trace-box {
            background-color: #0D0D0D;
            color: #D4D4D4;
            padding: 1.5rem;
            border-radius: 0.75rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 12.5px;
            line-height: 1.7;
            overflow-x: auto;
            max-height: 500px;
            overflow-y: auto;
            white-space: pre-wrap;
            word-break: break-word;
        }

        .trace-box::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .trace-box::-webkit-scrollbar-track {
            background: #1A1A1A;
        }

        .trace-box::-webkit-scrollbar-thumb {
            background: #404040;
            border-radius: 4px;
        }

        .no-error-message {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1.25rem;
            background-color: #F0FDF4;
            border: 1px solid #BBF7D0;
            border-radius: 0.75rem;
            color: #166534;
            font-weight: 500;
            font-size: 14px;
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

        .copy-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.5rem 0.875rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px;
            font-weight: 600;
            background-color: #F7F5F2;
            border: 1px solid #EAE6DF;
            border-radius: 0.5rem;
            color: #18120F;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .copy-btn:hover {
            background-color: #EAE6DF;
        }
    </style>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-8">
                <div class="flex items-center gap-2 mb-2">
                    <span class="w-1.5 h-1.5 rounded-full {{ $log->is_error ? 'bg-[#DC2626]' : 'bg-[#E63912]' }}"></span>
                    <span class="font-mono text-[11px] uppercase tracking-[0.18em] text-[#948E86]">Detail Log #{{ $log->id }}</span>
                </div>
                <h3 class="font-display text-2xl font-semibold text-[#18120F]">
                    {{ $log->is_error ? 'Detail Error' : 'Detail Aktivitas' }}
                </h3>
                <p class="text-sm text-[#948E86] mt-1">{{ $log->created_at->format('d F Y \p\u\k\u\l H:i:s') }}</p>
            </div>

            <!-- Request Info -->
            <div class="detail-card">
                <h4 class="detail-section-title">Informasi Request</h4>

                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Pengguna</span>
                        <span class="info-value">{{ $log->user->name ?? '-' }}</span>
                        <span class="info-value mono text-[#6B7280] text-xs">{{ $log->user->email ?? '-' }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Method</span>
                        <span class="info-value mono">{{ $log->method }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Status Code</span>
                        @if($log->status_code)
                            <span class="status-badge-large {{ $log->is_error ? 'status-error-large' : 'status-ok-large' }}">
                                {{ $log->status_code }} — {{ $log->status_label }}
                            </span>
                        @else
                            <span class="info-value">-</span>
                        @endif
                    </div>

                    <div class="info-item">
                        <span class="info-label">URL</span>
                        <span class="info-value mono">/{{ $log->url }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">IP Address</span>
                        <span class="info-value mono">{{ $log->ip_address ?? '-' }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Aksi</span>
                        <span class="info-value">{{ $log->aksi }}</span>
                    </div>
                </div>

                <div class="info-item mt-5">
                    <span class="info-label">User Agent</span>
                    <span class="info-value mono text-xs text-[#6B7280]">{{ $log->user_agent ?? '-' }}</span>
                </div>
            </div>

            <!-- Exception Detail -->
            @if($log->is_error && $log->exception_class)
                <div class="detail-card error-card">
                    <h4 class="detail-section-title">Detail Exception (Raw Laravel Error)</h4>

                    <div class="space-y-4">
                        <div class="info-item">
                            <span class="info-label">Exception Class</span>
                            <span class="exception-class-tag">{{ $log->exception_class }}</span>
                        </div>

                        <div class="info-item">
                            <span class="info-label">Pesan Error</span>
                            <div class="exception-message-box">{{ $log->exception_message }}</div>
                        </div>

                        @if($log->exception_trace)
                            <div class="info-item">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="info-label">Stack Trace</span>
                                    <button type="button" class="copy-btn" onclick="copyTrace()">
                                        📋 Copy Trace
                                    </button>
                                </div>
                                <div class="trace-box" id="traceBox">{{ $log->exception_trace }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="detail-card">
                    <h4 class="detail-section-title">Status</h4>
                    <div class="no-error-message">
                        ✓ Request ini berhasil diproses tanpa error.
                    </div>
                </div>
            @endif

            <div class="mt-6">
                <a href="{{ route('logs.index') }}" class="btn btn-secondary">
                    ← Kembali ke Daftar Logs
                </a>
            </div>

        </div>
    </div>

    <script>
        function copyTrace() {
            const traceText = document.getElementById('traceBox').innerText;
            navigator.clipboard.writeText(traceText).then(() => {
                const btn = document.querySelector('.copy-btn');
                const originalText = btn.innerHTML;
                btn.innerHTML = '✓ Copied!';
                setTimeout(() => {
                    btn.innerHTML = originalText;
                }, 2000);
            });
        }
    </script>
</x-app-layout>