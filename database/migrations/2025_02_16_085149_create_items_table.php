<?php

use App\Enums\GeneralStatusEnum;
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
        Schema::create('items', function (Blueprint $table) {
            $table->uuid()->primary()->index();
            $table->foreignUuid('category_id');
            $table->string('name')->unique();
            $table->string('photo')->nullable()->default(null);
            $table->string('description')->nullable()->default(null);
            $table->unsignedBigInteger('qty')->default(0);
            $table->float('price', precision: 12)->default(0);
            $table->string('qrcode')->nullable()->default(null);
            $table->string('status')->default(GeneralStatusEnum::ACTIVE->value);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('uuid')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
