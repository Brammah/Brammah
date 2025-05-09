<?php
namespace App\Models;

use App\Http\Traits\InsertStatus;
use App\Http\Traits\RecordAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class SupplierPayment extends Model
{
    use RecordAction;
    use InsertStatus;

    public function proformaInvoices(): BelongsToMany
    {
        return $this->belongsToMany(ProformaInvoice::class, 'supplier_payment_details')
            ->withPivot('allocated_amount')
            ->withTimestamps();
    }
    public function restockItems(): HasManyThrough
    {
        return $this->hasManyThrough(
            RestockProduct::class,        // Final Target: Restocked Items
            SupplierPaymentDetail::class, // Pivot Table
            'supplier_payment_id',        // FK in supplier_payment_details (points to supplier_payments)
            'product_restock_id',         // FK in restock_items (points to item_restocks)
            'id',                         // Local Key in supplier_payments
            'id'                          // Local Key in supplier_payment_details
        );
    }

    public function supplierPaymentDetails(): HasMany
    {
        return $this->hasMany(SupplierPaymentDetail::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
