<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('course_lectures', function (Blueprint $table) {
            if (Schema::hasColumn('course_lectures', 'pdf')) {
                $table->dropColumn('pdf');
            }
        });
    }

    public function down(): void
    {
        Schema::table('course_lectures', function (Blueprint $table) {
            $table->string('pdf')->nullable()->after('video');
        });
    }
};
