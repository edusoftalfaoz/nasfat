<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryItemResource\Pages;
use App\Models\GalleryItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class GalleryItemResource extends Resource
{
    protected static ?string $model = GalleryItem::class;

    protected static ?string $navigationIcon  = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Website';
    protected static ?string $navigationLabel = 'Photo gallery';
    protected static ?int    $navigationSort  = 5;
    protected static ?string $modelLabel      = 'photo';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\FileUpload::make('image')->image()->imageEditor()->required()
                ->directory('website/gallery')->visibility('public')->maxSize(5120)
                ->imageResizeMode('contain')->imageResizeTargetWidth('1600')->imageResizeUpscale(false)
                ->columnSpanFull(),
            Forms\Components\TextInput::make('title')->label('Caption')->maxLength(100)
                ->helperText('Optional. Shown on the photo and read aloud by screen readers.'),
            Forms\Components\Toggle::make('is_active')->label('Show on website')->default(true),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label('Photo')->height(64)->getStateUsing(fn ($record) => site_image($record->image)),
                Tables\Columns\TextColumn::make('title')->label('Caption')->searchable()->placeholder('No caption'),
                Tables\Columns\ToggleColumn::make('is_active')->label('Visible'),
            ])
            ->reorderable('sort_order')
            ->defaultSort('sort_order')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]),
            ])
            ->emptyStateHeading('No photos yet')
            ->emptyStateDescription('Upload photos of classrooms, events and school life. The first photo is shown largest.');
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageGalleryItems::route('/')];
    }
}
