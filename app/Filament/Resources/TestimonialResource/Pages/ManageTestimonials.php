<?php

namespace App\Filament\Resources\TestimonialResource\Pages;

use App\Filament\Resources\TestimonialResource;
use App\Models\Testimonial;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageTestimonials extends ManageRecords
{
    protected static string $resource = TestimonialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Add testimonial')
                ->mutateFormDataUsing(function (array $data): array {
                    $data['sort_order'] = ((int) Testimonial::max('sort_order')) + 1;
                    return $data;
                }),
        ];
    }
}
