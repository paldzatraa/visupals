<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
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

Route::get('/fix-link-relative', function () {
    $publicStorage = public_path('storage');
    // Hapus link lama
    if (file_exists($publicStorage) || is_link($publicStorage)) {
        system('rm -rf ' . escapeshellarg($publicStorage));
    }
    // Buat link relatif: dari public naik satu tingkat, lalu masuk ke storage/app/public
    system('ln -s ../storage/app/public ' . escapeshellarg($publicStorage));

    // Memberikan izin baca (read) dan eksekusi (untuk masuk folder) ke semua orang
    system('chmod -R 755 ' . escapeshellarg(storage_path('app/public')));
    
    return "Jembatan relatif berhasil dibuat dan Izin akses folder dibuka. Cek foto sekarang!";
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

Route::get('/trace-storage-secure', function () {
    try {
        $link = public_path('storage');
        $target = is_link($link) ? readlink($link) : 'Bukan Link';
        
        return response()->json([
            'step_1_link_info' => [
                'link_path' => $link,
                'is_link' => is_link($link),
                'link_exists' => file_exists($link),
            ],
            'step_2_target_info' => [
                'target_path' => $target,
                'target_exists' => ($target !== 'Bukan Link') ? file_exists($target) : false,
                'actual_storage_app_public' => storage_path('app/public'),
            ],
            'step_3_permissions' => [
                'is_public_writable' => is_writable(public_path()),
                'is_storage_writable' => is_writable(storage_path('app/public')),
            ],
            'step_4_env' => [
                'app_url' => config('app.url'),
                'filesystem' => config('filesystems.default'),
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ], 500);
    }
});