<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Notifications\Notifiable;

class Role extends Model
{
    use HasFactory;
    use HasUuids;
    use Notifiable;

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
