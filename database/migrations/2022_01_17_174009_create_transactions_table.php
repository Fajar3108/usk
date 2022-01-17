<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('receiver_id')->nullable()->constrained('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('sender_id')->nullable()->constrained('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('confirmed_by')->nullable()->constrained('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('product_id')->nullable()->constrained('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->integer('amount');
            $table->integer('type');
            $table->integer('status')->default(0);
            $table->text('description')->nullable();
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
}
