<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price_mmk',
        'badge',
        'size_options',
        'image_path',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'price_mmk' => 'integer',
            'size_options' => 'array',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @param  Builder<Product>  $query
     * @return Builder<Product>
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function imageUrl(): ?string
    {
        if (! $this->image_path) {
            return null;
        }

        if (str_starts_with($this->image_path, 'http://') || str_starts_with($this->image_path, 'https://')) {
            return $this->image_path;
        }

        if (str_starts_with($this->image_path, 'uploads/')) {
            return '/'.$this->image_path;
        }

        return '/storage/'.$this->image_path;
    }

    /** @return list<string> */
    public function sizesForSelect(): array
    {
        $opts = $this->size_options;
        if (is_array($opts)) {
            if ($opts === []) {
                return [];
            }

            return array_values(array_filter(array_map('strval', $opts)));
        }

        return ['39', '40', '41', '42'];
    }
}
