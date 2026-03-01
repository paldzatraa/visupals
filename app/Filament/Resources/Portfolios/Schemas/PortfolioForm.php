<?php

namespace App\Filament\Resources\Portfolios\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Support\Str;

class PortfolioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            
            // Bagian Detail Informasi Portofolio
            Section::make('Informasi Utama')->schema([
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required()
                    ->label('Kategori Karya'),
                    
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null)
                    ->label('Judul Portofolio'),
                    
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                    
                TextInput::make('client_name')
                    ->maxLength(255)
                    ->label('Nama Klien (Opsional)'),
                    
                DatePicker::make('date_taken')
                    ->label('Tanggal Proyek (Opsional)'),
                    
                Textarea::make('description')
                    ->columnSpanFull()
                    ->label('Deskripsi Karya'),
            ])->columns(2),

            // Bagian Upload Media (Foto/Video)
            Section::make('Galeri Media')->schema([
                Repeater::make('media')
                    ->relationship()
                    ->schema([
                        Select::make('type')
                            ->options([
                                'photo' => 'Upload Foto',
                                'video' => 'Link Video (YouTube/Vimeo)',
                            ])
                            ->required()
                            ->live()
                            ->label('Tipe Media'),
                            
                        FileUpload::make('file_path')
                            ->image()
                            ->imageEditor()
                            ->directory('portfolio-media')
                            ->visible(fn (Get $get) => $get('type') === 'photo')
                            ->label('Pilih Foto'),
                            
                        TextInput::make('video_url')
                            ->url()
                            ->visible(fn (Get $get) => $get('type') === 'video')
                            ->label('Tautan Video'),
                            
                        Toggle::make('is_featured')
                            ->label('Jadikan Thumbnail Depan')
                            ->default(false),
                    ])
                    ->columns(2)
                    ->defaultItems(1)
            ]),
            
        ]);
    }
}