<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('system_logs', function (Blueprint $table) {
            // Status code response (200, 404, 405, 422, 500, dll)
            $table->unsignedSmallInteger('status_code')->nullable()->after('aksi');

            // Nama class exception Laravel, contoh:
            // Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException
            // Illuminate\Validation\ValidationException
            $table->string('exception_class')->nullable()->after('status_code');

            // Pesan mentah dari exception (getMessage())
            $table->text('exception_message')->nullable()->after('exception_class');

            // Stack trace lengkap (getTraceAsString()) - untuk debugging developer
            $table->longText('exception_trace')->nullable()->after('exception_message');

            // Flag cepat untuk filter "error saja" tanpa perlu hitung status_code >= 400 tiap query
            $table->boolean('is_error')->default(false)->after('exception_trace');

            // Index untuk filter cepat
            $table->index('status_code');
            $table->index('is_error');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('system_logs', function (Blueprint $table) {
            $table->dropIndex(['status_code']);
            $table->dropIndex(['is_error']);
            $table->dropColumn([
                'status_code',
                'exception_class',
                'exception_message',
                'exception_trace',
                'is_error',
            ]);
        });
    }
};