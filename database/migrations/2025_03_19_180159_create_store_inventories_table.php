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
        Schema::create('store_inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Branch::class)->nullable()->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(Store::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->decimal('quantity', 15, 2);
            $table->timestamps();
            $table->unique(['store_id', 'product_id', 'branch_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_inventories');
    }
};
