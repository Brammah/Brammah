<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory, Sluggable;

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

    public function counties()
    {
        return $this->hasMany(County::class);
    }

    // public function customers()
    // {
    //     return $this->hasMany(Customer::class);
    // }

    public function subcounties()
    {
        return $this->hasManyThrough(Subcounty::class, County::class);
    }
}
