<?php

use App\Models\Branch;
use App\Models\Brand;
use App\Models\Category;
use App\Models\UnitOfMeasure;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Branch::class)->nullable()->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Brand::class)->nullable()->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(Category::class)->nullable()->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(UnitOfMeasure::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->unsignedBigInteger('parent_id')->nullable()->index();
            $table->string('name')->nullable()->index();
            $table->string('slug')->unique()->index();
            $table->enum('type', ['consumable', 'sale'])->default('consumable')->index();
            $table->string('part_number')->index();
            $table->string('photo')->nullable();
            $table->decimal('latest_buying_price', 15, 2)->nullable()->default(0)->index();
            $table->decimal('cost_price', 15, 2)->nullable()->default(0)->index();
            $table->decimal('minimum_selling_price', 15, 2)->nullable()->default(0)->index();
            $table->decimal('selling_price', 15, 2)->nullable()->default(0)->index();
            $table->decimal('maximum_selling_price', 15, 2)->nullable()->default(0)->index();
            $table->tinyInteger('status')->default(1)->index();
            $table->foreignId('created_by')->nullable()->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('updated_by')->nullable()->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();
            $table->unique(['branch_id', 'brand_id', 'part_number'], 'unique_part_per_branch_brand');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
