<?php

use App\Models\Branch;
use App\Models\Product;
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
        Schema::create('store_transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Branch::class)->nullable()->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('issuing_store_id')->references('id')->on('stores')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('receiving_store_id')->references('id')->on('stores')->cascadeOnUpdate()->restrictOnDelete();
            $table->date('date')->index();
            $table->decimal('requested_quantity', 15, 2)->default(0);
            $table->decimal('approved_quantity', 15, 2)->default(0);
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
        Schema::dropIfExists('store_transfers');
    }
};
