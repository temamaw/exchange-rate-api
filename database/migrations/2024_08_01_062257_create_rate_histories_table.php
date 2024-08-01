<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rate_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exchange_rate_id')->constrained('exchange_rates')->onDelete('cascade');
            $table->decimal('old_buying_rate', 15, 6);
            $table->decimal('old_selling_rate', 15, 6);
            $table->decimal('new_buying_rate', 15, 6);
            $table->decimal('new_selling_rate', 15, 6);
            $table->timestamp('changed_at')->useCurrent();
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
        Schema::dropIfExists('rate_histories');
    }
}
