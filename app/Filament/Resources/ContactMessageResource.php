<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationIcon  = 'heroicon-o-inbox';
    protected static ?string $navigationGroup = 'Website';
    protected static ?string $navigationLabel = 'Messages';
    protected static ?int    $navigationSort  = 7;
    protected static ?string $modelLabel      = 'message';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getNavigationBadge(): ?string
    {
        try {
            $count = ContactMessage::unread()->count();
        } catch (\Throwable $e) {
            return null;
        }

        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('is_read')->label('')
                    ->getStateUsing(fn (ContactMessage $r) => $r->read_at !== null)
                    ->icon(fn (bool $state) => $state ? 'heroicon-o-envelope-open' : 'heroicon-s-envelope')
                    ->color(fn (bool $state) => $state ? 'gray' : 'primary'),
                Tables\Columns\TextColumn::make('name')->searchable()
                    ->weight(fn (ContactMessage $r) => $r->read_at ? 'normal' : 'bold'),
                Tables\Columns\TextColumn::make('subject')->searchable()->limit(50)
                    ->weight(fn (ContactMessage $r) => $r->read_at ? 'normal' : 'bold'),
                Tables\Columns\TextColumn::make('email')->searchable()->copyable(),
                Tables\Columns\TextColumn::make('phone')->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')->label('Received')->since()->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('unread')->label('Status')
                    ->placeholder('All messages')->trueLabel('Unread')->falseLabel('Read')
                    ->queries(
                        true: fn ($query) => $query->whereNull('read_at'),
                        false: fn ($query) => $query->whereNotNull('read_at'),
                        blank: fn ($query) => $query,
                    ),
            ])
            ->actions([
                Tables\Actions\Action::make('open')->label('Read')->icon('heroicon-o-envelope-open')
                    ->slideOver()
                    ->modalHeading(fn (ContactMessage $record) => $record->subject)
                    ->modalContent(function (ContactMessage $record) {
                        // Opening a message marks it as read.
                        if (! $record->read_at) {
                            $record->update(['read_at' => now()]);
                        }

                        return view('filament.website.contact-message', ['record' => $record]);
                    })
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Close'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('markRead')->label('Mark as read')->icon('heroicon-o-check')
                        ->action(fn (Collection $records) => $records->each->update(['read_at' => now()]))
                        ->deselectRecordsAfterCompletion(),
                    Tables\Actions\BulkAction::make('markUnread')->label('Mark as unread')->icon('heroicon-o-envelope')
                        ->action(fn (Collection $records) => $records->each->update(['read_at' => null]))
                        ->deselectRecordsAfterCompletion(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('No messages yet')
            ->emptyStateDescription('Messages sent from the contact form on your website will appear here.');
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageContactMessages::route('/')];
    }
}
