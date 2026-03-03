<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Lengkap'),

                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->label('Alamat Email'),

                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->label('Password'),

                FileUpload::make('profile_photo')
                    ->image()
                    ->imageEditor() // Memungkinkan kamu crop foto agar pas di section About Me
                    ->directory('profile-photos')
                    ->visibility('public') // Wajib agar tidak 404 di Railway
                    ->avatar() // Memberikan preview lingkaran yang rapi di admin
                    ->label('Foto Profil (About Me)'),
            ]);
    }
}