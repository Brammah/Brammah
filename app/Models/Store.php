<?php
namespace App\Models;

use App\Http\Traits\InsertStatus;
use App\Http\Traits\RecordAction;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Znck\Eloquent\Traits\BelongsToThrough;

class Store extends Model
{
    use HasFactory;
    use Sluggable;
    use InsertStatus;
    use BelongsToThrough;
    use RecordAction;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'   => 'name',
                'onUpdate' => true,
            ],
        ];
    }

    public function scopeDecentralized($query)
    {
        return $query->where('is_main', 0);
    }

    public function scopeMain($query)
    {
        return $query->where('is_main', 1);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function storeTransfers()
    {
        return $this->hasMany(StoreTransfer::class);
    }

    public function storeInventories()
    {
        return $this->hasMany(StoreInventory::class);
    }

    public function materialRequestProducts(): BelongsToMany
    {
        return $this->belongsToMany(MaterialRequestProduct::class, 'request_product_store')
            ->withPivot('deducted_quantity')
            ->withTimestamps();
    }

    public function materialReissues(): BelongsToMany
    {
        return $this->belongsToMany(MaterialReissue::class, 'request_product_store')
            ->withPivot('deducted_quantity')
            ->withTimestamps();
    }
}
