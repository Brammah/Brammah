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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Branch::class)->nullable()->constrained()->cascadeOnUpdate()->onDelete('NO ACTION');
            $table->string('first_name')->index();
            $table->string('last_name')->index();
            $table->string('full_name')->nullable()->index();
            $table->string('username')->unique()->index();
            $table->string('slug')->unique()->index();
            $table->string('email')->nullable()->unique()->index();
            $table->enum('gender', ['M', 'F'])->nullable()->index();
            $table->string('phone')->nullable()->unique()->index();
            $table->string('password');
            $table->tinyInteger('status')->default(1)->index();
            $table->timestamp('email_verified_at')->nullable()->index();
            $table->timestamp('last_login_at')->nullable()->index();
            $table->string('last_login_ip')->nullable()->index();
            $table->tinyInteger('is_admin')->default(0)->index();
            $table->tinyInteger('is_pseudo')->default(0)->index();
            $table->tinyInteger('is_branch_manager')->default(0)->index();
            $table->tinyInteger('is_web_user')->default(1)->index();
            $table->tinyInteger('is_app_user')->default(0)->index();
            $table->foreignId('created_by')->nullable()->references('id')->on('users')->cascadeOnUpdate()->onDelete('NO ACTION');
            $table->foreignId('updated_by')->nullable()->references('id')->on('users')->cascadeOnUpdate()->onDelete('NO ACTION');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};