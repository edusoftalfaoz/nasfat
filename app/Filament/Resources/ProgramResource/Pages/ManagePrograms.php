<?php

namespace App\Filament\Resources\ProgramResource\Pages;

use App\Filament\Resources\ProgramResource;
use App\Models\Program;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePrograms extends ManageRecords
{
    protected static string $resource = ProgramResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Add program')
                ->mutateFormDataUsing(function (array $data): array {
                    $data['sort_order'] = ((int) Program::max('sort_order')) + 1;
                    return $data;
                }),
        ];
    }
}
