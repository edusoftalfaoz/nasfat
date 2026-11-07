<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramResource\Pages;
use App\Models\Program;
use App\Support\SiteIcons;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProgramResource extends Resource
{
    protected static ?string $model = Program::class;

    protected static ?string $navigationIcon  = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Website';
    protected static ?string $navigationLabel = 'Programs';
    protected static ?int    $navigationSort  = 2;
    protected static ?string $modelLabel      = 'program';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')->required()->maxLength(80),
            Forms\Components\Select::make('icon')->options(SiteIcons::options())->default('book')->required()->native(false),
            Forms\Components\Textarea::make('description')->required()->rows(3)->maxLength(240)->columnSpanFull()
                ->helperText('One or two sentences. Up to 240 characters.'),
            Forms\Components\Toggle::make('is_active')->label('Show on website')->default(true),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->weight('bold'),
                Tables\Columns\TextColumn::make('description')->limit(70)->wrap(),
                Tables\Columns\TextColumn::make('icon')->badge()->color('gray')->formatStateUsing(fn ($state) => SiteIcons::options()[$state] ?? $state),
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
            ->emptyStateHeading('No programs yet')
            ->emptyStateDescription('Add the subjects and activities you want parents to see.');
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManagePrograms::route('/')];
    }
}
