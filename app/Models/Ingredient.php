<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Ingredient extends Model
{
    use HasFactory;
    use HasUuids;
    use Notifiable;

    public function recipes(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }
}
