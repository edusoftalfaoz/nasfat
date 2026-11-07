<?php

namespace App\Filament\Resources\GalleryItemResource\Pages;

use App\Filament\Resources\GalleryItemResource;
use App\Models\GalleryItem;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageGalleryItems extends ManageRecords
{
    protected static string $resource = GalleryItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Add photo')
                ->mutateFormDataUsing(function (array $data): array {
                    $data['sort_order'] = ((int) GalleryItem::max('sort_order')) + 1;
                    return $data;
                }),
        ];
    }
}
