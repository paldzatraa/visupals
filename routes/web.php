<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;

// Rute untuk halaman utama
Route::get('/', [FrontController::class, 'index'])->name('home');

// Rute untuk melihat detail portofolio (berdasarkan slug/judul)
Route::get('/portfolio/{slug}', [FrontController::class, 'show'])->name('portfolio.show');

// Route rahasia untuk menjalankan migrasi dan storage link
Route::get('/init-project', function () {
    try {
        // Menjalankan migrasi database
        Artisan::call('migrate', ['--force' => true]);
        $migrateOutput = Artisan::output();

        // Menjalankan storage link
        Artisan::call('storage:link');
        $storageOutput = Artisan::output();

        return response()->json([
            'status' => 'success',
            'migration' => $migrateOutput,
            'storage' => $storageOutput,
            'message' => 'visupals. is now ready!'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
});