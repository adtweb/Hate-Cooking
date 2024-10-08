<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class Recipe extends Model
{
    use HasFactory;
    use HasUuids;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'value',
        'slug',
        'user_id',
        'category_id',
        'quality_id',
        'photo_url',
        'description',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the steps for the recipe.
     */
    public function steps(): HasMany
    {
        return $this->hasMany(Step::class);
    }

    /**
     * Get the categories for the recipe.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Get the qualities for the recipe.
     */
    public function qualities(): BelongsToMany
    {
        return $this->belongsToMany(Quality::class);
    }

    /**
     * Get the comments for the recipe.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredient::class);
    }

    public function html(): Attribute
    {
        return Attribute::get(fn () => str($this->description)->markdown());
    }

    public static function getUniqSlug(string $string): string
    {
        $slug = Str::slug($string, '_');
        $num = 0;

        while (!empty(self::where('slug', $slug)->first())) {
            if (preg_match("/-/", $slug)) {
                list($slug, $num) = preg_split("/-/", $slug);
            }

            $slug = $slug . '-' . ++$num;
        }

        return $slug;
    }
}
