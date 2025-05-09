<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Traits\InsertStatus;
use App\Http\Traits\RecordAction;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, Sluggable, InsertStatus, RecordAction;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'   => 'username',
                'onUpdate' => true,
            ],
        ];
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn() => "{$this->first_name} {$this->last_name}",
        );
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function allowedIps()
    {
        return $this->hasMany(AllowedIp::class);
    }

    public function userLogins(): HasMany
    {
        return $this->hasMany(UserLogin::class)->latest();
    }

    // public function customers(): HasMany
    // {
    //     return $this->hasMany(Customer::class, 'account_manager_id');
    // }

    // public function quotations(): HasMany
    // {
    //     return $this->hasMany(Quotation::class, 'created_by');
    // }
}
