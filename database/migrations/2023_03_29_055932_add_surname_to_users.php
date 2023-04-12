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
            $table->string('surname')->after('name')->nullable();
            $table->string('specialty')->nullable()->after('remember_token');
            $table->string('skills')->nullable()->after('specialty');
            $table->string('gender')->nullable()->after('skills');
            $table->dateTime('birth_date')->nullable()->after('gender');
            $table->string('phone')->nullable()->after('birth_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'surname')) {
                $table->dropColumn('surname');
            }else if (Schema::hasColumn('users', 'specialty')) {
                $table->dropColumn('specialty');
            }else if (Schema::hasColumn('users', 'skills')) {
                $table->dropColumn('skills');
            }else if (Schema::hasColumn('users', 'gender')) {
                $table->dropColumn('gender');
            }else if (Schema::hasColumn('users', 'birth_date')) {
                $table->dropColumn('birth_date');
            }else if (Schema::hasColumn('users', 'phone')) {
                $table->dropColumn('phone');
            }
        });
    }
};
