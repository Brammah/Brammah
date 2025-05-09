<?php
namespace App\Models;

use App\Http\Traits\InsertStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SupplierPaymentDetail extends Model
{
    use InsertStatus;
    // use RecordAction;

    public function supplierPayment(): BelongsTo
    {
        return $this->belongsTo(SupplierPayment::class);
    }

    public function purchaseOrder(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function proformaInvoice(): BelongsTo
    {
        return $this->belongsTo(ProformaInvoice::class);
    }

    public function productRestock(): BelongsTo
    {
        return $this->belongsTo(ProductRestock::class);
    }

    public function proformaRestock(): BelongsTo
    {
        return $this->belongsTo(ProformaRestock::class);
    }
}
