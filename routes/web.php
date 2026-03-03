<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

Route::get('/gate-storage', function () {
    return '
        <form action="/gate-storage" method="POST" enctype="multipart/form-data" style="padding:40px; font-family:sans-serif; max-width:500px; margin:auto; border:1px solid #ddd; border-radius:20px; margin-top:50px;">
            ' . csrf_field() . '
            <h2 style="color:#f97316;">Railway Volume Gateway</h2>
            <p style="font-size:12px; color:#666;">Unggah foto untuk mengganti <b>storage/app/public/profile.png</b></p>
            <input type="file" name="profile_photo" required style="margin:20px 0; display:block;">
            <button type="submit" style="padding:12px 24px; background:#f97316; color:white; border:none; border-radius:10px; cursor:pointer; font-weight:bold;">Upload Sekarang</button>
        </form>
    ';
});

Route::post('/gate-storage', function (Request $request) {
    try {
        if (!$request->hasFile('profile_photo')) {
            return "❌ Tidak ada file yang dipilih.";
        }

        $file = $request->file('profile_photo');
        
        // Pastikan folder 'public' di dalam storage ada
        if (!Storage::disk('public')->exists('')) {
            Storage::disk('public')->makeDirectory('');
        }

        // Simpan file
        $path = $file->storeAs('', 'profile.png', 'public');

        return "✅ <b>Berhasil!</b><br>File disimpan di: storage/app/public/" . $path . "<br><br><a href='/'>Kembali ke Beranda</a>";
        
    } catch (\Exception $e) {
        // Jika Error 500, pesan aslinya akan muncul di sini
        return "❌ <b>Gagal!</b><br>Pesan Error: " . $e->getMessage();
    }
});