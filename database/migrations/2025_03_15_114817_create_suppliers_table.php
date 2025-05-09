<?php

use App\Models\Branch;
use App\Models\Country;
use App\Models\PaymentTerm;
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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Branch::class)->nullable()->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Country::class)->nullable()->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(PaymentTerm::class)->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('parent_id')->nullable()->index();
            $table->string('type')->index();
            $table->string('supplier_code')->index();
            $table->string('name')->index();
            $table->string('slug')->unique();
            $table->string('kra_pin')->nullable()->index();
            $table->string('email')->nullable()->index();
            $table->string('phone')->nullable()->index();
            $table->string('address')->nullable();
            $table->string('description')->nullable();
            $table->boolean('create_account')->default(false);
            $table->tinyInteger('status')->default(1)->index();
            $table->foreignId('created_by')->nullable()->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('updated_by')->nullable()->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();

            $table->unique(['branch_id', 'kra_pin'], 'unique_kra_pin_per_branch');
            $table->unique(['branch_id', 'email', 'phone', 'parent_id'], 'unique_email_phone_per_branch');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
