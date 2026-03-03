<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;

// Rute untuk halaman utama
Route::get('/', [FrontController::class, 'index'])->name('home');

// Rute untuk melihat detail portofolio (berdasarkan slug/judul)
Route::get('/portfolio/{slug}', [FrontController::class, 'show'])->name('portfolio.show');

Route::get('/create-admin-secure', function () {
    // Cek apakah user sudah ada agar tidak duplikat
    $email = 'admin@visupals.my.id';
    
    if (User::where('email', $email)->exists()) {
        return "User admin sudah ada!";
    }

    User::create([
        'name' => 'Naufal Dzaky S',
        'email' => $email,
        'password' => Hash::make('imcrook122'),
    ]);

    return "Admin berhasil dibuat. Silakan login ke /admin";
});

Route::get('/rebuild-bridge-final', function () {
    $publicPath = public_path('storage');

    // 1. Amputasi folder fisik storage
    if (file_exists($publicPath)) {
        // Jika folder, gunakan perintah sistem untuk menghapus rekursif
        system('rm -rf ' . escapeshellarg($publicPath));
    }

    // 2. Bangun ulang jembatan symlink
    Artisan::call('storage:link');

    // 3. Cek apakah sekarang sudah jadi link
    $isLinkNow = is_link($publicPath);

    return response()->json([
        'status' => $isLinkNow ? 'Success' : 'Failed',
        'message' => $isLinkNow ? 'Jembatan sudah terpasang!' : 'Gagal membangun jembatan.',
        'is_link' => $isLinkNow
    ]);
});

Route::get('/debug-storage', function () {
    $results = [
        'public_storage_exists' => file_exists(public_path('storage')),
        'is_link' => is_link(public_path('storage')),
        'storage_path_writable' => is_writable(storage_path('app/public')),
        'contents_of_public' => scandir(public_path()),
        'contents_of_storage' => file_exists(storage_path('app/public')) ? scandir(storage_path('app/public')) : 'folder not found',
    ];
    return response()->json($results);
});