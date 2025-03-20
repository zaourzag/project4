<?php

use GuzzleHttp\Promise\Create;
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
        //
        Schema::create('producten', function (Blueprint $table) {
            $table->id();
            $table->string('naam');
            $table->text('omschrijving');
            $table->decimal('prijs', 10, 2);
            $table->string('afbeelding');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('producten');
    }
};
