<?php

namespace App\Models;

use App\Http\Services\AccountService;
use App\Http\Traits\RecordAction;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Account extends Model
{
    use Sluggable;
    use HasRecursiveRelationships;
    use RecordAction;

    public function receipts(): HasMany
    {
        return $this->hasMany(Receipt::class);
    }

    public function accountCategory(): BelongsTo
    {
        return $this->belongsTo(AccountCategory::class);
    }

    public function bankAccounts(): HasMany
    {
        return $this->hasMany(BankAccount::class);
    }

    // public function accountRelationships()
    // {
    //     return $this->hasMany(AccountRelationship::class);
    // }

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => strtoupper($value),
        );
    }

    protected function balance(): Attribute
    {
        return Attribute::make(
            get: fn() => AccountService::getAccountBalance($this),
        );
    }

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

    public function scopeTransacting($query)
    {
        return $query->where('transacting_status', true);
    }

    public function statusBadge()
    {
        return $this->status == 1 ? '<span class="badge rounded-pill badge-success">Active</span>' : '<span class="badge rounded-pill badge-danger">Inactive</span>';
    }

    public function transactingStatusBadge()
    {
        return $this->transacting_status == 1 ? '<span class="badge rounded-pill badge-success">Yes</span>' : '<span class="badge rounded-pill badge-danger">No</span>';
    }
}
