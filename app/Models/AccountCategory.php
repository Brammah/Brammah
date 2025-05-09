<?php

namespace App\Models;

use App\Http\Traits\RecordAction;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class AccountCategory extends Model
{
    use Sluggable;
    use RecordAction;
    use HasFactory;
    use HasRecursiveRelationships;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {

        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true,
            ],
        ];
    }

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }
}