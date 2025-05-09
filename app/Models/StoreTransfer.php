<?php
namespace App\Models;

use App\Http\Traits\InsertStatus;
use App\Http\Traits\RecordAction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoreTransfer extends Model
{
    use HasFactory;
    use InsertStatus;
    use RecordAction;

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function issuingStore(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'issuing_store_id');
    }

    public function receivingStore(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'receiving_store_id');
    }
}
