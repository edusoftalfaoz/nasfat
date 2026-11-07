<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeatureResource\Pages;
use App\Models\Feature;
use App\Support\SiteIcons;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FeatureResource extends Resource
{
    protected static ?string $model = Feature::class;

    protected static ?string $navigationIcon  = 'heroicon-o-star';
    protected static ?string $navigationGroup = 'Website';
    protected static ?string $navigationLabel = 'Why choose us';
    protected static ?int    $navigationSort  = 3;
    protected static ?string $modelLabel      = 'reason';
    protected static ?string $pluralModelLabel = 'reasons to choose us';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')->required()->maxLength(80),
            Forms\Components\Select::make('icon')->options(SiteIcons::options())->default('sparkle')->required()->native(false),
            Forms\Components\Textarea::make('description')->required()->rows(3)->maxLength(200)->columnSpanFull(),
            Forms\Components\Toggle::make('is_active')->label('Show on website')->default(true),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->weight('bold'),
                Tables\Columns\TextColumn::make('description')->limit(70)->wrap(),
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
            ->emptyStateHeading('No reasons added yet');
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageFeatures::route('/')];
    }
}
