<?php
namespace App\Models;

use App\Http\Traits\InsertStatus;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Bank extends Model
{
    use HasFactory;
    use Sluggable;
    use InsertStatus;
    use HasRecursiveRelationships;

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
    // public function bankAccounts(): HasMany
    // {
    //     return $this->hasMany(BankAccount::class);
    // }
}
