<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use App\Support\PublicImageStorage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /** @return HasMany<ProductImage> */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    /**
     * Gallery order for product detail (swipe order): by sort_order ascending.
     *
     * @return list<string>
     */
    public function galleryUrls(): array
    {
        $this->loadMissing('images');

        $fromGallery = $this->images
            ->sortBy('sort_order')
            ->values()
            ->map(fn (ProductImage $img) => $img->url())
            ->filter()
            ->all();
        if ($fromGallery !== []) {
            return $fromGallery;
        }

        $legacy = PublicImageStorage::publicUrl($this->image_path);

        return $legacy ? [$legacy] : [];
    }

    /**
     * @param  Builder<Product>  $query
     * @return Builder<Product>
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /** Main image for listings, cart, grids — the image marked primary, else first by sort order. */
    public function imageUrl(): ?string
    {
        $this->loadMissing('images');

        $primary = $this->images->firstWhere('is_primary', true);
        if ($primary) {
            return $primary->url();
        }

        $first = $this->images->sortBy('sort_order')->first();
        if ($first) {
            return $first->url();
        }

        return PublicImageStorage::publicUrl($this->image_path);
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
