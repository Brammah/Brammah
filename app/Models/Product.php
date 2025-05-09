<?php
namespace App\Models;

use App\Http\Traits\InsertStatus;
use App\Http\Traits\RecordAction;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Product extends Model
{
    use HasFactory;
    use InsertStatus;
    use RecordAction;
    use Sluggable;
    use HasRecursiveRelationships;

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function getBrandNameAttribute()
    {
        return $this->brand ? $this->brand->name : 'None';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'    => ['brand_name', 'name'],
                'separator' => '-',
                'onUpdate'  => true,
            ],
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function purchaseOrderProducts()
    {
        return $this->hasMany(PurchaseOrderProduct::class);
    }

    public function unitOfMeasure()
    {
        return $this->belongsTo(UnitOfMeasure::class);
    }

    public function storeInventories()
    {
        return $this->hasMany(StoreInventory::class);
    }

    public function materialRequestProducts()
    {
        return $this->hasMany(MaterialRequestProduct::class);
    }

    // public function vehicleInspectionProducts()
    // {
    //     return $this->hasMany(VehicleInspectionProduct::class);
    // }

    protected function quantity(): Attribute
    {
        return Attribute::make(
            get: fn() => StoreInventory::where('product_id', $this->id)->sum('quantity'),
        );
    }
}
