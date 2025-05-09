<?php

use App\Models\Branch;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_restocks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Branch::class)->nullable()->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(Supplier::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(PurchaseOrder::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->string('transaction_method')->nullable()->index();
            $table->string('transaction_reference')->nullable()->index();
            $table->string('restock_code')->index();
            $table->string('lpo_number')->nullable()->index();
            $table->string('supplier_document_number')->nullable()->index();
            $table->date('restock_date')->index();
            $table->decimal('restocked_amount', 15, 2)->default(0);
            $table->tinyInteger('is_approved')->default(0);
            $table->tinyInteger('is_paid')->default(0);
            $table->foreignId('approved_by')->nullable()->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('rejected_by')->nullable()->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('created_by')->nullable()->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('updated_by')->nullable()->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();
            $table->unique(['branch_id', 'restock_code', 'supplier_document_number'], 'unique_details_per_branch');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_restocks');
    }
};
