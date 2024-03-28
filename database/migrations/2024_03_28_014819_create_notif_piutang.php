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
        Schema::create('notif_piutang', function (Blueprint $table) {
            $table->id('notif_piutang_id');
            $table->foreignId('piutang_id');
            $table->date('tanggal_tenggat');
            $table->date('terakhir_dibayar');
            $table->decimal('sisa_pembayaran', 20, 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notif_piutang');
    }
};
