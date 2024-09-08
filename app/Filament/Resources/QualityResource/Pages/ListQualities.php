<?php

namespace App\Filament\Resources\QualityResource\Pages;

use App\Filament\Resources\QualityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQualities extends ListRecords
{
    protected static string $resource = QualityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
