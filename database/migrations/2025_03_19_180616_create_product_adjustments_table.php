<?php

use App\Models\Branch;
use App\Models\Product;
use App\Models\Store;
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
        Schema::create('product_adjustments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Branch::class)->nullable()->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(Store::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->date('adjustment_date')->index();
            $table->decimal('current_quantity', 15, 2);
            $table->decimal('adjusted_quantity', 15, 2);
            $table->decimal('current_cost_price', 15, 2);
            $table->decimal('adjusted_cost_price', 15, 2);
            $table->decimal('new_cost_price', 15, 2);
            $table->text('remarks');
            $table->tinyInteger('is_approved')->default(0);
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
        Schema::dropIfExists('product_adjustments');
    }
};