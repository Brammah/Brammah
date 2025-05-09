<?php

use App\Models\Branch;
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
        Schema::create('system_parameters', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Branch::class)->nullable()->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->string('key')->index();
            $table->string('value')->nullable()->index();
            $table->foreignId('created_by')->nullable()->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('updated_by')->nullable()->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();
            $table->unique(['branch_id', 'key'], 'unique_key_per_branch');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_parameters');
    }
};
