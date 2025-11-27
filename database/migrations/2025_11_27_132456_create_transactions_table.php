<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Pakai UUID biar aman
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('address'); // Alamat kirim
            $table->string('courier')->nullable(); // JNE
            $table->integer('shipping_cost')->default(0);
            $table->integer('total_price'); // Barang + Ongkir
            $table->enum('status', ['unpaid', 'pending', 'paid', 'sent', 'done', 'cancelled', 'expire'])->default('unpaid');
            $table->string('snap_token')->nullable(); // Midtrans
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
