<?php

use App\Models\Branch;
use App\Models\Driver;
use App\Models\VehicleMake;
use App\Models\VehicleModel;
use App\Models\VehicleType;
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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Branch::class)->nullable()->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(VehicleMake::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(VehicleModel::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(VehicleType::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignIdFor(Driver::class)->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->string('registration_number')->unique()->index();
            $table->string('slug');
            $table->string('trailer')->nullable()->unique()->index();
            $table->string('card_number')->nullable()->unique()->index();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('vehicles');
    }
};
