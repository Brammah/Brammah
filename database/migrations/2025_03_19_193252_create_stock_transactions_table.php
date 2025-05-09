<?php

use App\Models\Branch;
use App\Models\Product;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Branch::class)->nullable()->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->decimal('current_cost_price', 15, 2)->default(0);
            $table->decimal('current_quantity', 15, 2)->default(0);
            $table->decimal('current_selling_price', 15, 2)->default(0);
            $table->decimal('new_cost_price', 15, 2)->default(0);
            $table->decimal('new_quantity', 15, 2)->default(0);
            $table->decimal('new_selling_price', 15, 2)->default(0);
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
        Schema::dropIfExists('stock_transactions');
    }
};