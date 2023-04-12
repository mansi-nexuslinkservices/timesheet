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
            $table->string('username')->nullable()->after('surname');
            $table->unsignedBigInteger('user_type_id')->nullable()->after('username');
            $table->unsignedBigInteger('designation_id')->nullable()->after('user_type_id');
            $table->date('joining_date')->nullable()->after('designation_id');
            $table->unsignedBigInteger('project_id')->nullable()->after('joining_date');
            $table->string('status')->comment('1=Active , 0=InActive')->default(1)->after('phone');
            $table->softDeletes();

            $table->foreign('user_type_id')->references('id')->on('user_types')->onDelete('cascade');
            $table->foreign('designation_id')->references('id')->on('designations')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'user_type_id')) {
                $table->dropColumn('user_type_id');
            }else if(Schema::hasColumn('users', 'username')) {
                $table->dropColumn('username');
            }else if(Schema::hasColumn('users', 'designation_id')) {
                $table->dropColumn('designation_id');
            }else if(Schema::hasColumn('users', 'joining_date')) {
                $table->dropColumn('joining_date');
            }else if(Schema::hasColumn('users', 'project_id')) {
                $table->dropColumn('project_id');
            }
        });
    }
};
