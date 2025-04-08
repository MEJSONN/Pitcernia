<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained('users')->onDelete('set null');
            $table->json('items');
            $table->decimal('total_price', 8, 2);
            $table->unsignedTinyInteger('status')->default(1);
            $table->timestamps();
        });        
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
