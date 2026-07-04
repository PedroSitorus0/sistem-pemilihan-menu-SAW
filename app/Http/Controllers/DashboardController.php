<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    return match(auth()->user()->role) {
        'admin' => view('dashboard.admin'),
        'dev' => view('dashboard.dev'),
        'dosen', 'mahasiswa' => view('dashboard.penilai'),
        default => abort(403),
    };
}
}
