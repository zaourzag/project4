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
        //
        schema::table("oauth_access_tokens", function (Blueprint $table) {
            $table->string('token')->nullable();
            $table->string('abilities')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        schema::table("oauth_access_tokens", function (Blueprint $table) {
            $table->dropColumn('token');
            $table->dropColumn('abilities');
        });
    }
};
