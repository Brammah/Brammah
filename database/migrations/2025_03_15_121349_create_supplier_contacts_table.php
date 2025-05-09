<?php

use App\Models\Branch;
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
        Schema::create('supplier_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Branch::class)->nullable()->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Supplier::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->string('name')->index();
            $table->string('email')->nullable()->index();
            $table->string('phone')->nullable()->index();
            $table->foreignId('created_by')->nullable()->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('updated_by')->nullable()->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();
            $table->unique(['branch_id', 'email', 'phone'], 'unique_details_per_branch');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_contacts');
    }
};
