<?php

namespace App\Models;

use App\Http\Traits\RecordAction;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Category extends Model
{
    use HasFactory;
    use Sluggable;
    use RecordAction;
    use HasRecursiveRelationships;

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function getCategoryNameAttribute()
    {
        return $this->attributes['name'];
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['category_name', 'category_type'],
                'separator' => '-',
                'onUpdate' => true,
            ],
        ];
    }
}
