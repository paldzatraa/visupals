<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Temporary File Uploads
    |--------------------------------------------------------------------------
    |
    | Livewire handles file uploads by storing them in a temporary directory
    | before they are stored permanently. 
    |
    */

    'temporary_file_upload' => [
        /**
         * MASALAH: Upload Gagal.
         * SOLUSI: Ubah disk ke 'public' agar masuk ke dalam Railway Volume kamu.
         * Default-nya adalah 'local' yang tidak memiliki izin tulis di Railway.
         */
        'disk' => 'public',        
        'middleware' => 'throttle:60,1',
        'preview_mimes' => [
            'png', 'gif', 'bmp', 'svg', 'wav', 'mp4',
            'mov', 'avi', 'wmv', 'mp3', 'm4a',
            'jpg', 'jpeg', 'mpga', 'webp',
        ],
        'max_upload_time' => 5, // Menit
    ],

];