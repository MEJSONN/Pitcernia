<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->text('status');
            $table->timestamps();
        });

        // Wstawienie domyślnych statusów
        DB::table('statuses')->insert([
            ['status' => 'Oczekujące na potwierdzenie', 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'Potwierdzone', 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'Gotowe', 'created_at' => now(), 'updated_at' => now()],
            ['status' => 'Doręczone', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};
