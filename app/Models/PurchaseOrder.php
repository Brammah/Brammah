<?php
namespace App\Models;

use App\Http\Traits\InsertStatus;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PurchaseOrder extends Model
{
    use HasFactory;
    use InsertStatus;
    use Sluggable;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'   => 'lpo_number',
                'onUpdate' => true,
            ],
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchaseOrderProducts(): HasMany
    {
        return $this->hasMany(PurchaseOrderProduct::class);
    }

    public function productRestocks(): HasMany
    {
        return $this->hasMany(ProductRestock::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', 1);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = Auth::id() ?? 1;

            if (is_null($model->branch_id)) {
                $model->branch_id = Auth::user()->branch_id ?? null;
            }

            $qrCodeSvg  = QrCode::format('svg')->size(200)->style('dot')->eye('circle')->color(5, 63, 59)->margin(1)->generate(url('/purchase-order/' . $model->slug . '/print'));
            $qrCodePath = 'qrcodes/' . $model->slug . '.svg';

            Storage::disk('public')->put($qrCodePath, $qrCodeSvg);
            $model->qr_code = $qrCodePath;
        });

        self::updating(function ($model): void {
            $model->updated_by = Auth::id();

            if (is_null($model->branch_id)) {
                $model->branch_id = Auth::user()->branch_id ?? null;
            }

            if ($model->isDirty('slug')) {
                Storage::disk('public')->delete($model->qr_code);

                $qrCodeSvg  = QrCode::format('svg')->size(200)->style('dot')->eye('circle')->color(5, 63, 59)->margin(1)->generate(url('/purchase-order/' . $model->slug . '/print'));
                $qrCodePath = 'qrcodes/' . $model->slug . '.svg';

                Storage::disk('public')->put($qrCodePath, $qrCodeSvg);
                $model->qr_code = $qrCodePath;
            }
        });
    }
}
