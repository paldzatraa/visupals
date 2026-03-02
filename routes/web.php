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

// Tambahkan di routes/web.php untuk dijalankan 1x lagi
Route::get('/fix-storage', function () {
    // Hapus link lama jika ada
    if (is_link(public_path('storage'))) {
        unlink(public_path('storage'));
    }
    
    // Buat link baru
    Artisan::call('storage:link');
    return "Storage link has been reset and recreated!";
});