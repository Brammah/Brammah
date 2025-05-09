<?php

namespace App\Models;

use App\Http\Traits\RecordAction;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentMethod extends Model
{
    use HasFactory;
    use Sluggable;
    use RecordAction;

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

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    //create non cash payments attribute
    public function scopeNonCashPaymentMethods($query)
    {
        return $query->whereNotIn('id', [1, 4, 6, 7]);
    }

    //create cash payments attribute
    public function scopeCashPaymentMethods($query)
    {
        return $query->whereIn('id', [2, 3, 9]);
    }
}