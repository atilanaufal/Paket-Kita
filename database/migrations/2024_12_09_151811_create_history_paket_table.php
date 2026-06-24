<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryPaketTable extends Migration
{
    public function up()
    {
        Schema::create('history_paket', function (Blueprint $table) {
            $table->id('trackID'); // Creates an auto-incrementing primary key
            $table->char('awb', 100);
            $table->string('kurir', 100);
            $table->string('status', 100);
            $table->text('origin');
            $table->text('destination');
            $table->string('shipper', 255);
            $table->string('receiver', 255);
            $table->text('history');
            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('history_paket');
    }
}
