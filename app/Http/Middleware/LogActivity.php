<?php

namespace App\Http\Middleware;

use App\Models\SystemLog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class LogActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jangan log untuk routes tertentu (optional)
        $skipPaths = [
            'debug-toolbar',
            'telescope',
            'login',
            'register',
        ];

        $skip = false;
        foreach ($skipPaths as $path) {
            if (strpos($request->path(), $path) !== false) {
                $skip = true;
                break;
            }
        }

        if ($skip) {
            return $next($request);
        }

        // ===== TANGKAP EXCEPTION MENTAH DARI LARAVEL =====
        // Karena middleware global membungkus seluruh pipeline termasuk routing,
        // exception seperti 404 (route tidak ditemukan), 405 (method tidak diizinkan/"Bad Method"),
        // 422 (validasi gagal), atau 500 (server error) akan tertangkap di sini
        // SEBELUM Laravel mengubahnya menjadi response akhir.
        try {
            $response = $next($request);
            $statusCode = $response->getStatusCode();

            $this->logRequest($request, $statusCode);

            return $response;
        } catch (Throwable $e) {
            $statusCode = $this->resolveStatusCode($e);

            $this->logRequest(
                $request,
                $statusCode,
                get_class($e),
                $e->getMessage(),
                $e->getTraceAsString()
            );

            // Rethrow supaya Laravel tetap render halaman error seperti biasa
            throw $e;
        }
    }

    /**
     * Simpan log ke database
     */
    private function logRequest(
        Request $request,
        ?int $statusCode = null,
        ?string $exceptionClass = null,
        ?string $exceptionMessage = null,
        ?string $exceptionTrace = null
    ): void {
        try {
            SystemLog::create([
                'user_id' => auth()->id(),
                'method' => $request->method(),
                'url' => $request->path(),
                'ip_address' => $request->ip(),
                'user_agent' => substr($request->userAgent() ?? '', 0, 500),
                'aksi' => $this->getActionDescription($request),
                'status_code' => $statusCode,
                'exception_class' => $exceptionClass,
                'exception_message' => $exceptionMessage,
                'exception_trace' => $exceptionTrace,
                'is_error' => $statusCode !== null && $statusCode >= 400,
            ]);
        } catch (\Exception $e) {
            // Silent fail - jangan biarin logging error mengganggu aplikasi
            \Log::error('Failed to log activity: ' . $e->getMessage());
        }
    }

    /**
     * Tentukan status code dari berbagai jenis exception Laravel/Symfony
     */
    private function resolveStatusCode(Throwable $e): int
    {
        // ValidationException (422) - tidak punya getStatusCode() bawaan
        if ($e instanceof \Illuminate\Validation\ValidationException) {
            return $e->status ?? 422;
        }

        // AuthenticationException (401)
        if ($e instanceof \Illuminate\Auth\AuthenticationException) {
            return 401;
        }

        // AuthorizationException (403)
        if ($e instanceof \Illuminate\Auth\Access\AuthorizationException) {
            return 403;
        }

        // ModelNotFoundException (404)
        if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            return 404;
        }

        // HttpException & turunannya (NotFoundHttpException 404,
        // MethodNotAllowedHttpException 405, dll) - semuanya punya getStatusCode()
        if (method_exists($e, 'getStatusCode')) {
            return $e->getStatusCode();
        }

        // Default: internal server error
        return 500;
    }

    /**
     * Generate deskripsi aksi berdasarkan request
     */
    private function getActionDescription(Request $request): string
    {
        $method = $request->method();
        $path = $request->path();
        $pathParts = explode('/', $path);

        if (str_contains($path, 'users')) {
            if ($method === 'GET' && count($pathParts) === 2) {
                return 'Melihat daftar pengguna';
            } elseif ($method === 'GET') {
                return 'Melihat detail pengguna';
            } elseif ($method === 'POST') {
                return 'Membuat pengguna baru';
            } elseif (in_array($method, ['PUT', 'PATCH'])) {
                return 'Mengupdate data pengguna';
            } elseif ($method === 'DELETE') {
                return 'Menghapus pengguna';
            }
        }

        if (str_contains($path, 'menu')) {
            if ($method === 'GET' && count($pathParts) === 2) {
                return 'Melihat daftar menu';
            } elseif ($method === 'GET') {
                return 'Melihat detail menu';
            } elseif ($method === 'POST') {
                return 'Membuat menu baru';
            } elseif (in_array($method, ['PUT', 'PATCH'])) {
                return 'Mengupdate data menu';
            } elseif ($method === 'DELETE') {
                return 'Menghapus menu';
            }
        }

        if (str_contains($path, 'kriteria')) {
            if ($method === 'GET' && count($pathParts) === 2) {
                return 'Melihat daftar kriteria';
            } elseif ($method === 'GET') {
                return 'Melihat detail kriteria';
            } elseif ($method === 'POST') {
                return 'Membuat kriteria baru';
            } elseif (in_array($method, ['PUT', 'PATCH'])) {
                return 'Mengupdate data kriteria';
            } elseif ($method === 'DELETE') {
                return 'Menghapus kriteria';
            }
        }

        if (str_contains($path, 'rekomendasi') || str_contains($path, 'dashboard')) {
            return 'Melihat rekomendasi menu / dashboard';
        }

        if (str_contains($path, 'proses')) {
            return 'Menjalankan proses SPK';
        }

        if (str_contains($path, 'penilaian')) {
            return 'Mengakses penilaian';
        }

        return "{$method} - {$path}";
    }
}