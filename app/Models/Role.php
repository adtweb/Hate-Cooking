<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Notifications\Notifiable;

class Role extends Model
{
    use HasFactory;
    use HasUuids;
    use Notifiable;

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public static function administrator()
    {
        return self::first()->id;
    }

    public static function moderator()
    {
        return self::skip(1)->first()->id;
    }

    public static function author()
    {
        return self::skip(2)->first()->id;
    }
}
