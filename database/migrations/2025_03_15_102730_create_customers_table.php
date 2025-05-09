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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Branch::class)->nullable()->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Country::class)->nullable()->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(PaymentTerm::class)->nullable()->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('parent_id')->nullable()->index();
            $table->string('customer_type')->index()->default('individual');
            $table->string('customer_number')->index();
            $table->enum('account_type', ['cash', 'credit'])->index();
            $table->string('name')->nullable()->index();
            $table->string('company_name')->nullable()->index();
            $table->string('slug')->unique();
            $table->string('phone')->nullable()->index();
            $table->string('address')->nullable()->index();
            $table->string('kra_pin')->nullable()->index();
            $table->string('email')->nullable()->index();
            $table->tinyInteger('status')->default(1);
            $table->string('billing_currency')->default('KES')->index();
            $table->integer('maximum_invoices')->default(0);
            $table->decimal('opening_balance', 15, 2)->default(0);
            $table->decimal('credit_limit', 15, 2)->default(0);
            $table->decimal('outstanding_balance', 15, 2)->default(0);
            $table->decimal('loyalty_points', 15, 2)->default(0);
            $table->boolean('transacting_account')->default(false);
            $table->boolean('is_withholding_agent')->default(false);
            $table->foreignId('created_by')->nullable()->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('updated_by')->nullable()->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('account_manager_id')->nullable()->references('id')->on('users')->cascadeOnUpdate()->restrictOnDelete();
            $table->timestamps();
            $table->unique(['branch_id', 'customer_number'], 'unique_customer_number_per_branch');
            $table->unique(['branch_id', 'company_name'], 'unique_company_name_per_branch');
            $table->unique(['branch_id', 'name'], 'unique_name_per_branch');
            $table->unique(['branch_id', 'kra_pin'], 'unique_kra_pin_per_branch');
            $table->unique(['branch_id', 'phone'], 'unique_phone_per_branch');
            $table->unique(['branch_id', 'email'], 'unique_email_per_branch');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
