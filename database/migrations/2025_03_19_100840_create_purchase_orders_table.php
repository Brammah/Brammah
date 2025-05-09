<?php

use App\Models\Branch;
use App\Models\Currency;
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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Branch::class)->nullable()->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(Supplier::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(Currency::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->string('lpo_number')->index();
            $table->string('supplier_document_number')->nullable()->index();
            $table->text('remarks')->nullable();
            $table->string('slug')->unique()->index();
            $table->string('qr_code')->unique()->index();
            $table->decimal('cost', 15, 2)->default(0);
            $table->decimal('outstanding_balance', 15, 2)->default(0);
            $table->date('lpo_date')->index();
            $table->date('lpo_due_date')->nullable()->index();
            $table->integer('overdue_days')->nullable()->index();
            $table->integer('validity')->default(0)->index();
            $table->integer('payment_duration')->default(0)->index();
            $table->tinyInteger('is_delivered')->default(0);
            $table->tinyInteger('is_approved')->default(0);
            $table->tinyInteger('is_paid')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->foreignId('approved_by')->nullable()->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('rejected_by')->nullable()->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('created_by')->nullable()->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('updated_by')->nullable()->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();
            $table->unique(['branch_id', 'lpo_number', 'supplier_document_number'], 'unique_details_per_branch');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
