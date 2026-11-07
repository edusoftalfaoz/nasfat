<?php

namespace App\Filament\Resources\FeatureResource\Pages;

use App\Filament\Resources\FeatureResource;
use App\Models\Feature;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFeatures extends ManageRecords
{
    protected static string $resource = FeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Add reason')
                ->mutateFormDataUsing(function (array $data): array {
                    $data['sort_order'] = ((int) Feature::max('sort_order')) + 1;
                    return $data;
                }),
        ];
    }
}
