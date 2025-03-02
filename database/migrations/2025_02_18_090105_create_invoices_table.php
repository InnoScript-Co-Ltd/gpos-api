<?php

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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();  
            $table->foreignId('customer_id'); 
            $table->string('iv_number');
            $table->float('total_item_amount', 12);
            $table->float('tax', 12)->default(0);
            $table->float('total_amount', 12);
            $table->float('pay_amount', 12);
            $table->float('refund_amount', 12)->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
