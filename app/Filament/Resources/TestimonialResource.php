<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon  = 'heroicon-o-chat-bubble-bottom-center-text';
    protected static ?string $navigationGroup = 'Website';
    protected static ?string $navigationLabel = 'Testimonials';
    protected static ?int    $navigationSort  = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required()->maxLength(80),
            Forms\Components\TextInput::make('role')->maxLength(80)
                ->helperText('For example "Parent of a Primary 3 pupil".'),
            Forms\Components\Textarea::make('quote')->required()->rows(4)->maxLength(400)->columnSpanFull(),
            Forms\Components\FileUpload::make('photo')->image()->avatar()->imageEditor()->circleCropper()
                ->directory('website/testimonials')->visibility('public')->maxSize(2048)
                ->helperText('Optional. Only use a photo if the person has agreed.'),
            Forms\Components\Toggle::make('is_active')->label('Show on website')->default(true),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')->circular()->getStateUsing(fn ($record) => site_image($record->photo)),
                Tables\Columns\TextColumn::make('name')->searchable()->weight('bold'),
                Tables\Columns\TextColumn::make('role')->toggleable(),
                Tables\Columns\TextColumn::make('quote')->limit(70)->wrap(),
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
            ->emptyStateHeading('No testimonials yet')
            ->emptyStateDescription('Add kind words from parents or pupils. The section stays hidden on the website until you add one.');
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageTestimonials::route('/')];
    }
}
