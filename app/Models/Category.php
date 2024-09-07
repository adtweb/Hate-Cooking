<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaravelJsonApi\Eloquent\Fields\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Category extends Model
{
    use HasFactory;
    use HasUuids;
    use Notifiable;

    protected $fillable = ['value', 'slug'];

    /**
     * Get the recipes for the categories.
     */
    public function recipes(): HasMany
    {
        return $this->HasMany(Recipe::class);
    }
}
