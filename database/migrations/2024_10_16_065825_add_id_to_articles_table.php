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
        Schema::table('articles', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('userid')->nullable();

            $table->foreign('userid')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            //
            $table->dropForeign(['userid']); // Drop the foreign key
            $table->dropColumn('userid'); // Drop the column
        });
    }
};
