<?php

use App\Models\Branch;
use App\Models\Product;
use App\Models\ProductRestock;
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
        Schema::create('restock_products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Branch::class)->nullable()->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(ProductRestock::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->decimal('buying_price', 15, 2)->default(0);
            $table->decimal('ordered_quantity', 15, 2)->default(0);
            $table->decimal('restocked_quantity', 15, 2)->default(0);
            $table->decimal('vat_amount', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2)->default(0);
            $table->tinyInteger('is_approved')->default(0);
            $table->tinyInteger('is_paid')->default(0);
            $table->enum('status', ['accepted', 'rejected', 'withheld', 'returned', 'unfulfilled'])->default('unfulfilled');
            $table->foreignId('approved_by')->nullable()->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('rejected_by')->nullable()->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('created_by')->nullable()->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('updated_by')->nullable()->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restock_products');
    }
};
