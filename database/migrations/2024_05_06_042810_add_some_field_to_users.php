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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('position')->nullable()->after('remember_token');
            $table->string('department')->nullable();
            $table->string('face_embedding')->nullable();
            $table->string('image_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('position');
            $table->dropColumn('department');
            $table->dropColumn('face_embeddeding');
            $table->dropColumn('image_url');
        });
    }
};
