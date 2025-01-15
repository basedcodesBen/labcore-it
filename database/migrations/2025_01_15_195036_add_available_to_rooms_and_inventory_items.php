<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Add 'available' column to rooms table
        Schema::table('rooms', function (Blueprint $table) {
            $table->boolean('available')->default(true); // Available by default
        });

        // Add 'available' column to inventory_items table
        Schema::table('inventory_items', function (Blueprint $table) {
            $table->boolean('available')->default(true); // Available by default
        });
    }

    public function down()
    {
        // Remove 'available' column from rooms table
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('available');
        });

        // Remove 'available' column from inventory_items table
        Schema::table('inventory_items', function (Blueprint $table) {
            $table->dropColumn('available');
        });
    }

};
