<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Qualities extends Model
{
    protected $fillable = ['name'];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class);
    }
}
