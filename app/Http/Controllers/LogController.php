<?php

namespace App\Http\Controllers;

use App\Models\SystemLog;
use App\Models\User;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Display a listing of all system logs
     */
    public function index(Request $request)
    {
        $query = SystemLog::with('user');

        // Filter berdasarkan user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filter berdasarkan method HTTP
        if ($request->filled('method')) {
            $query->where('method', $request->method);
        }

        // Filter berdasarkan aksi
        if ($request->filled('aksi')) {
            $query->where('aksi', 'like', '%' . $request->aksi . '%');
        }

        // Filter berdasarkan URL
        if ($request->filled('url')) {
            $query->where('url', 'like', '%' . $request->url . '%');
        }

        // ===== FILTER BERDASARKAN STATUS / ERROR =====
        // Value bisa berupa: "errors" (semua error 4xx/5xx) atau kode spesifik (404, 405, 422, 500, dll)
        if ($request->filled('status')) {
            if ($request->status === 'errors') {
                $query->where('is_error', true);
            } else {
                $query->where('status_code', $request->status);
            }
        }

        // Filter berdasarkan range tanggal
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Sort dan pagination
        $logs = $query->orderBy('created_at', 'desc')->paginate(25);
        $users = User::all();

        // Hitung total error untuk statistik cepat di halaman index
        $totalErrors = SystemLog::where('is_error', true)->count();

        // Pastikan semua key filter selalu ada (default null) agar view tidak error
        // saat key belum pernah diisi (contoh: kunjungan pertama tanpa query string)
        $filters = array_merge(
            [
                'user_id' => null,
                'method' => null,
                'aksi' => null,
                'url' => null,
                'status' => null,
                'date_from' => null,
                'date_to' => null,
            ],
            $request->only(['user_id', 'method', 'aksi', 'url', 'status', 'date_from', 'date_to'])
        );

        return view('logs.index', [
            'logs' => $logs,
            'users' => $users,
            'filters' => $filters,
            'totalErrors' => $totalErrors,
        ]);
    }

    /**
     * Tampilkan detail satu log, termasuk raw exception data dari Laravel
     * (exception class, message, dan stack trace) supaya developer bisa
     * mendiagnosis error dengan tepat.
     */
    public function show($id)
    {
        $log = SystemLog::with('user')->findOrFail($id);

        return view('logs.show', [
            'log' => $log,
        ]);
    }

    /**
     * Hapus log berdasarkan ID
     */
    public function destroy($id)
    {
        $log = SystemLog::find($id);

        if (!$log) {
            return redirect()->route('logs.index')->with('error', 'Log tidak ditemukan');
        }

        $log->delete();

        return redirect()->route('logs.index')->with('success', 'Log berhasil dihapus');
    }

    /**
     * Hapus semua logs yang lebih lama dari X hari
     */
    public function clearOldLogs(Request $request)
    {
        $days = $request->input('days', 30); // Default 30 hari

        $deletedCount = SystemLog::where('created_at', '<', now()->subDays($days))
            ->delete();

        return redirect()->route('logs.index')
            ->with('success', "Log yang lebih lama dari {$days} hari berhasil dihapus. Total: {$deletedCount} records");
    }

    /**
     * Export logs ke CSV
     */
    public function export(Request $request)
    {
        $query = SystemLog::with('user');

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->filled('method')) {
            $query->where('method', $request->method);
        }
        if ($request->filled('aksi')) {
            $query->where('aksi', 'like', '%' . $request->aksi . '%');
        }
        if ($request->filled('status')) {
            if ($request->status === 'errors') {
                $query->where('is_error', true);
            } else {
                $query->where('status_code', $request->status);
            }
        }
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $logs = $query->orderBy('created_at', 'desc')->get();

        // Generate CSV - sertakan kolom error tracking
        $csv = "User ID,Username,Method,URL,IP Address,Aksi,Status Code,Exception Class,Exception Message,Waktu\n";

        foreach ($logs as $log) {
            $csv .= sprintf(
                "\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\",\"%s\"\n",
                $log->user_id,
                $log->user->name ?? '-',
                $log->method,
                $log->url,
                $log->ip_address,
                $log->aksi,
                $log->status_code ?? '-',
                $log->exception_class ?? '-',
                str_replace('"', "'", $log->exception_message ?? '-'),
                $log->created_at->format('Y-m-d H:i:s')
            );
        }

        return response($csv, 200, [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="system-logs-' . now()->format('Y-m-d-H-i-s') . '.csv"',
        ]);
    }
}